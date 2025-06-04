<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\BranchRequest;
use App\Models\Company;
use App\Models\Branch;
use App\Models\AuthorizedCapital;
use App\Models\ShareRange;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    //
      // Display the company configuration form
      public function index()
      {
          $company = Company::firstOrFail();// Assuming there is only one company configuration
              // Get share ranges for different user types
            $shareRanges = ShareRange::all()->keyBy('user_type')->map(function ($item) {
                return [
                    'num_shares' => $item->num_shares,
                    'active' => $item->active, 
                ];
            });

            // Get the authorized capital details
            $authorizedCapital = AuthorizedCapital::first();
          return view('company.Viewconfig', compact('company', 'shareRanges', 'authorizedCapital'));
      }

      public function Edite(){
        $company = Company::firstOrFail();
        // Assuming there is only one company configuration
        return view('company.config', compact('company'));
      }

      public function store(StoreCompanyRequest $request)
    {
        // Handle form validation
        $validated = $request->validated();

        // Get inputs from the form
        $authorizedCapitalInput = $validated['authorized_capital'] ?? 0;
        $nominalValue = $validated['shares_nominal_value'] ?? 0;
        $paidUpCapitalInput = $validated['paid_up_capital'] ?? 0;

        // Validate to prevent division by zero
        if ($nominalValue <= 0) {
            return back()->withErrors(['shares_nominal_value' => 'Nominal value must be greater than 0.']);
        }

        // Calculate total shares based on authorized capital and nominal value
        $totalShares = floor($authorizedCapitalInput / $nominalValue); // Use floor to ensure integer values
        $issuedShares = 0; // Default value for new or recalculated entry
        $availableShares = $totalShares - $issuedShares;

        // Update or create the company record
        $company = Company::firstOrNew();

        // Handle logo file upload
        if ($request->hasFile('company_logo')) {
            // Delete the old company logo if it exists
            if ($company->company_logo && Storage::exists('public/'.$company->company_logo)) {
                Storage::delete('public/'.$company->company_logo);
            }
            // Store the new company logo and get the file path
            $logoPath = $request->file('company_logo')->store('logos', 'public');
            // Do not store the file path in the database
            // Save the logo path to the company
            $company->company_logo = $logoPath;
        } else {
            // If no new logo, retain the existing one
            $company->company_logo = $company->company_logo ?? null;
        }

        // Handle favicon file upload
        if ($request->hasFile('favicon')) {
            // Delete the old favicon if it exists
            if ($company->favicon && Storage::exists('public/'.$company->favicon)) {
                Storage::delete('public/'.$company->favicon);
            }
            // Store the new favicon and get the file path
            $faviconPath = $request->file('favicon')->store('favicons', 'public');
            // Do not store the file path in the database
            // Save the favicon path to the company
            $company->favicon = $faviconPath;
        }else {
            // If no new favicon, retain the existing one
            $company->favicon = $company->favicon ?? null;
        }

        $company->fill([
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'location' => $validated['location'] ?? null,
            'incorp_date' => $validated['incorp_date'] ?? null,
            'cin_label' => $validated['cin_label'] ?? null,
            'pan' => $validated['pan'] ?? null,
            'gst_no' => $validated['gst_no'] ?? null,
            'category' => $validated['category'] ?? null,
            'class' => $validated['class'] ?? null,
            'country' => $validated['country'] ?? null,
            'authorized_capital' => $authorizedCapitalInput,
            'paid_up_capital' => $paidUpCapitalInput, // Keep paid-up capital independent
            'shares_nominal_value' => $nominalValue,
            'about' => $validated['about'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);
        $company->save();

        // Update or create the authorized capital record
        $authorizedCapital = AuthorizedCapital::firstOrNew();
        $authorizedCapital->fill([
            'total_shares' => $totalShares,
            'nominal_value' => $nominalValue,
            'issued_shares' => $authorizedCapital->issued_shares ?? 0, // Retain existing issued shares
            'available_shares' => $totalShares - ($authorizedCapital->issued_shares ?? 0),
        ]);
        $authorizedCapital->save();

        // Return success response
        return redirect()->route('company.view')->with('success', 'Company details updated successfully.');
    }

      
    public function ShareRangeUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'share_ranges' => 'required|array',
            'share_ranges.*.user_type' => 'required|string',
            'share_ranges.*.num_shares' =>  'required|numeric|min:0',
            'share_ranges.*.active' => 'required|boolean',
        ]);

        $shareRanges = $validatedData['share_ranges'];
        // dd($shareRanges);
        // return response()->json(['success' => true, 'message' => "sdfd"]);

        foreach ($shareRanges as $range) {
            ShareRange::updateOrCreate(
                ['user_type' => $range['user_type']],
                [
                    'num_shares' => $range['num_shares'],
                    'active' => $range['active'],
                ]
            );
        }

        return response()->json(['success' => true, 'message' => 'Share updated successfully!']);
    }


      public function branch(Request $request)
      {
        $search = $request->input('search', ''); // Capture search query
    
        // Apply search query and paginate
        $branches = Branch::when($search, function ($query, $search) {
            return $query->where('branch_code', 'like', "%{$search}%")
                         ->orWhere('branch_name', 'like', "%{$search}%")
                         ->orWhere('city', 'like', "%{$search}%");
        })
        ->paginate(50); // Paginate results per page

        return view('company.branch', compact('branches','search'));
      }

      public function branchForm($id = null)
      {
        if ($id) {
            // Fetch the branch data for editing
            $branch = Branch::findOrFail($id);
            return view('company.branchStore', ['branch' => $branch]);
        } else {
            // For creating a new branch
            return view('company.branchStore');
        }
      }

       // Method to store or update a branch
      public function storeOrUpdateBranch(BranchRequest $request, $id = null)
      {
          if ($id) {
              // Update the existing branch
              $branch = Branch::findOrFail($id);
              $branch->update($request->validated());
              $message = 'Branch updated successfully!';
          } else {
              // Create a new branch
              $branch = Branch::create($request->validated());
              $message = 'Branch created successfully!';
          }

          // Redirect with a success message
          return redirect()->route('company.branch')->with('success', $message);
      }
}
