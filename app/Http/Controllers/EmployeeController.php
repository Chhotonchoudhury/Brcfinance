<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Branch;
use App\Models\User;
use App\Models\ShareRange;
use App\Models\Share;
use App\Models\AuthorizedCapital;
use App\Http\Requests\EmployeeRequest;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules\Password;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Company;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EmployeeController extends Controller
{
    //
     // Display all employees
     public function index(Request $request)
     {
         $search = $request->input('search', '');
         
         $employees = Employee::when($search, function ($query, $search) {
             return $query->where('employee_code', 'like', "%{$search}%")
                          ->orWhere('name', 'like', "%{$search}%")
                          ->orWhere('city', 'like', "%{$search}%");
         })
         ->paginate(50); // Paginate results per page
 
         return view('employees.list', compact('employees', 'search'));
     }

     // Display employee details
     public function EmployeeForm($id = null)
     {
         $branches = Branch::all();
         $roles = Role::all();  // Get all roles

         if ($id) {
             // Fetch the agent data for editing
             $employee = Employee::findOrFail($id);

             return view('employees.storeFrom', ['employee' => $employee, 'branches' => $branches, 'roles' => $roles]);
         } else {
             // For creating a new agent
             return view('employees.storeFrom', ['branches' => $branches , 'roles' => $roles]);
         }
     }

    // Store or update employee

     public function storeOrUpdateEmployee(EmployeeRequest $request, $id = null)
    {

        // Find agent by ID or create a new instance
        $agent = $id ? Employee::findOrFail($id) : new Employee();
    
        // Assign validated data to the agent model
        $agent->branch_id = $request->branch_id;
        $agent->name = $request->name;
        $agent->email = $request->email;
        $agent->phone = $request->phone;
        $agent->gender = $request->gender;
        $agent->joining_date = $request->joining_date;
        $agent->date_of_birth = $request->date_of_birth;
        $agent->is_active = $request->is_active;
        $agent->aadhaar_number = $request->aadhaar_number;
        $agent->pan_number = $request->pan_number;
        $agent->commission_rate = $request->commission_rate;
        $agent->city = $request->city;
        $agent->state = $request->state;
        $agent->address = $request->address;
        $agent->pincode = $request->pincode;
        // Assign Bank Details
        $agent->bank_name = $request->bank_name;
        $agent->account_number = $request->account_number;
        $agent->ifsc_code = $request->ifsc_code;
        $agent->branch_name = $request->branch_name;


        // Assign Job & Salary Details
        $agent->job_title = $request->job_title;
        $agent->job_position = $request->job_position;
        $agent->department = $request->department;
        $agent->employment_type = $request->employment_type;
        $agent->start_date = $request->start_date;
        $agent->end_date = $request->end_date;

        // Weekly Login Permissions
        $agent->allowed_days = $request->login_days ? json_encode($request->login_days) : null;
        $agent->login_start_time = $request->login_start_time;
        $agent->login_end_time = $request->login_end_time;

        // Bank Cheque Fields
        $agent->bank_cheque_1 = $request->bank_cheque_1;
        $agent->bank_cheque_2 = $request->bank_cheque_2;
        $agent->bank_cheque_3 = $request->bank_cheque_3;


        // Salary Breakdown
        $agent->base_salary = $request->base_salary;
        $agent->pf_amount = $request->pf_amount;
        $agent->esi_amount = $request->esi_amount;
        $agent->tds_amount = $request->tds_amount;
        $agent->medical_allowance = $request->medical_allowance;
        $agent->travel_allowance = $request->travel_allowance;
        $agent->other_allowances = $request->other_allowances;

        // Gross = base + allowances + pf + esi + tds
        $grossSalary = (
            ($request->base_salary ?? 0) +
            ($request->medical_allowance ?? 0) +
            ($request->travel_allowance ?? 0) +
            ($request->other_allowances ?? 0) +
            ($request->pf_amount ?? 0) +
            ($request->esi_amount ?? 0) +
            ($request->tds_amount ?? 0)
        );

        // Net Salary = base + allowances - deductions
        $netSalary = (
            ($request->base_salary ?? 0) +
            ($request->medical_allowance ?? 0) +
            ($request->travel_allowance ?? 0) +
            ($request->other_allowances ?? 0)
        ) - (
            ($request->pf_amount ?? 0) +
            ($request->esi_amount ?? 0) +
            ($request->tds_amount ?? 0)
        );

        $agent->gross_salary = round($grossSalary, 2);
        $agent->salary = round($netSalary, 2);
    
        
        // Handle photo file upload (delete old photo if updating)
        if ($request->hasFile('photo')) {
            if ($id && $agent->photo) {
                \Storage::disk('public')->delete($agent->photo); // Delete old photo
            }
            $agent->photo = $request->file('photo')->store('employee', 'public');
        }
    
        // Handle signature file upload (delete old signature if updating)
        if ($request->hasFile('signature')) {
            if ($id && $agent->signature) {
                \Storage::disk('public')->delete($agent->signature); // Delete old signature
            }
            $agent->signature = $request->file('signature')->store('employeeSing', 'public');
        }

    
        // Handle optional documents and store them as JSON
        if ($request->has('document_type') && $request->has('document')) {
            $documents = $agent->documents ? json_decode($agent->documents, true) : [];
    
            foreach ($request->document_type as $index => $type) {
                $file = $request->file('document')[$index];
                $filePath = $file->store('documents', 'public');
    
                $documents[] = [
                    'doc_type' => $type,
                    'file_path' => $filePath,
                ];
            }
    
            // Save updated documents as JSON
            $agent->documents = json_encode($documents);
        }
    
        // $agent->save();


         // Create or update user record
            $user = User::firstOrNew(['type_id' => $id, 'user_type' => 'Employee']);

            $user->name = $agent->name;
            $user->email = $agent->email;
            $user->phone = $agent->phone;
            $user->type_id = $agent->id;
            $user->user_type = 'Employee';
            $user->unique_code = $agent->employee_code;

            // Update password only if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            // Assign the user_id to the agent (before saving agent)
            $agent->user_id = $user->id;
            $agent->save(); // Save agent now with correct user_id

            // Check if a role is selected and assign it
           // Check if a role is selected and assign it
            if ($request->filled('roles')) {

                // Convert role ID to name
                $roleId = $request->roles;
                $role = Role::find($roleId)?->name;

                // If role exists, assign it to the user
                if ($role && $agent->user) {
                    $agent->user->syncRoles([$role]);
                }
            }
        // Create a corresponding user record only for new agents
        if (!$id) {
            // Assign the 'Agent' role to the user
        //    $user->assignRole('Employee');


            // Allocate shares for the new agent
           $shareRange = ShareRange::where('user_type', 'Employee')->where('active', true)->first();

            if ($shareRange) {
                // Directly use the number of shares from the ShareRange table
                $sharesToAllocate = $shareRange->num_shares;


                // Fetch the last issued share range end
                $lastIssuedShare = Share::orderBy('share_range_end', 'desc')
                ->first();

                $lastShareEnd = $lastIssuedShare ? (int)$lastIssuedShare->share_range_end : 0;

                // Determine the new range
                $newShareStart = $lastShareEnd + 1;
                $newShareEnd = $newShareStart + $sharesToAllocate - 1; // $sharesToAllocate is the number of shares being issued

                // Ensure available shares in authorized capitals
                $availableShares = AuthorizedCapital::first()->available_shares;

                if ($sharesToAllocate > $availableShares) {
                    return  redirect()->route('agent.index')->with('success', 'Agent created successfully But Shares not allocated due to insufficient available shares ): ');
                }

                // Update the authorized_capitals table
                $authorizedCapital = AuthorizedCapital::first(); // Adjust to fetch the correct record

                // Allocate the shares
                $share = Share::create([
                'shareholder_type' => 'App\Models\User', // Polymorphic type (e.g., User or Member)
                'shareholder_id' => $agent->id, // Polymorphic ID
                'share_range_start' => $newShareStart,
                'share_range_end' => $newShareEnd,
                'nominal_value' => $authorizedCapital->nominal_value,
                'number_of_shares' => $sharesToAllocate,
                'purchase_price' => $authorizedCapital->nominal_value * $sharesToAllocate,
                'share_type' => 'issued',
                'date' => now(),
                'status' => 'active',
                'is_paid' => false,
                ]);

                if ($authorizedCapital) {
                    $authorizedCapital->issued_shares += $sharesToAllocate;
                    $authorizedCapital->available_shares -= $sharesToAllocate;
                    $authorizedCapital->save();
                }
            }   
        }

    
        return  redirect()->route('employees.index')->with('success', $id ? 'Employee updated successfully' : 'Employee created successfully');
    }
    
    
    
    //find the employees 
    public function getEmployees($branch_id)
    {
        // Fetch employees based on branch_id
        $employees = Employee::where('branch_id', $branch_id)->get();

        // Return as JSON response
        return response()->json($employees);
    }

    
     // Update Password use js
     public function updateUserPassword(Request $request)
     {
         try {
             // Ensure request type is JSON
             if (!$request->expectsJson()) {
                 return response()->json([
                     'success' => false,
                     'message' => 'Invalid request type.'
                 ], 400);
             }
     
             // Validate input
             $validated = $request->validate([
                 'current_password' => 'required',
                 'new_password' => 'required|min:6|confirmed',
             ]);
     
             $user = Auth::user();
     
             // Check if current password is correct
             if (!Hash::check($validated['current_password'], $user->password)) {
                 return response()->json([
                     'success' => false, 
                     'message' => 'Current password is incorrect.'
                 ], 400);
             }
     
             // Update the password
             $user->update([
                 'password' => Hash::make($validated['new_password']),
             ]);
     
             return response()->json([
                 'success' => true, 
                 'message' => 'Password updated successfully.'
             ]);
     
         } catch (ValidationException $e) {
             return response()->json([
                 'success' => false,
                 'message' => 'Validation failed.',
                 'errors' => $e->errors()
             ], 422);
         } catch (\Exception $e) {
             Log::error("Password Update Error: " . $e->getMessage());
     
             return response()->json([
                 'success' => false,
                 'message' => $e->getMessage(),
                 'error' => $e->getMessage(),
             ], 500);
         }
     }
     
     public function downloadAppointmentLetter($id)
    {
        // $employee = Employee::findOrFail($id);
        // $CP = Company::latest()->first(); // Fetch latest company record

        // $company = [
        //     'name' => $CP->name,
        //     'address' => $CP->address,
        //     'email' => $CP->email,
        //     'phone' => $CP->phone,
        // ];

        // // Load the Blade view as HTML
        // $html = View::make('letters.appointment', compact('employee', 'company'))->render();

        // // Dompdf options (optional, but recommended)
        // $options = new Options();
        // $options->set('defaultFont', 'DejaVu Sans'); // for Unicode support like ₹ symbol
        // $dompdf = new Dompdf($options);

        // // Load HTML and render
        // $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'portrait');
        // $dompdf->render();

        // // Stream the PDF
        // return response($dompdf->output(), 200)
        //     ->header('Content-Type', 'application/pdf')
        //     ->header('Content-Disposition', 'attachment; filename="Appointment_Letter_' . $employee->name . '.pdf"');

        $employee = Employee::findOrFail($id);
        $company = Company::latest()->first();

        // Get the public URL of the signature
        $signatureBase64 = null;
        if ($employee->signature) {
            $path = public_path('storage/' . $employee->signature);
            if (file_exists($path)) {
                $signatureBase64 = 'data:image/png;base64,' . base64_encode(file_get_contents($path));
            }
        }

        $html = View::make('letters.appointment', compact('employee', 'company', 'signatureBase64'))->render();

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true); // IMPORTANT for external image URLs

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="Appointment_Letter_' . $employee->name . '.pdf"');
    } 

    public function preview($id)
    {
        $employee = Employee::findOrFail($id);
        $company = Company::latest()->first();

        $signatureBase64 = null;

        if ($employee->signature) {
            $signaturePath =  public_path('storage/' . $employee->signature);
            $signatureType = pathinfo($signaturePath, PATHINFO_EXTENSION);
            $signatureData = file_get_contents($signaturePath);
            $signatureBase64 = 'data:image/' . $signatureType . ';base64,' . base64_encode($signatureData);
        }

        $html = View::make('letters.appointment', compact('employee', 'company', 'signatureBase64'))->render();

        $options = new Options();
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="Appointment_Letter_' . $employee->name . '.pdf"');
    }
}
