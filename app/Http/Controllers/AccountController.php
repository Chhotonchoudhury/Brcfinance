<?php

namespace App\Http\Controllers;
use App\Models\SavingsAccount;
use App\Models\SavingAccountPlan;

use App\Models\RdAccount;
use App\Models\RdAccountPlan;
use App\Models\LoanAgainstDepositPlan;

use App\Models\Branch;
use App\Models\Memeber;
use App\Models\User;

use App\Models\Nominee;
use App\Models\AccountTransaction;
use App\Models\CompanyFinances;
use App\Models\FinanceTransaction;
use App\Models\BranchFinances;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Mail\SavingsAccountCreated;
use App\Mail\RdAccountCreated;
use App\Mail\SavingsTransaction;
use App\Mail\RdDeposit;
use App\Models\Company;
use Illuminate\Support\Facades\Mail;
use App\Services\RdAccountService;
class AccountController extends Controller
{
      //savings AC List
      public function index(Request $request)
      {
          // Capture search query
          $search = $request->input('search', '');
  
          // Apply search query and paginate for SavingAccountPlans
          $accounts = SavingsAccount::when($search, function ($query, $search) {
              return $query->where('account_number', 'like', "%{$search}%")
               ->orWhereHas('member', function ($q) use ($search) {
                $q->where('member_code', 'like', "%{$search}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
            });
          })
          
          ->paginate(50); // Paginate results per page
  
          // Return view with search and paginated results
          return view('accounts.SavingAccount', compact('accounts', 'search'));
      }
      //Create savings account
      public function CreateSVAccount(Request $request)
      {
        $branches = Branch::all();
        $members = Memeber::all(); // Assuming you have a Member model
         $agents = User::where('user_type', 'Agent')
        ->orWhere('user_type', 'Employee')
        ->get(); // Assuming you have an Agent model
        $savingsPlans = SavingAccountPlan::all(); // Assuming you have a SavingsPlan model

        return view('accounts.SavingACForm', compact('branches','members','agents','savingsPlans'));
      }

      //show savings account
      public function unapproveSVAccount(Request $request)
      {
           // Capture search query
            $search = $request->input('search', '');

            // Apply search query, filter for accounts where `approved_by` is null, and paginate
            $accounts = SavingsAccount::when($search, function ($query, $search) {
                    return $query->where('account_number', 'like', "%{$search}%");
                })
                ->where('status', '!=', 'approved') // Filter accounts with approved_by as null
                ->paginate(50); // Paginate results per page

            // Return view with search and paginated results
            return view('accounts.SavingAcApproval', compact('accounts', 'search'));
      }

      // Controller Method
      public function getMemberInfo($id)
      {
          // Fetch the member's details from the database using the provided ID
          $member = Memeber::find($id);

          // Return the member's information as a JSON response
          if ($member) {
              return response()->json([
                  'first_name' => $member->first_name,
                  'last_name' => $member->last_name,
                  'member_code' => $member->member_code,
                  'email' => $member->email,
                  'phone' => $member->mobile_number,
              ]);
          }

          return response()->json(null, 404); // Return 404 if no member is found
      }

      public function getPlanInfo($id)
      {
          $plan = SavingAccountPlan::find($id);

          if ($plan) {
              return response()->json([
                  'minimum_amount' => $plan->min_opening_balance
              ]);
          }

          return response()->json(null, 404);
      }

      public function getPlanInfoRd($id)
      {
          $plan = RdAccountPlan::find($id);

          if ($plan) {
              return response()->json([
                  'minimum_amount' => $plan->minimum_amount
              ]);
          }

          return response()->json(null, 404);
      }


    //create savings account 
    public function storeSVAccount(Request $request)
    {
        // dd($request->all());
            // Check if the member already has an active savings account
        // $existingAccount = SavingsAccount::where('member_id', $request->member_id)->first();

        // if ($existingAccount) {
        //     // If an existing account is found, return with an error message
        //     return redirect()->back()->with('error', 'This member already has an active savings account.');
        // }

        // Validation of the incoming request
        $request->validate([
            'member_id' => 'required|exists:memebers,id',
            'branch_id' => 'required|exists:branches,id',
            'savings_plan_id' => 'required|exists:saving_account_plans,id',
            'agent_id' => 'nullable|exists:users,id', // Add agent_id validation
            'minimum_amount' => 'required|numeric|min:0', 
            'opeaning_date' => 'required|date|before_or_equal:today', // Validation for opening_date
            'transaction_date' => 'required|date|before_or_equal:today', // Validation for transaction_date

            'opened_with_less_minimum' => 'nullable|boolean',
            'account_on_hold' => 'nullable|boolean',
            'is_joint_account' => 'nullable|boolean',
            'has_nominee' => 'nullable|boolean',

            'joint_member_id' => 'nullable|exists:memebers,id',
            
            'nominee_name' => 'nullable|string',
            'relationship' => 'nullable|string',
            'aadhar_number' => 'nullable|string|size:12', // Aadhar Number validation
            'voter_id_number' => 'nullable|string|max:20', // Voter ID Number validation
            'phone_number' => 'nullable|regex:/^[0-9]{10}$/', // Phone number validation (10 digits)
            'address' => 'nullable|string|max:255', // Address validation (maximum length 255 characters)
            
            'payment_mode' => 'required|string|in:cash,cheque,online',

            // Cash Section Validation
            'cash_1' => 'nullable|numeric|min:0',
            'cash_5' => 'nullable|numeric|min:0',
            'cash_10' => 'nullable|numeric|min:0',
            'cash_20' => 'nullable|numeric|min:0',
            'cash_50' => 'nullable|numeric|min:0',
            'cash_100' => 'nullable|numeric|min:0',
            'cash_200' => 'nullable|numeric|min:0',
            'cash_500' => 'nullable|numeric|min:0',

            // Cheque Section Validation
            'cheque_number' => 'nullable|string|max:20',
            'bank_name' => 'nullable|string|max:100',
            'branch_name' => 'nullable|string|max:100',
            'cheque_date' => 'nullable|date|before_or_equal:today',

            // Online Section Validation
            'online_transaction_id' => 'nullable|string|max:100',
            'payment_gateway' => 'nullable|string|max:100',
            'remarks' => 'nullable|string|max:500',      
        ]);
        
        $agentId = null;
        $employeeId = null;
        if ($request->has('agent_id')) {
            // Check if the agent_id exists in the users table and if the user_type is 'Agent'
            $user = User::find($request->agent_id);
            
            if ($user && $user->user_type === 'Agent') {
                $agentId = $request->agent_id;  // Store agent_id if the user_type is 'Agent'
            } else {
                $employeeId = $request->agent_id;  // If not an Agent, store it as employee_id
            }
        }

        // Create a new Savings Account entry with the validated data
        $savingsAccount = new SavingsAccount([
            'member_id' => $request->member_id,
            'branch_id' => $request->branch_id,
            'agent_id' => $agentId,  // Store the agent_id if provided
            'employee_id' => $employeeId,  // Store the employee_id if provided
            'savings_plan_id' => $request->savings_plan_id,
            'balance' => $request->minimum_amount,  // Default balance, can be modified later
            'is_joint' => (bool) $request->is_joint_account,
            'joint_member_id' => $request->joint_member_id,
            'opened_with_less_minimum' => (bool) $request->opened_with_less_minimum,
            'nominee' => (bool) $request->has_nominee,
            'account_status' => $request->account_on_hold == 1 ? 'on_hold' : 'active',
            'opeaning_date' => $request->opeaning_date,
        ]);


        // Save the savings account to the database
        $savingsAccount->save();

        // Check if the account has a nominee and store the nominee
        if($request->has_nominee) {
            Nominee::create([
                'account_id' => $savingsAccount->id,  // Link the nominee to the savings account
                'account_type' => SavingsAccount::class,  // The type of account (Polymorphic)
                'nominee_name' => $request->nominee_name,
                'relationship' => $request->relationship,
                'nominee_status' => 'active',  // Default status
                'phone_number' => $request->phone_number,
                'aadhar_number' => $request->aadhar_number,
                'voter_id_number' => $request->voter_id_number,
                'address' => $request->address,
            ]);
        }
        
        // Check if the transaction type is a deposit, and store the transaction
        
        AccountTransaction::create([
            'transaction_id' => $savingsAccount->id, // Link the transaction to the savings account
            'transaction_type' => SavingsAccount::class,  // The type of account (Savings)
            'account_type' => 'savings', // Type of account (Savings)
            'action_type' => 'deposit', // Type of transaction (Deposit)
            'amount' => $request->minimum_amount, // Amount for the deposit
            'payment_mode' => $request->payment_mode, // Payment mode (e.g., cash, cheque, online)
            'cheque_number' => $request->cheque_number,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'cheque_date' => $request->cheque_date,
            'online_transaction_id' => $request->online_transaction_id,
            'payment_gateway' => $request->payment_gateway,
            'remarks' => $request->remarks,
            'cash_1' => $request->cash_1,
            'cash_5' => $request->cash_5,
            'cash_10' => $request->cash_10,
            'cash_20' => $request->cash_20,
            'cash_50' => $request->cash_50,
            'cash_100' => $request->cash_100,
            'cash_200' => $request->cash_200,
            'cash_500' => $request->cash_500,
            'status' => 'pending',  // Transaction status (could be pending if not approved yet)
            'transaction_date' => now(),  // Current timestamp
            'processed_by' => auth()->id(),  // The user who processed the transaction
        ]);

            // Call the method to update financial records
            $this->updateFinances('deposit', $request->minimum_amount, $request->branch_id, auth()->id());
            
        //   $company = Company::firstOrFail(); // Fetch the company details
        //   if ($company && $savingsAccount->member->email) {
        //     Mail::to($savingsAccount->member->email)->send(new SavingsAccountCreated($savingsAccount, $company));
        //   }

            // Return success message
        return redirect()->route('sa.index')->with('success', 'Savings account created and transaction processed successfully.');
    }
    //update status
    public function updateSAStatus(Request $request, $id)
    {
        try {
            $account = SavingsAccount::findOrFail($id);
    
            // Validate the status input
            $request->validate([
                'status' => 'required|in:approved,rejected',
            ]);
    
            // Update the status
            $account->status = $request->input('status');
    
            // Set the approved field based on the status
            $account->approved_by = auth()->id(); // Set the user who approved (using the authenticated user's ID)
            $account->approved_at = now(); // Set the timestamp when approved
        
            // Save the changes
            $account->save();
    
            return redirect()->back()->with('success', 'Account status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update account status. Please try again.');
        }
    }

    //Rd Accounts index 
    public function RdAccount(Request $request)
    {
        // Capture search query
        $search = $request->input('search', '');

        // Apply search query and paginate for SavingAccountPlans
        $accounts = RdAccount::when($search, function ($query, $search) {
            return $query->where('account_number', 'like', "%{$search}%")
                ->orWhereHas('member', function ($q) use ($search) {
                    $q->where('member_code', 'like', "%{$search}%")
                      ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
                });
        })->paginate(50);

        // Return view with search and paginated results
        return view('accounts.RdAccount', compact('accounts', 'search'));
    }      

    //Create savings account
    public function CreateRDAccount(Request $request)
    {
      $branches = Branch::all();
      $members = Memeber::all(); // Assuming you have a Member model
      $agents = User::where('user_type', 'Agent')
                ->orWhere('user_type', 'Employee')
                ->get(); // Assuming you have an Agent model
      $rdPlans = RdAccountPlan::all(); // Assuming you have a SavingsPlan model

      return view('accounts.RdAcForm', compact('branches','members','agents','rdPlans'));
    }
    
    //Create RD Accounts
    public function storeRDAccount(Request $request)
    {
        // dd($request->all());
            // Check if the member already has an active savings account
        $existingAccount = RdAccount::where('member_id', $request->member_id)->first();

        // if ($existingAccount) {
        //     // If an existing account is found, return with an error message
        //     return redirect()->back()->with('error', 'This member already has an active savings account.');
        // }
        // Validation of the incoming request
        $request->validate([
            'member_id' => 'required|exists:memebers,id',
            'branch_id' => 'required|exists:branches,id',
            'rd_plan_id' => 'required|exists:rd_account_plans,id',
            'agent_id' => 'nullable|exists:users,id', // Add agent_id validation
            'minimum_amount' => 'required|numeric|min:0', 
            'opeaning_date' => 'required|date|before_or_equal:today', // Validation for opening_date
            'transaction_date' => 'required|date|before_or_equal:today', // Validation for transaction_date

            'opened_with_less_minimum' => 'nullable|boolean',
            'account_on_hold' => 'nullable|boolean',
            'is_joint_account' => 'nullable|boolean',
            'has_nominee' => 'nullable|boolean',

            'tds' => 'nullable|boolean',
            'renew' => 'nullable|boolean',
            'st' => 'nullable|boolean',

            'joint_member_id' => 'nullable|exists:memebers,id',
            
            'nominee_name' => 'nullable|string',
            'relationship' => 'nullable|string',
            'aadhar_number' => 'nullable|string|size:12', // Aadhar Number validation
            'voter_id_number' => 'nullable|string|max:20', // Voter ID Number validation
            'phone_number' => 'nullable|regex:/^[0-9]{10}$/', // Phone number validation (10 digits)
            'address' => 'nullable|string|max:255', // Address validation (maximum length 255 characters)
            
            'payment_mode' => 'required|string|in:cash,cheque,online',

            // Cash Section Validation
            'cash_1' => 'nullable|numeric|min:0',
            'cash_5' => 'nullable|numeric|min:0',
            'cash_10' => 'nullable|numeric|min:0',
            'cash_20' => 'nullable|numeric|min:0',
            'cash_50' => 'nullable|numeric|min:0',
            'cash_100' => 'nullable|numeric|min:0',
            'cash_200' => 'nullable|numeric|min:0',
            'cash_500' => 'nullable|numeric|min:0',

            // Cheque Section Validation
            'cheque_number' => 'nullable|string|max:20',
            'bank_name' => 'nullable|string|max:100',
            'branch_name' => 'nullable|string|max:100',
            'cheque_date' => 'nullable|date|before_or_equal:today',

            // Online Section Validation
            'online_transaction_id' => 'nullable|string|max:100',
            'payment_gateway' => 'nullable|string|max:100',
            'remarks' => 'nullable|string|max:500',      
        ]);
        
        $agentId = null;
        $employeeId = null;
        if ($request->has('agent_id')) {
            // Check if the agent_id exists in the users table and if the user_type is 'Agent'
            $user = User::find($request->agent_id);
            
            if ($user && $user->user_type === 'Agent') {
                $agentId = $request->agent_id;  // Store agent_id if the user_type is 'Agent'
            } else {
                $employeeId = $request->agent_id;  // If not an Agent, store it as employee_id
            }
        }

        // Create a new Savings Account entry with the validated data
        $rdAccount = new RdAccount([
            'member_id' => $request->member_id,
            'branch_id' => $request->branch_id,
            'agent_id' => $agentId,  // Store the agent_id if provided
            'employee_id' => $employeeId,  // Store the employee_id if provided
            'rd_plan_id' => $request->rd_plan_id,
            'balance' => $request->minimum_amount,  // Default balance, can be modified later
            'is_joint' => (bool) $request->is_joint_account,
            'joint_member_id' => $request->joint_member_id,
            'opened_with_less_minimum' => (bool) $request->opened_with_less_minimum,
            'nominee' => (bool) $request->has_nominee,
            'account_status' => $request->account_on_hold == 1 ? 'on_hold' : 'active',

            'tds' => (bool) $request->tds,
            'renew' => (bool) $request->renew,
            'st' => (bool) $request->st,

            'opeaning_date' => $request->opeaning_date,
        ]);


        // Save the savings account to the database
        $rdAccount->save();

        // Check if the account has a nominee and store the nominee
        if($request->has_nominee) {
            Nominee::create([
                'account_id' => $rdAccount->id,  // Link the nominee to the savings account
                'account_type' => RdAccount::class,  // The type of account (Polymorphic)
                'nominee_name' => $request->nominee_name,
                'relationship' => $request->relationship,
                'nominee_status' => 'active',  // Default status
                'phone_number' => $request->phone_number,
                'aadhar_number' => $request->aadhar_number,
                'voter_id_number' => $request->voter_id_number,
                'address' => $request->address,
            ]);
        }
        
        // Check if the transaction type is a deposit, and store the transaction
        
        AccountTransaction::create([
            'transaction_id' => $rdAccount->id, // Link the transaction to the savings account
            'transaction_type' => RdAccount::class,  // The type of account (Savings)
            'account_type' => 'rd', // Type of account (rd)
            'action_type' => 'deposit', // Type of transaction (Deposit)
            'amount' => $request->minimum_amount, // Amount for the deposit
            'payment_mode' => $request->payment_mode, // Payment mode (e.g., cash, cheque, online)
            'cheque_number' => $request->cheque_number,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'cheque_date' => $request->cheque_date,
            'online_transaction_id' => $request->online_transaction_id,
            'payment_gateway' => $request->payment_gateway,
            'remarks' => $request->remarks,
            'cash_1' => $request->cash_1,
            'cash_5' => $request->cash_5,
            'cash_10' => $request->cash_10,
            'cash_20' => $request->cash_20,
            'cash_50' => $request->cash_50,
            'cash_100' => $request->cash_100,
            'cash_200' => $request->cash_200,
            'cash_500' => $request->cash_500,
            'status' => 'pending',  // Transaction status (could be pending if not approved yet)
            'transaction_date' => now(),  // Current timestamp
            'tr_date' => $request->transaction_date,
            'processed_by' => auth()->id(),  // The user who processed the transaction
        ]);

        // Call the method to update financial records
        $this->updateFinances('deposit', $request->minimum_amount, $request->branch_id, auth()->id());
        
        
        // $company = Company::firstOrFail(); // Fetch the company details
        // if ($company && $rdAccount->member->email) {
        //   Mail::to($rdAccount->member->email)->send(new RdAccountCreated($rdAccount, $company));
        // }

            // Return success message
        return redirect()->route('rdAc.account')->with('success', 'RD account created and transaction processed successfully.');
    }

    //pending RD Account action 
    public function unapproveRDAccount(Request $request){
          // Capture search query
          $search = $request->input('search', '');

          // Apply search query, filter for accounts where `approved_by` is null, and paginate
          $accounts = RdAccount::when($search, function ($query, $search) {
                return $query->where('account_number', 'like', "%{$search}%")
                ->orWhereHas('member', function ($q) use ($search) {
                    $q->where('member_code', 'like', "%{$search}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
                });
              })->where('status', '!=', 'approved') // Filter accounts with approved_by as null
              ->paginate(50); // Paginate results per page

          // Return view with search and paginated results
          return view('accounts.RDAcApproval', compact('accounts', 'search'));
    }

    //update status
    public function updateRDStatus(Request $request, $id)
    {
        try {
            $account = RdAccount::findOrFail($id);
    
            // Validate the status input
            $request->validate([
                'status' => 'required|in:approved,rejected',
            ]);
    
            // Update the status
            $account->status = $request->input('status');
    
            // Set the approved field based on the status
            $account->approved_by = auth()->id(); // Set the user who approved (using the authenticated user's ID)
            $account->approved_at = now(); // Set the timestamp when approved
        
            // Save the changes
            $account->save();
    
            return redirect()->back()->with('success', 'Account status updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update account status. Please try again.');
        }
    }

    //savings account profile 
    public function SAProfile(Request $request, $id)
    {
        $account = SavingsAccount::find($id);

         // Fetch all transactions associated with this account
        $transactions = AccountTransaction::where('transaction_id', $account->id)
        ->where('transaction_type', SavingsAccount::class)
        ->get();

        // Fetch only deposit transactions for this account
        $depositLogs = AccountTransaction::where('transaction_id', $account->id)
        ->where('transaction_type', SavingsAccount::class)
        ->where('action_type', 'deposit')  // Filter for deposit transactions
        ->get();

        return view('accounts.SAProfile', compact('account','transactions','depositLogs'));
    }
    
    
    public function DepositBlncIndex(Request $request){
         // Return view with search and paginated results
         return view('accounts.DepositBlnc');
    }

    public function SAsearch(Request $request){
        $accountNumber = $request->query('account_number');

        // Validate the input
        if (!$accountNumber) {
            return response()->json(['error' => 'Account number is required'], 400);
        }

        // Search for the account
        $account = SavingsAccount::where('account_number', $request->account_number)->first();


        // If account not found, return error message
        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        // Return account details
        return response()->json([
            'success' => true,  // Add success key
            'id' => $account->id,
            'branch_id' => $account->branch_id,
            'branch_name' => $account->branch->branch_name,
            'account_holder_name' => "{$account->member->first_name} {$account->member->last_name}",
            'account_number' => $account->account_number,
            'balance' => $account->balance
        ]);
    }

    public function RDsearch(Request $request){
        $accountNumber = $request->query('account_number');

        // Validate the input
        if (!$accountNumber) {
            return response()->json(['error' => 'Account number is required'], 400);
        }

        // Search for the account
        $account = RdAccount::where('account_number', $request->account_number)->first();


        // If account not found, return error message
        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        // Return account details
        return response()->json([
            'success' => true,  // Add success key
            'id' => $account->id,
            'branch_id' => $account->branch_id,
            'branch_name' => $account->branch->branch_name,
            'account_holder_name' => "{$account->member->first_name} {$account->member->last_name}",
            'account_number' => $account->account_number,
            'balance' => $account->balance
        ]);
    }

    public function RDBlncIndex(Request $request){
        // Return view with search and paginated results
        return view('accounts.RDDepositBlnc');
    }

    //desposit withdrwal section here 
    // Deposit/Withdrawal section
    public function SVAcTransaction(Request $request)
    {
        // Fetch the savings account using the provided account_id
        $savingsAccount = SavingsAccount::findOrFail($request->account_id);

        // Store the transaction
        $transaction = AccountTransaction::create([
            'transaction_id' => $request->account_id, // Link the transaction to the savings account
            'transaction_type' => SavingsAccount::class,  // The type of account (Savings)
            'account_type' => 'savings', // Type of account (Savings)
            'action_type' => $request->payment_type, // Type of transaction (Deposit)
            'amount' => $request->amount, // Amount for the deposit
            'payment_mode' => $request->payment_mode, // Payment mode (e.g., cash, cheque, online)
            'cheque_number' => $request->cheque_number,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'cheque_date' => $request->cheque_date,
            'online_transaction_id' => $request->online_transaction_id,
            'payment_gateway' => $request->payment_gateway,
            'remarks' => $request->remarks,
            'cash_1' => $request->cash_1,
            'cash_5' => $request->cash_5,
            'cash_10' => $request->cash_10,
            'cash_20' => $request->cash_20,
            'cash_50' => $request->cash_50,
            'cash_100' => $request->cash_100,
            'cash_200' => $request->cash_200,
            'cash_500' => $request->cash_500,
            'status' => 'pending',  // Transaction status (could be pending if not approved yet)
            'transaction_date' => now(),  // Current timestamp
            'tr_date' => $request->transaction_date,
            'processed_by' => auth()->id(),  // The user who processed the transaction
        ]);

        // Update the savings account balance based on the transaction type (Deposit/Withdrawal)
        if ($request->payment_type == 'deposit') {
            // Increase the balance for a deposit
            $savingsAccount->balance += $request->amount;
        } elseif ($request->payment_type == 'withdrawal') {
            // Decrease the balance for a withdrawal
            if ($savingsAccount->balance >= $request->amount) {
                $savingsAccount->balance -= $request->amount;
            } else {
                return back()->with('error', 'Insufficient balance for withdrawal.');
            }
        }

        // Save the updated savings account balance
        $savingsAccount->save();

        // Call the method to update financial records
        $this->updateFinances($request->payment_type, $request->amount, $request->branch_id, auth()->id());
        
         // Send the transaction update email
        // $company = Company::firstOrFail(); // Fetch the company details
        // if ($company && $savingsAccount->member->email) { 
        //     Mail::to($savingsAccount->member->email)->send(new SavingsTransaction($company, $savingsAccount,  $transaction));
        // }

        return back()->with('success', 'Transaction processed successfully.');
    }

    //Rd profile section 
    public function RDProfile(Request $request, $id){

        $account = RdAccount::find($id);

        // Fetch all transactions associated with this account
       $transactions = AccountTransaction::where('transaction_id', $account->id)
       ->where('transaction_type', RdAccount::class)
       ->get();

       // Fetch only deposit transactions for this account
       $depositLogs = AccountTransaction::where('transaction_id', $account->id)
       ->where('transaction_type', RdAccount::class)
       ->where('action_type', 'deposit')  // Filter for deposit transactions
       ->get();

       return view('accounts.RDProfile', compact('account','transactions','depositLogs'));
    }

    //Rd profile update 

    public function RDAcTransaction(Request $request)
    {
        // Fetch the savings account using the provided account_id
        $savingsAccount = RdAccount::findOrFail($request->account_id);

        // Store the transaction
        $transaction = AccountTransaction::create([
            'transaction_id' => $request->account_id, // Link the transaction to the savings account
            'transaction_type' => RdAccount::class,  // The type of account (Savings)
            'account_type' => 'rd', // Type of account (Savings)
            'action_type' => 'deposit', // Type of transaction (Deposit)
            'amount' => $request->amount, // Amount for the deposit
            'payment_mode' => $request->payment_mode, // Payment mode (e.g., cash, cheque, online)
            'cheque_number' => $request->cheque_number,
            'bank_name' => $request->bank_name,
            'branch_name' => $request->branch_name,
            'cheque_date' => $request->cheque_date,
            'online_transaction_id' => $request->online_transaction_id,
            'payment_gateway' => $request->payment_gateway,
            'remarks' => $request->remarks,
            'cash_1' => $request->cash_1,
            'cash_5' => $request->cash_5,
            'cash_10' => $request->cash_10,
            'cash_20' => $request->cash_20,
            'cash_50' => $request->cash_50,
            'cash_100' => $request->cash_100,
            'cash_200' => $request->cash_200,
            'cash_500' => $request->cash_500,
            'status' => 'pending',  // Transaction status (could be pending if not approved yet)
            'transaction_date' => now(),  // Current timestamp
            'tr_date' => $request->transaction_date,
            'processed_by' => auth()->id(),  // The user who processed the transaction
        ]);

       
        $savingsAccount->balance += $request->amount;
        

        // Save the updated savings account balance
        $savingsAccount->save();

        // Call the method to update financial records
        $this->updateFinances('deposit', $request->amount, $request->branch_id, auth()->id());
        
         // Send the transaction update email
        //  $company = Company::firstOrFail(); // Fetch the company details
        //  if ($company && $savingsAccount->member->email) { 
        //      Mail::to($savingsAccount->member->email)->send(new RdDeposit($company, $savingsAccount,  $transaction));
        //  }
        
         // Send the transaction update email
        try {
            $company = Company::firstOrFail(); // Fetch the company details
            if ($company && $savingsAccount->member->email) { 
                Mail::to($savingsAccount->member->email)->send(new RdDeposit($company, $savingsAccount, $transaction));
            }
        } catch (\Exception $e) {
            // Log the email error but continue the execution
            \Log::error('Email sending failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Transaction processed successfully.');
    }

    // Private function to handle financial updates
    private function updateFinances($transactionType, $amount, $branchId = null, $processedBy)
    {

        // dd($branchId);
        // Update Company Finances
        // $companyFinance = CompanyFinances::first();
        // if (!$companyFinance) {
        //     $companyFinance = new CompanyFinances();
        //     // Initialize default values
        //     $companyFinance->total_deposits = 0;
        //     $companyFinance->total_withdrawals = 0;
        //     $companyFinance->total_income = 0;
        //     $companyFinance->total_expenses = 0;
        //     $companyFinance->net_balance = 0;
        // }

        // switch ($transactionType) {
        //     case 'deposit':
        //         $companyFinance->total_deposits += $amount;
        //         $companyFinance->net_balance += $amount;
        //         break;
        //     case 'withdrawal':
        //         $companyFinance->total_withdrawals += $amount;
        //         $companyFinance->net_balance -= $amount;
        //         break;
        //     case 'income':
        //         $companyFinance->total_income += $amount;
        //         $companyFinance->net_balance += $amount;
        //         break;
        //     case 'expense':
        //         $companyFinance->total_expenses += $amount;
        //         $companyFinance->net_balance -= $amount;
        //         break;
        // }
        // $companyFinance->save();

        // Ensure Branch Finance Exists Before Updating
        if ($branchId) {
            $branchFinance = BranchFinances::where('branch_id', $branchId)->first();

            if (!$branchFinance) {
                // Create a new record with default values
                $branchFinance = new BranchFinances();
                $branchFinance->branch_id = $branchId;
                $branchFinance->total_deposits = 0;
                $branchFinance->total_withdrawals = 0;
                $branchFinance->total_income = 0;
                $branchFinance->total_expenses = 0;
                $branchFinance->net_balance = 0;
            }

            switch ($transactionType) {
                case 'deposit':
                    $branchFinance->total_deposits += $amount;
                    $branchFinance->net_balance += $amount;
                    break;
                case 'withdrawal':
                    $branchFinance->total_withdrawals += $amount;
                    $branchFinance->net_balance -= $amount;
                    break;
                case 'income':
                    $branchFinance->total_income += $amount;
                    $branchFinance->net_balance += $amount;
                    break;
                case 'expense':
                    $branchFinance->total_expenses += $amount;
                    $branchFinance->net_balance -= $amount;
                    break;
            }
            $branchFinance->save();
        }
    }
    
    
    public function TransactionIndex(Request $request)
    {
        $transactions = collect(); // Empty collection by default
         // Check if date range input exists
        if ($request->has('date_range') && !empty($request->date_range)) {
            // Extract start and end date from the date range input
            $dateRange = explode(' - ', $request->date_range);
            $startDate = Carbon::parse($dateRange[0])->startOfDay();
            $endDate = Carbon::parse($dateRange[1])->endOfDay();

            // Fetch transactions based on the date range
            $transactions = AccountTransaction::whereBetween('transaction_date', [$startDate, $endDate])
                ->orderBy('transaction_date', 'desc')
                ->get();
        }

        return view('accounts.Transaction' , compact('transactions'));
    }


    public function PendingTransaction(Request $request)
    {
        $branches = Branch::all(); // Fetch all branches
        $transactions = collect(); // Default empty collection

        // Check if any filter is applied
        if (
            $request->filled('employee_id') ||
            $request->filled('account_type') ||
            $request->filled('date_range')
        ) {
            $query = AccountTransaction::query();


            // Apply Employee Filter
            // if ($request->filled('employee_id') && $request->employee_id !== 'all') {
            //     $query->where('processed_by', $request->employee_id);
            // }
            /*beccoz it traget employee table id but in db it user user table id */
            
            if ($request->filled('employee_id') && $request->employee_id !== 'all') {
                $user = User::where('user_type', 'Employee')
                            ->where('type_id', $request->employee_id)
                            ->first();
            
                if ($user) {
                    $query->where('processed_by', $user->id);
                } else {
                    // No matching user, force no results
                    $query->whereNull('processed_by');
                }
            }

            // Apply Account Type Filter
            // Apply Account Type Filter
            if ($request->filled('account_type') && $request->account_type !== 'all') {
                $query->where('account_type', $request->account_type);
            }
            //filter dates 
            $dateRange = explode(' - ', $request->date_range);
            $startDate = Carbon::parse($dateRange[0])->startOfDay();
            $endDate = Carbon::parse($dateRange[1])->endOfDay();

            // Apply Date Range Filter
            if ($startDate && $endDate) {
                $query->whereBetween('transaction_date', [
                    $startDate,
                    $endDate
                ]);
            }

            // Fetch the filtered transactions with pagination
            $transactions = $query->orderBy('transaction_date', 'desc')->get();
        }

        return view('accounts.PendingTransaction', compact('transactions','branches')); 
        // return view('accounts.PendingTransaction', compact('transactions','search'));
    }


    /**
     * Approve a single transaction.
     */
    public function approveSingleTransaction($id)
    {
        $transaction = AccountTransaction::findOrFail($id);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaction cannot processed.');
        }

        $transaction->update([
            'status' => 'approved',
            'approved_by' => auth()->id(), // Store the ID of the approver
            'approved_at' => now(),        // Store the timestamp of approval
        ]);

        return back()->with('success', 'Transaction approved successfully.');
    }

    /**
     * Approve multiple transactions.
     */
    public function approveMultipleTransactions(Request $request)
    {
        $transactionIds = $request->input('selected_transactions', []);

        if (empty($transactionIds)) {
            return back()->with('error', 'No transactions selected.');
        }

        AccountTransaction::whereIn('id', $transactionIds)
            ->where('status', 'pending')
            ->update([
                'status' => 'approved',
                'approved_by' => auth()->id(), // Store the ID of the approver
                'approved_at' => now(),        // Store the timestamp of approval
            ]);

        return back()->with('success', count($transactionIds) . 'Transactions approved successfully.');
    }


    public function revertTransaction($id)
    {
        // Fetch the transaction
        $transaction = AccountTransaction::findOrFail($id);

        // Check if the transaction is already reverted
        if ($transaction->status == 'rejected') {
            return back()->with('error', 'Transaction is already reverted.');
        }

        $branchId = optional($transaction->transaction)->branch_id;

        // Reverse the transaction type
        // $reverseType = ($transaction->action_type == 'deposit') ? 'withdrawal' : 'deposit';

        // Reverse the financial updates correctly
        $this->revertFinanceTransaction($transaction->action_type, $transaction->amount, $branchId, auth()->id());

        // Reverse the savings account balance
        $savingsAccount = SavingsAccount::find($transaction->transaction_id);
        if ($savingsAccount) {
            if ($transaction->action_type == 'deposit') {
                // Deduct the deposit amount from the balance
                $savingsAccount->balance -= $transaction->amount;
            } elseif ($transaction->action_type == 'withdrawal') {
                // Add back the withdrawn amount
                $savingsAccount->balance += $transaction->amount;
            }
            $savingsAccount->save();
        }

        // Mark the transaction as reverted
        $transaction->status = 'rejected';

        $transaction->approved_by = auth()->id(); // Store the ID of the approver
        $transaction->approved_at = now();    // Store the timestamp of approval
       
        $transaction->save();

        return back()->with('success', 'Transaction reverted successfully.');
    }


    private function revertFinanceTransaction($transactionType, $amount, $branchId = null, $processedBy)
    {
        // Update Company Finances
        // $companyFinance = CompanyFinances::first();
        // if (!$companyFinance) {
        //     $companyFinance = new CompanyFinances();
        // }

        // switch ($transactionType) {
        //     case 'deposit':  // Undo deposit
        //         $companyFinance->total_deposits -= $amount;
        //         $companyFinance->net_balance -= $amount;
        //         break;
        //     case 'withdrawal':  // Undo withdrawal
        //         $companyFinance->total_withdrawals -= $amount;
        //         $companyFinance->net_balance += $amount;
        //         break;
        //     case 'income':  // Undo income
        //         $companyFinance->total_income -= $amount;
        //         $companyFinance->net_balance -= $amount;
        //         break;
        //     case 'expense':  // Undo expense
        //         $companyFinance->total_expenses -= $amount;
        //         $companyFinance->net_balance += $amount;
        //         break;
        // }
        // $companyFinance->save();

        // Update Branch Finances
        if ($branchId) {
            $branchFinance = BranchFinances::where('branch_id', $branchId)->first();
            if (!$branchFinance) {
                $branchFinance = new BranchFinances();
                $branchFinance->branch_id = $branchId;
            }

            switch ($transactionType) {
                case 'deposit':  // Undo deposit
                    $branchFinance->total_deposits -= $amount;
                    $branchFinance->net_balance -= $amount;
                    break;
                case 'withdrawal':  // Undo withdrawal
                    $branchFinance->total_withdrawals -= $amount;
                    $branchFinance->net_balance += $amount;
                    break;
                case 'income':  // Undo income
                    $branchFinance->total_income -= $amount;
                    $branchFinance->net_balance -= $amount;
                    break;
                case 'expense':  // Undo expense
                    $branchFinance->total_expenses -= $amount;
                    $branchFinance->net_balance += $amount;
                    break;
            }
            $branchFinance->save();
        }else{
            return;
        }

      
    }
    
    
     public function RDcalculate(Request $request, RdAccountService $rdService)
    {
        $account = RdAccount::find($request->id);
    
        if (!$account) {
            return response()->json(['status' => 'error', 'message' => 'RD account not found'], 404);
        }
    
        try {
            $rdService->calculateFields($account);
    
            return response()->json([
                'status' => 'success',
                'message' => "RD Account #{$account->id} updated successfully.",
                'data' => [
                    'principal' => $account->principal_amount,
                    'interest' => $account->total_interest,
                    'maturity_amount' => $account->total_payable_amount,
                    'maturity_date' => $account->maturity_date->format('Y-m-d'),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    public function RDAccountQshow($id)
    {
        $account = RdAccount::with('branch') // if branch is a relation
        ->findOrFail($id);

        $due = $account->principal_amount - $account->balance;

        return response()->json([
            'member_code' => $account->member->member_code,
            'member_name' => "{$account->member->first_name} {$account->member->last_name}",
            'account_number' => $account->account_number,
            'branch' => $account->branch->branch_name ?? 'N/A',
            'installment_amount' => $account->rd_installment_amount,
            'tenure_duration_days' => $account->tenure_duration_days,
            'principal_amount' => $account->principal_amount,
            'interest_rate_percentage' => $account->interest_rate_percentage,
            'total_interest' => $account->total_interest,
            'maturity_date' => $account->maturity_date,
            'maturity_balance' => $account->maturity_balance,
            'current_amount' => $account->balance,
            'due_blance' => $due,
        ]);
    }
    
    public function getAccountNumber($memberId, $depositType)
    {
        $accounts = [];

        switch ($depositType) {
            case 'RD':
                $accounts = RdAccount::where('member_id', $memberId)->pluck('account_number');
                break;
            case 'FD':
                // $accounts = FdAccount::where('member_id', $memberId)->pluck('account_number');
                break;
            case 'MIS':
                // $accounts = MisAccount::where('member_id', $memberId)->pluck('account_number');
                break;
            default:
                return response()->json(['accounts' => []]);
        }

        return response()->json([
            'accounts' => $accounts
        ]);
    }

    public function getAssetValues(Request $request)
    {
        $depositType = $request->query('deposit_type');
        $accountNumber = $request->query('account_number');
        $planId = $request->query('plan_id');

        $plan = LoanAgainstDepositPlan::find($planId);

        if (!$depositType || !$accountNumber || !$planId) {
            return response()->json([
                'asset_value' => null,
                'asset_paid_value' => null,
                'loan_approval_amount' => null,
            ]);
        }
        
        if (!$plan || !$plan->ltv_ratio) {
            return response()->json([
                'asset_value' => 0,
                'asset_paid_value' => 01,
                'loan_approval_amount' => 20,
            ]);
        }

        $assetValue = null;
        $assetPaidValue = null;
        $loanApprovalAmount = null;

        switch ($depositType) {
            case 'RD':
                // Assuming RdAccount is your model
                $account = RdAccount::where('account_number', $accountNumber)->first();

                if ($account) {
                    $assetValue = $account->principal_amount;
                    $assetPaidValue = $account->balance;
                    $loanApprovalAmount = $assetValue * ($plan->ltv_ratio / 100);
                }
                break;

            default:
                return response()->json([
                    'asset_value' => null,
                    'asset_paid_value' => null,
                    'loan_approval_amount' => null,
                ]);
        }


        return response()->json([
            'asset_value' => $assetValue,
            'asset_paid_value' => $assetPaidValue,
            'loan_approval_amount' => $loanApprovalAmount,
        ]);
    }

  
}
