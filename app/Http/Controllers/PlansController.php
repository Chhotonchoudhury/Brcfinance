<?php

namespace App\Http\Controllers;
use App\Models\SavingAccountPlan;
use App\Models\FdPlan;
use App\Models\DdAccountPlan;
use App\Models\RdAccountPlan;
use App\Models\LoanAgainstDepositPlan;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    //
    public function SavingIndex(Request $request)
    {
        // Capture search query
        $search = $request->input('search', '');

        // Apply search query and paginate for SavingAccountPlans
        $plans = SavingAccountPlan::when($search, function ($query, $search) {
            return $query->where('plan_code', 'like', "%{$search}%")
                        ->orWhere('plan_name', 'like', "%{$search}%")
                        ->orWhere('annual_interest_rate', 'like', "%{$search}%");
        })
        ->paginate(50); // Paginate results per page

        // Return view with search and paginated results
        return view('accountPlan.Savingindex', compact('plans', 'search'));
    }

    public function SavingForm($id = null)
    {
        if ($id) {
            // Fetch the SavingAccountPlan data for editing
            $plan = SavingAccountPlan::findOrFail($id);
            return view('accountPlan.Savingstore', ['plan' => $plan]);
        } else {
            // For creating a new SavingAccountPlan
            return view('accountPlan.Savingstore');
        }
    }

    public function storeOrUpdateSaving(Request $request, $id = null)
    {
        // Validation
        $validated = $request->validate([
            'plan_code' => 'required|string|unique:saving_account_plans,plan_code,' . ($id ?? 'NULL') . ',id',
            'plan_name' => 'required|string|max:255',
            'min_opening_balance' => 'required|numeric|min:0',
            'min_avg_balance' => 'required|numeric|min:0',
            'annual_interest_rate' => 'required|numeric|min:0|max:100',
            'senior_citizen_annual_interest_rate' => 'nullable|numeric|min:0|max:100',
            'interest_payout' => 'required|in:Monthly,Yearly,Half Yearly,Quarterly',
            'lock_in_amount' => 'required|numeric|min:0',
            'min_monthly_avg_balance_charge' => 'nullable|numeric|min:0',
            'sms_charge_frequency' => 'required|in:Monthly,Yearly',
            'sms_charge' => 'required|numeric|min:0',
            'card_charge_frequency' => 'required|in:Monthly,Yearly',
            'card_charge' => 'required|numeric|min:0',
            'free_ifsc_collection_per_month' => 'required|integer|min:0',
            'active' => 'required|boolean',
        ]);
    
        // Check if ID is provided (Update or Create)
        $plan = $id ? SavingAccountPlan::findOrFail($id) : new SavingAccountPlan();
    
        // Fill the data and save
        $plan->fill($validated);
        $plan->save();
    
        // Redirect with success message
        $message = $id ? 'Plan updated successfully' : 'Plan created successfully';
        return redirect()->route('saving.index')->with('success', $message);
    }



     //
    public function FdIndex(Request $request)
    {
         // Capture search query
         $search = $request->input('search', '');
 
         // Apply search query and paginate for SavingAccountPlans
         $fdPlans = FdPlan::when($search, function ($query, $search) {
             return $query->where('plan_code', 'like', "%{$search}%")
                         ->orWhere('plan_name', 'like', "%{$search}%")
                         ->orWhere('annual_interest_rate', 'like', "%{$search}%");
         })
         ->paginate(50); // Paginate results per page
 
         // Return view with search and paginated results
         return view('accountPlan.Fdindex', compact('fdPlans', 'search'));
    }

    public function FdForm($id = null)
    {
        if ($id) {
            // Fetch the SavingAccountPlan data for editing
            $plan = FdPlan::findOrFail($id);
            return view('accountPlan.Fdstore', ['plan' => $plan]);
        } else {
            // For creating a new SavingAccountPlan
            return view('accountPlan.Fdstore');
        }
    }

    public function storeOrUpdateFd(Request $request, $id = null)
    {
        // Validation
        $validated = $request->validate([
            'plan_code' => 'required|string|unique:fd_plans,plan_code,' . ($id ?? 'NULL') . ',id',
            'plan_name' => 'required|string|max:255',
            'min_amount' => 'required|numeric|min:0',
            'lockin_period' => 'required|string',
            'annual_interest_rate' => 'required|numeric|min:0|max:100',
            'senior_citizen_annual_interest_rate' => 'nullable|numeric|min:0|max:100',
            'interest_lockin_period' => 'required|string',
            'tenure_type' => 'required|in:month,year',
            'tenure_value' => 'required|integer|min:1',
            'interest_payout' => 'required|in:Monthly,Yearly,Quarterly',
            'cancellation_charge' => 'nullable|numeric|min:0',
            'penal_charge' => 'nullable|numeric|min:0',
            'active' => 'required|boolean',
        ]);
    
        // Check if ID is provided (Update or Create)
        $plan = $id ? FdPlan::findOrFail($id) : new FdPlan();
    
        // Fill the data and save
        $plan->fill($validated);
        $plan->save();
    
        // Redirect with success message
        $message = $id ? 'Plan updated successfully' : 'Plan created successfully';
        return redirect()->route('fd.index')->with('success', $message);
    }

    // 

    public function DdIndex(Request $request)
    {
         // Capture search query
         $search = $request->input('search', '');
 
         // Apply search query and paginate for SavingAccountPlans
         $ddPlans = DdAccountPlan::when($search, function ($query, $search) {
             return $query->where('plan_code', 'like', "%{$search}%")
                         ->orWhere('plan_name', 'like', "%{$search}%");
         })
         ->paginate(50); // Paginate results per page
 
         // Return view with search and paginated results
         return view('accountPlan.Ddindex', compact('ddPlans', 'search'));
    }

    public function DdForm($id = null)
    {
        if ($id) {
            // Fetch the SavingAccountPlan data for editing
            $plan = DdAccountPlan::findOrFail($id);
            return view('accountPlan.Ddstore', ['plan' => $plan]);
        } else {
            // For creating a new SavingAccountPlan
            return view('accountPlan.Ddstore');
        }
    }

    public function storeOrUpdateDd(Request $request, $id = null)
    {
        // Validation
        $validated = $request->validate([
            'plan_code' => 'required|string|unique:dd_account_plans,plan_code,' . ($id ?? 'NULL') . ',id',
            'plan_name' => 'required|string|max:255',
            'minimum_amount' => 'required|numeric|min:0',
            'lock_in_period' => 'required|string',
            'annual_interest_rate' => 'required|numeric|min:0|max:100',
            'senior_citizen_annual_interest_rate' => 'nullable|numeric|min:0|max:100',
            'interest_lock_in_period' => 'required|string',
            'tenure_type' => 'required|in:days,months,years',
            'tenure_value' => 'required|integer|min:1',
            'rd_dd_frequency' => 'required|in:monthly,quarterly,annually,daily',
            'interest_compounding_interval' => 'required|in:monthly,quarterly,annually',
            'skip_sunday' => 'nullable|in:0,1',
            'skip_saturday' => 'nullable|in:0,1',
            'cancellation_charge' => 'nullable|numeric|min:0',
            'penal_charge' => 'nullable|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        // Check if ID is provided (Update or Create)
        $plan = $id ? DdAccountPlan::findOrFail($id) : new DdAccountPlan();


         // Explicitly set skip_sunday and skip_saturday as boolean (1 or 0)
        $plan->skip_sunday = $request->has('skip_sunday') ? 1 : 0;
        $plan->skip_saturday = $request->has('skip_saturday') ? 1 : 0;

        // Fill the data and save
        $plan->fill($validated);
        $plan->save();

        // Redirect with success message
        $message = $id ? 'DD Plan updated successfully' : 'DD Plan created successfully';
        return redirect()->route('dd.index')->with('success', $message);
    }

    //Rd Account plans 

    public function RdIndex(Request $request){
        // Capture search query
        $search = $request->input('search', '');
 
        // Apply search query and paginate for SavingAccountPlans
        $ddPlans = RdAccountPlan::when($search, function ($query, $search) {
            return $query->where('plan_code', 'like', "%{$search}%")
                        ->orWhere('plan_name', 'like', "%{$search}%");
        })
        ->paginate(50); // Paginate results per page

        // Return view with search and paginated results
        return view('accountPlan.Rdindex', compact('ddPlans', 'search'));
    }

    public function RdForm($id = null)
    {
        if ($id) {
            // Fetch the SavingAccountPlan data for editing
            $plan = RdAccountPlan::findOrFail($id);
            return view('accountPlan.Rdstore', ['plan' => $plan]);
        } else {
            // For creating a new SavingAccountPlan
            return view('accountPlan.Rdstore');
        }
    }

    public function storeOrUpdateRd(Request $request, $id = null)
    {
        // Validation
        $validated = $request->validate([
            'plan_code' => 'required|string|unique:rd_account_plans,plan_code,' . ($id ?? 'NULL') . ',id',
            'plan_name' => 'required|string|max:255',
            'minimum_amount' => 'required|numeric|min:0',
            'lock_in_period' => 'required|string',
            'annual_interest_rate' => 'required|numeric|min:0|max:100',
            'senior_citizen_annual_interest_rate' => 'nullable|numeric|min:0|max:100',
            'interest_lock_in_period' => 'required|string',
            'tenure_type' => 'required|in:days,months,years',
            'tenure_value' => 'required|integer|min:1',
            'rd_dd_frequency' => 'required|in:monthly,quarterly,annually,daily',
            'interest_compounding_interval' => 'required|in:monthly,quarterly,annually',
            'cancellation_charge' => 'nullable|numeric|min:0',
            'penal_charge' => 'nullable|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        // Check if ID is provided (Update or Create)
        $plan = $id ? RdAccountPlan::findOrFail($id) : new RdAccountPlan();


        // Fill the data and save
        $plan->fill($validated);
        $plan->save();

        // Redirect with success message
        $message = $id ? 'RD Plan updated successfully' : 'RD Plan created successfully';
        return redirect()->route('rd.index')->with('success', $message);
    }
    
    
    
    // loan agains desposit 

    public function LoanADIndex(Request $request){
            // Capture search query
            $search = $request->input('search', '');

            // Apply search query and paginate for SavingAccountPlans
            $plans = LoanAgainstDepositPlan::when($search, function ($query, $search) {
                return $query->where('plan_code', 'like', "%{$search}%")
                            ->orWhere('plan_name', 'like', "%{$search}%")
                            ->orWhere('interest_rate', 'like', "%{$search}%");
            })
            ->paginate(50); // Paginate results per page
    
            // Return view with search and paginated results
            return view('accountPlan.LoanADindex', compact('plans', 'search'));
    }


    public function LoanADForm($id = null)
    {
        if ($id) {
            // Fetch the SavingAccountPlan data for editing
            $plan = LoanAgainstDepositPlan::findOrFail($id);
            return view('accountPlan.LoanAdstore', ['plan' => $plan]);
        } else {
            // For creating a new SavingAccountPlan
            return view('accountPlan.LoanAdstore');
        }
    }


     public function storeOrUpdateLoanAD(Request $request, $id = null)
    {
         // Validation
        $validated = $request->validate([
            'plan_code' => 'required|string|unique:loan_against_deposit_plans,plan_code,' . ($id ?? 'NULL') . ',id',
            'plan_name' => 'required|string|max:255',
            'deposit_type' => 'required|in:FD,RD,MIS', // Added deposit_type validation
            'interest_rate' => 'required|numeric|min:0|max:100', // Ensure correct naming
            'tenure_months' => 'required|integer|min:1', // Ensure valid tenure
            'ltv_ratio' => 'required|numeric|min:0|max:100',
            'min_loan_amount' => 'required|numeric|min:0',
            'max_loan_amount' => 'nullable|numeric|min:0',
            'processing_fee' => 'nullable|numeric|min:0',
            'emi_type' => 'required|in:daily,monthly,quarterly,half-yearly,yearly',
            'prepayment_charges' => 'nullable|numeric|min:0|max:100', // Prepayment Charges (Percentage)
            // 'late_payment_penalty' => 'nullable|numeric|min:0', // Late Payment Penalty (Fixed Amount)
            'late_payment_daily_fine_rate' => 'required|numeric|min:0|max:100',
            'late_payment_fine_start_after_days' => 'required|integer|min:0|max:365',

            'stamp_duty_rate' => 'nullable|numeric|min:0|max:100',
            'insurance_rate' => 'nullable|numeric|min:0|max:100',

            'grace_period_days' => 'nullable|integer|min:0|max:365', // Grace Period in Days
            'prepayment_lockin_period_months' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);
    
        // Check if ID is provided (Update or Create)
        $plan = $id ? LoanAgainstDepositPlan::findOrFail($id) : new LoanAgainstDepositPlan();
    
        // Fill the data and save
        $plan->fill($validated);
        $plan->save();
    
        // Redirect with success message
        $message = $id ? 'Plan updated successfully' : 'Plan created successfully';
        return redirect()->route('loanAD.index')->with('success', $message);

    }
    

    
    


}
