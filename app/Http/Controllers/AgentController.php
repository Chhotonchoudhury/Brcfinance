<?php

namespace App\Http\Controllers;
use App\Models\Agent;
use App\Models\Branch;
use App\Models\User;
use App\Models\ShareRange;
use App\Models\Share;
use App\Models\AuthorizedCapital;
use App\Http\Requests\BranchRequest;
use Illuminate\Http\Request;
use App\Http\Requests\AgentRequest;
use Spatie\Permission\Traits\HasRoles;

class AgentController extends Controller
{
    //

    public function index(Request $request)
    {
        $search = $request->input('search', ''); // Capture search query
    
        // Apply search query and paginate
        $agents = Agent::when($search, function ($query, $search) {
            return $query->where('agent_code', 'like', "%{$search}%")
                         ->orWhere('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%");
        })
        ->paginate(50); // Paginate results per page
    
        return view('agents.list', compact('agents', 'search'));
    }

    public function AgentForm($id = null)
    {
        $branches = Branch::all();

        if ($id) {
            // Fetch the agent data for editing
            $agent = Agent::findOrFail($id);
            return view('agents.storeFrom', ['agent' => $agent, 'branches' => $branches]);
        } else {
            // For creating a new agent
            return view('agents.storeFrom', ['branches' => $branches]);
        }
    }


    public function storeOrUpdateAgent(AgentRequest $request, $id = null)
    {

        // Find agent by ID or create a new instance
        $agent = $id ? Agent::findOrFail($id) : new Agent();
    
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

        // Assign Bank Details
        $agent->bank_name = $request->bank_name;
        $agent->account_number = $request->account_number;
        $agent->ifsc_code = $request->ifsc_code;
        $agent->branch_name = $request->branch_name;
    
    
        // Handle photo file upload (delete old photo if updating)
        if ($request->hasFile('photo')) {
            if ($id && $agent->photo) {
                \Storage::disk('public')->delete($agent->photo); // Delete old photo
            }
            $agent->photo = $request->file('photo')->store('agents', 'public');
        }
    
        // Handle signature file upload (delete old signature if updating)
        if ($request->hasFile('signature')) {
            if ($id && $agent->signature) {
                \Storage::disk('public')->delete($agent->signature); // Delete old signature
            }
            $agent->signature = $request->file('signature')->store('agentSing', 'public');
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
    
        $agent->save();

        // Create a corresponding user record only for new agents
        if (!$id) {
            $user = User::create([
                'name' => $agent->name,
                'email' => $agent->email,
                'type_id' => $agent->id, // The primary key of the agent
                'user_type' => 'Agent', // Set user_type as 'Agent'
                'unique_code' => $agent->agent_code, // Use agent_code for unique_code
            ]);
            // Assign the 'Agent' role to the user
           $user->assignRole('Agent');


            // Allocate shares for the new agent
           $shareRange = ShareRange::where('user_type', 'Agent')->where('active', true)->first();

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

    
        return  redirect()->route('agent.index')->with('success', $id ? 'Agent updated successfully' : 'Agent created successfully');
    }
    


}
