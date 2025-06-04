<?php

namespace App\Http\Controllers;
use App\Models\SavingAccountPlan;
use App\Models\FdPlan;
use App\Models\DdAccountPlan;
use App\Models\RdAccountPlan;
use App\Models\RdAccount;
use App\Models\LoanAgainstDepositPlan;
use App\Models\LoanAD;
use App\Models\User;
use App\Models\Memeber;
use App\Models\Branch;
use App\Models\MarketCode;
use Illuminate\Support\Facades\Auth; // Make sure this is at the top
use Carbon\Carbon; // Optional if you want to use Carbon
use Illuminate\Http\Request;

class LoanController extends Controller
{
    // Show the form page
    public function showAdForm()
    {
        $plans = LoanAgainstDepositPlan::where('status', true)->get();
        return view('loan.loan-calculator', compact('plans'));
    }

    // Calculate the loan details
    public function calculateAdLoan(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:loan_against_deposit_plans,id',
            'loan_amount' => 'required|numeric|min:1',
        ]);

        $plan = LoanAgainstDepositPlan::findOrFail($request->plan_id);
        $loanAmount = $request->loan_amount;

        // Flat interest calculation
        $interestAmount = ($loanAmount * $plan->interest_rate) / 100;
        $totalPayable = $loanAmount + $interestAmount;

        // Processing fees and other deductions
        $processingFee = ($loanAmount * $plan->processing_fee) / 100;
        $stampDuty = ($loanAmount * $plan->stamp_duty_rate) / 100;
        $insurance = ($loanAmount * $plan->insurance_rate) / 100;

        $totalDeductions = $processingFee + $stampDuty + $insurance;
        $netDisbursalAmount = $loanAmount - $totalDeductions;

        $tenureMonths = $plan->tenure_months;
        $emiCount = 0;
        $emi = 0;

        // Calculate EMI based on emi_type
        switch ($plan->emi_type) {
            case 'daily':
                $emiCount = $tenureMonths * 30; // approx. days
                break;

            case 'monthly':
                $emiCount = $tenureMonths;
                break;

            case 'quarterly':
                $emiCount = ceil($tenureMonths / 3);
                break;

            case 'annually':
                $emiCount = ceil($tenureMonths / 12);
                break;
        }

        if ($emiCount > 0) {
            $emi = $totalPayable / $emiCount;
        }

        $graceDays = $plan->grace_period_days;
        $emiStartDate = now()->addDays($graceDays)->format('Y-m-d');

        return response()->json([
            'plan_name' => $plan->plan_name,
            'loan_amount' => number_format($loanAmount, 2),
            'interest_amount' => number_format($interestAmount, 2),
            'total_payable' => number_format($totalPayable, 2),
            'processing_fee' => number_format($processingFee, 2),
            'stamp_duty' => number_format($stampDuty, 2),
            'insurance' => number_format($insurance, 2),
            'total_deductions' => number_format($totalDeductions, 2),
            'net_disbursal_amount' => number_format($netDisbursalAmount, 2),
            'emi' => number_format($emi, 2),
            'number_of_emis' => $emiCount,
            'emi_start_date' => $emiStartDate,
            'emi_type' => $plan->emi_type,
        ]);
    }

    
    //
    public function LoanADApplication(Request $request){
        // Capture search query
        $search = $request->input('search', '');

        // Apply search query and paginate for SavingAccountPlans
        $accounts = LoanAD::with(['member', 'marketcode']) // eager load relationships
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('application_number', 'like', "%{$search}%")
                  ->orWhereHas('member', function ($q) use ($search) {
                      $q->where('member_code', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                  })
                  ->orWhereHas('marketcode', function ($q) use ($search) {
                      $q->where('code', 'like', "%{$search}%")
                        ->orWhere('area_name', 'like', "%{$search}%");
                  });
            });
        })->paginate(50);
        // Corrected status filter 
        // Filter accounts with approved_by not null
        // Paginate results per page

        // Return view with search and paginated results
        return view('accounts.LoanAdApplication', compact('accounts', 'search'));
    }

    public function CreateLoanADapplication(Request $request){
        // Fetch all SavingAccountPlans
        $plans = LoanAgainstDepositPlan::all();
        $marketCodes = MarketCode::all();
        // Fetch all Branches
        $branches = Branch::all();
        $members = Memeber::all(); // Assuming you have a Member model
        $agents = User::where('user_type', 'Agent')
                  ->orWhere('user_type', 'Employee')
                  ->get(); // Assuming you have an Agent model

        // Return view with plans and branches
        return view('accounts.createLoanADapplication', compact('plans', 'branches','members','agents','marketCodes'));
    }

    public function StoreLoanADCreated(Request $request){
          // Validate request data
          $request->validate([
            'rd_plan_id' => 'required|exists:loan_against_deposit_plans,id',
            'member_id' => 'required',
            'branch_id' => 'required',
            'agent_id' => 'nullable',
            'deposit_type' => 'required|in:FD,RD,MIS',
            'deposit_account_number' => 'required',
            'minimum_amount' => 'required|numeric|min:0',
            'opeaning_date' => 'required|date',
            'market_code' => 'nullable|exists:market_codes,id',
        ]);


        // Get the maximum ID from the LoanADS table
        $maxId = LoanAD::max('id');
        // Generate the account number based on the max ID or any other logic
        $accountNumber = 'LAD' . str_pad($maxId + 1, 6, '0', STR_PAD_LEFT);

        // Generate application number
        $applicationNumber = 'APP' . str_pad($maxId + 1, 6, '0', STR_PAD_LEFT);

        // // Assign the generated account number
        // $loanApplication->account_number = $accountNumber;

        // Store data in loan_a_d_s table
        $loanAD = LoanAD::create([
            'account_number' => $accountNumber,
            'application_number' => $applicationNumber,
            'plan_id' => $request->rd_plan_id,
            'member_id' => $request->member_id,
            'branch_id' => $request->branch_id,
            'associate_id' => $request->agent_id,
            'against_type' =>  $request->deposit_type,
            'against_account_number' => $request->deposit_account_number,
            'application_balance' => $request->minimum_amount,
            'application_date' => $request->opeaning_date,
            'emi_amount' => 0.00,
            'marketcode_id' => $request->market_code,
            
            // New additions
            'application_by' => Auth::id(), // Logged-in user ID
            'application_approved_at' => now(), // Or use Carbon::now()
        ]);

        return redirect()->route('LoanADApplication.index')->with('success', 'Loan application creted successfully!');
    }

    public function checkLoanEligibility(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'loan_plan_id' => 'required|exists:loan_plans,id',
            'loan_amount' => 'required|numeric|min:0',
        ]);

        $member = Member::find($request->member_id);
        $loanPlan = LoanPlan::find($request->loan_plan_id);
        
        // Fetch deposit balance
        $depositBalance = $member->savingsAccount->balance ?? 0;

        // Calculate eligible loan amount (e.g., 80% of deposit balance)
        $eligibleAmount = $depositBalance * 0.8;

        // Calculate EMI (Example formula: (P × R × (1 + R)^N) / ((1 + R)^N - 1) )
        $interestRate = $loanPlan->interest_rate / 100 / 12; // Monthly rate
        $numMonths = $loanPlan->duration_months;
        $emi = ($eligibleAmount * $interestRate * pow(1 + $interestRate, $numMonths)) / 
            (pow(1 + $interestRate, $numMonths) - 1);

        return response()->json([
            'success' => true,
            'eligible_amount' => round($eligibleAmount, 2),
            'emi_amount' => round($emi, 2)
        ]);
    }

    public function checkEmiDetails(Request $request)
    {
        // $request->validate([
        //     'rd_plan_id' => 'required|exists:loan_against_deposit_plans,id',
        //     'emi_type' => 'required|in:daily,monthly,quarterly,annually',
        //     'requested_amount' => 'nullable|numeric|min:0',
        // ]);
    
        $plan = LoanAgainstDepositPlan::findOrFail($request->rd_plan_id);
        $loanAmount = $request->requested_amount;
        // Default to 0 if not provided

        // Flat interest calculation
        $interestAmount = ($loanAmount * $plan->interest_rate) / 100;
        $totalPayable = $loanAmount + $interestAmount;

        $tenureMonths = $plan->tenure_months;
        $emiCount = 0;
        $emi = 0;

        // Calculate EMI based on emi_type
        switch ($request->emi_type) {
            case 'daily':
                $emiCount = $tenureMonths * 30; // approx. days
                break;

            case 'monthly':
                $emiCount = $tenureMonths;
                break;

            case 'quarterly':
                $emiCount = ceil($tenureMonths / 3);
                break;

            case 'annually':
                $emiCount = ceil($tenureMonths / 12);
                break;
        }

        if ($emiCount > 0) {
            $emi = $totalPayable / $emiCount;
        }

        
    
       
    
        return response()->json([
            'loan_approval_amount' => $loanAmount,
            'interest_percentage' => $plan->interest_rate,
            'emi_amount' => $emi,
            'emi_count' =>  $emiCount,
            'total_payable' => $totalPayable,
        ]);
    }


    public function LoanAddelete($id)
    {
        $loan = LoanAD::findOrFail($id);

        // Check if the application is already approved
        if ($loan->application_approved_by !== null) {
            return redirect()->back()->with('error', 'Approved applications cannot be deleted.');
        }

        // Proceed to delete the record
        $loan->delete();

        return back()->with('success', 'Loan application deleted successfully.');
    }
    

    public function showJson($id)
    {
        $loan = LoanAD::with(['member', 'branch', 'marketcode', 'associated'])->findOrFail($id);

        // Temporary mock fields for approval/EMI until saved in DB
        $loan->approved_amount = $loan->approved_amount ?? 0;
        $loan->interest_rate = $loan->interest_rate ?? 0;
        $loan->emi_amount = $loan->emi_amount ?? 0;


        $loan->asset_type = $loan->against_type ?? 0;
        $loan->ac_no = $loan->against_account_number ?? 0;
        // Placeholder for additional data
        $additionalData = [];

        // Switch based on against_type
        switch ($loan->against_type) {
            case 'RD':
                $rdAccount = RdAccount::where('account_number', $loan->against_account_number)->first();

                if ($rdAccount) {
                    $additionalData['rd_principal_amount'] = $rdAccount->principal_amount;
                    $additionalData['rd_balance'] = $rdAccount->balance;
                } else {
                    $additionalData['rd_principal_amount'] = 0;
                    $additionalData['rd_balance'] = 0;
                }
                break;

            // You can add more cases later for FD, MIS, etc.

            default:
                // Optional: You could log or return some defaults
                break;
        }


            // Apply LTV ratio logic
        if ($loan->plan_id && $loan->application_balance) {
            $plan = LoanAgainstDepositPlan::find($loan->plan_id);

            if ($plan && $plan->ltv_ratio) {
                $ltvAmount = ($loan->application_balance * $plan->ltv_ratio) / 100;
                $additionalData['ltv_ratio'] = $plan->ltv_ratio;
                $additionalData['eligible_loan_amount'] = round($ltvAmount, 2);
            }
        }



        return response()->json(array_merge($loan->toArray(), $additionalData));
    }


    public function LoanADapprove(Request $request, $id)
    {
        $loan = LoanAD::findOrFail($id);
        $emiType = $request->emi_type;
        $approvalAmount = $request->approval_amount;

        $plan = LoanAgainstDepositPlan::findOrFail($loan->plan_id);

        // Flat interest calculation
        $interestAmount = ($approvalAmount * $plan->interest_rate) / 100;
        $totalPayable = $approvalAmount + $interestAmount;

        $tenureMonths = $plan->tenure_months;
        $emiCount = 0;
        $emi = 0;

        // Calculate EMI based on emi_type
        switch ($emiType) {
            case 'daily':
                $emiCount = $tenureMonths * 30; // approx. days
                break;

            case 'monthly':
                $emiCount = $tenureMonths;
                break;

            case 'quarterly':
                $emiCount = ceil($tenureMonths / 3);
                break;

            case 'annually':
                $emiCount = ceil($tenureMonths / 12);
                break;
        }

        if ($emiCount > 0) {
            $emi = $totalPayable / $emiCount;
        }

        
        // Update loan details
        
        $loan->interest_rate = $plan->interest_rate;
        $loan->approved_balance = $approvalAmount;
        $loan->emi_type = $emiType;
        $loan->number_of_emis = $emiCount;
        $loan->emi_amount = $emi;

        $loan->total_payable_amount = $totalPayable;
        $loan->remaining_balance = $totalPayable;
        $loan->tenure_months = $tenureMonths;


        $loan->application_status = 'approved';
        $loan->application_approved_by = Auth::id();
        $loan->application_approved_at = Carbon::now();

        $loan->loan_approval_status = 'approved';
        $loan->approved_by = Auth::id();
        $loan->approved_at = Carbon::now();

        $loan->save();

        return redirect()->back()->with('success', 'Loan approved successfully.');
    }


    public function LoanADreject(Request $request, $id)
    {
        $loan = LoanAD::findOrFail($id);

        $loan->application_status = 'rejected';
        $loan->application_rejected_by = Auth::id(); // Set current authenticated user
        $loan->application_rejected_at = Carbon::now(); // Set current timestamp

        $loan->save();
        return redirect()->back()->with('error', 'Loan rejected.');
    }


}
