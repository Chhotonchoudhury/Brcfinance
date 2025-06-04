<?php

namespace App\Http\Controllers;
use App\Models\SavingsAccount;
use App\Models\SavingAccountPlan;
use App\Models\AccountTransaction;
use App\Models\RdAccount;
use App\Models\Memeber;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //

    public function index()
    {
        return view('welcome');
    }

    // public function accounts()
    // {
    //     return view('service');
    // }

    public function searchAccount(Request $request)
    {
        // Check if the account_number is provided in the request
        if ($request->has('account_number')) {
            // Validate input
            
            // Fetch account details
            $account = SavingsAccount::where('account_number', $request->account_number)->first() 
            ?? RdAccount::where('account_number', $request->account_number)->first();


            if (!$account) {
                return redirect('/accounts')->withErrors(['account_number' => 'Account not found']);
            }
            // Determine account type based on the model
           $accountType = $account instanceof SavingsAccount ? 'Savings Account' : 'RD Account';
            // Prepare account data
            $accountData = [
                'account_number' => $account->account_number,
                'account_name' => "{$account->member->first_name} {$account->member->last_name}",
                'account_type' => $accountType,
                'account_status' => $account->status,
                'account_created' => $account->created_at->format('Y-m-d'),
                'account_balance' => number_format($account->balance, 2),
                'transactions' => $account->transactions()->latest()->take(25)->get()->toArray(),
            ];

            return view('service', compact('accountData'));
        }


        // If no account_number is provided, you can show a default page or a message
        return view('service', ['message' => 'Please enter an account number to search.']);
    }
    
    
    public function test()
    {
        return view('test'); // Create this view file in resources/views/frontend/test.blade.php
    }

    public function otp()
    {
        return view('otp'); // Create this view file in resources/views/frontend/test.blade.php
    }
    
    public function tran()
    {
        return view('tran'); // Create this view file in resources/views/frontend/test.blade.php
    }

 

}
