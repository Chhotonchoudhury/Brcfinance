<?php

namespace App\Http\Controllers;
use App\Models\Branch;
use App\Models\Memeber;
use App\Models\SavingsAccount;
use App\Models\User;
use App\Models\BranchFinances;
use App\Models\RdAccount;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
       // Count total branches
       $totalBranches = Branch::count();

       // Count total members
       $totalMembers = Memeber::count();

       // Count total savings accounts
       $totalSavingsAccounts = SavingsAccount::count();

       // Count total Recurring Deposit (RD) accounts
       $totalRDAccounts = RdAccount::count(); 

       // count total Fd
       $totalFDAccounts = 0;

       $totalLoanAgainstDepositaccounts = 0;

       // Count employees from the users table where user_type is 'Employee'
       $totalEmployees = User::where('user_type', 'Employee')->count();

       $totalAgents = User::where('user_type', 'Agent')->count();

       return view('dashboard.index', compact(
           'totalBranches', 
           'totalMembers', 
           'totalSavingsAccounts', 
           'totalRDAccounts', 
           'totalEmployees',
           'totalFDAccounts',
           'totalLoanAgainstDepositaccounts',
           'totalAgents'
       ));
    }
}
