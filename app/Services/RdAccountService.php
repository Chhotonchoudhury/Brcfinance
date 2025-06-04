<?php
namespace App\Services;

use App\Models\RdAccount;
use App\Models\RdAccountPlan;
use App\Models\RdInterestSlab;
use App\Models\AccountTransaction;
use Carbon\Carbon;
use Exception;

class RdAccountService
{
    public function calculateFields(RdAccount $account): void
    {
        $plan = RdAccountPlan::find($account->rd_plan_id);
        if (!$plan) {
            throw new Exception("RD Plan not found.");
        }

        // Convert tenure to days
        $tenureDays = match ($plan->tenure_type) {
            'days' => $plan->tenure_value,
            'months' => $plan->tenure_value * 30,
            'years' => $plan->tenure_value * 365,
            default => throw new Exception("Invalid tenure type: {$plan->tenure_type}")
        };


        $firstTransaction = AccountTransaction::where('transaction_type', RdAccount::class)
        ->where('transaction_id', $account->id)
        ->where('account_type', 'rd')
        ->where('action_type', 'deposit')
        ->where('status', 'approved')
        ->orderBy('transaction_date') // ensure it's truly the first
        ->first();

        if (!$firstTransaction) {
            throw new Exception("No approved deposit transaction found for RD Account ID: {$account->id}");
        }
        $installmentAmount = $firstTransaction->amount;

        // Calculate total principal
        $installments = match ($plan->rd_dd_frequency) {
            'daily' => $tenureDays,
            'monthly' => floor($tenureDays / 30),
            'quarterly' => floor($tenureDays / 90),
            'annually' => floor($tenureDays / 365),
            default => throw new Exception("Invalid frequency: {$plan->rd_dd_frequency}")
        };

        $principal = $installmentAmount * $installments;

        // Match interest slab
        $slab = RdInterestSlab::where('status', true)
            ->where('min_days', '<=', $tenureDays)
            ->where('max_days', '>=', $tenureDays)
            ->first();

        if (!$slab) {
            throw new Exception("No interest slab found for {$tenureDays} days.");
        }

        $interestRate = $slab->percentage;
        $interest = ($principal * $interestRate) / 100;
        $totalPayable = $principal + $interest;
        $maturityDate = Carbon::parse($account->opening_date)->addDays($tenureDays + 29);

        // Update RD Account
        $account->tenure_duration_days = $tenureDays;
        $account->principal_amount = $principal;
        $account->rd_installment_amount = $installmentAmount;
        $account->interest_rate_percentage = $interestRate;
        $account->total_interest = round($interest, 2);
        $account->total_payable_amount = round($totalPayable, 2);
        $account->maturity_balance = round($totalPayable, 2);
        $account->maturity_date = $maturityDate;
        $account->save();
    }
}
