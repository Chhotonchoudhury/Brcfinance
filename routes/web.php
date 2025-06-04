<?php
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Exports\BranchExport;
use App\Exports\MemberExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/force-logout', function () {
    Auth::logout();
    // session()->invalidate();
    // session()->regenerateToken();
    return redirect('/login')->with('message', 'You have been logged out.');
});

Route::get('/', [FrontendController::class, 'index']);
Route::get('/accounts', [FrontendController::class, 'searchAccount']);
Route::get('/test', [FrontendController::class, 'test'])->name('frontend.test');
Route::get('/otp', [FrontendController::class, 'otp'])->name('frontend.test1');
Route::get('/Ac-tran', [FrontendController::class, 'tran'])->name('frontend.tran');

Route::get('/test-email', function () {
    try {
        Mail::raw('This is a test email.', function ($message) {
            $message->to('cont2chhoton@gmail.com')
                    ->subject('Test Email');
        });
        return 'Test email sent successfully!';
    } catch (\Exception $e) {
        return 'Failed to send email: ' . $e->getMessage();
    }
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    
    Route::get('/company', [CompanyController::class, 'index'])->middleware('permission:company-view')->name('company.view');
    Route::get('/company-update', [CompanyController::class, 'Edite'])->middleware('permission:company-edit')->name('company.edit');
    Route::post('/company', [CompanyController::class, 'store'])->middleware('permission:company-edit')->name('company.store');
    Route::post('/share-ranges/update', [CompanyController::class, 'ShareRangeUpdate'])->middleware('permission:company-shares-update')->name('share-ranges.update');
    
    // Route::get('/branches', [CompanyController::class, 'branch'])->name('company.branch');
    // Route::get('/branches/form/{id?}', [CompanyController::class, 'branchForm'])->name('company.branch.form');
    // // This route handles both inserting and updating branches based on the presence of $id
    // Route::post('/branches/form/{id?}', [CompanyController::class, 'storeOrUpdateBranch']);

    // View branches list — requires 'branches-list-view' permission
    Route::get('/branches', [CompanyController::class, 'branch'])->middleware('permission:branches-list-view')->name('company.branch');
    // Show the branch form (for both create and edit)
    Route::get('/branches/form', [CompanyController::class, 'branchForm'])->middleware('permission:branches-create')->name('company.branch.form');
    Route::get('/branches/form/{id?}', [CompanyController::class, 'branchForm'])->middleware('permission:branches-edit')->name('company.branch.form');
    // Store or update branch — apply appropriate permission based on presence of ID
    Route::post('/branches/form', [CompanyController::class, 'storeOrUpdateBranch'])->middleware('permission:branches-create'); // Either can submit
    Route::post('/branches/form/{id?}', [CompanyController::class, 'storeOrUpdateBranch'])->middleware('permission:branches-edit'); // Either can submit

    
    Route::get('/agent', [AgentController::class, 'index'])->middleware('permission:agent-list-view')->name('agent.index');
    Route::get('/agent/form', [AgentController::class, 'AgentForm'])->middleware('permission:agent-create')->name('agent.form');
    Route::get('/agent/form/{id?}', [AgentController::class, 'AgentForm'])->middleware('permission:agent-edit')->name('agent.form');
    Route::post('/agent/form', [AgentController::class, 'storeOrUpdateAgent'])->middleware('permission:agent-create')->name('agent.save');
    Route::post('/agent/form/{id?}', [AgentController::class, 'storeOrUpdateAgent'])->middleware('permission:agent-edit')->name('agent.save');

    Route::get('/employees', [EmployeeController::class, 'index'])->middleware('permission:employee-list-view')->name('employees.index');
    Route::get('/employees/form', [EmployeeController::class, 'EmployeeForm'])->middleware('permission:employee-create')->name('employees.form');
    Route::get('/employees/form/{id?}', [EmployeeController::class, 'EmployeeForm'])->middleware('permission:employee-edit')->name('employees.form');
    Route::post('/employees/form', [EmployeeController::class, 'storeOrUpdateEmployee'])->middleware('permission:employee-create')->name('employees.save');
    Route::post('/employees/form/{id?}', [EmployeeController::class, 'storeOrUpdateEmployee'])->middleware('permission:employee-edit')->name('employees.save');
    Route::get('/employees/{id}/appointment-letter/download', [EmployeeController::class, 'downloadAppointmentLetter'])->middleware('permission:employee-export-appointment')->name('employees.letter.download');
    Route::get('/appointment-letter/preview/{id}', [EmployeeController::class, 'preview'])->middleware('permission:employee-export-appointment')->name('appointment.preview');


    // Route::get('/members', [MemberController::class, 'index'])->name('member.index');
    // Route::get('/member/form/{id?}', [MemberController::class, 'MemberForm'])->name('member.form');
    // Route::post('/member/form/{id?}', [MemberController::class, 'storeOrUpdateMember'])->name('member.save');
    // Route::get('/member-profile/{id}', [MemberController::class, 'MemberProfile'])->name('member.profile');

    Route::get('/members', [MemberController::class, 'index'])->middleware('permission:member-list-view')->name('member.index');
    Route::get('/member/form', [MemberController::class, 'MemberForm'])->middleware('permission:member-create')->name('member.form');
    Route::get('/member/form/{id?}', [MemberController::class, 'MemberForm'])->middleware('permission:member-edit')->name('member.form');
    Route::post('/member/form', [MemberController::class, 'storeOrUpdateMember'])->middleware('permission:member-create')->name('member.save');
    Route::post('/member/form/{id?}', [MemberController::class, 'storeOrUpdateMember'])->middleware('permission:member-edit')->name('member.save');
    Route::get('/member-profile/{id}', [MemberController::class, 'MemberProfile'])->middleware('permission:member-profile-view')->name('member.profile');
    Route::post('/members/{member}/upload-documents', [MemberController::class, 'uploadDocuments'])
    ->name('members.upload.documents');
    Route::delete('/members/{id}/documents/delete/{type}', [MemberController::class, 'deleteDocument'])->name('members.delete.document');

    Route::get('members/export-pdf', [PDFController::class, 'MemberExportPDF'])->middleware('permission:member-data-export')->name('members.export.pdf');
    Route::get('members/export-excel', function () {
        return Excel::download(new MemberExport, 'members.xlsx');
    })->middleware('permission:member-data-export')->name('members.export.excel');

    // Route::get('/agent', [AgentController::class, 'index'])->name('agent.index');
    // Route::get('/agent/form/{id?}', [AgentController::class, 'AgentForm'])->name('agent.form');
    // Route::post('/agent/form/{id?}', [AgentController::class, 'storeOrUpdateAgent'])->name('agent.save');

    Route::get('/savings-plan', [PlansController::class, 'SavingIndex'])->middleware('permission:savingsPlans-list-view')->name('saving.index');
    Route::get('/savings-plan/form', [PlansController::class, 'SavingForm'])->middleware('permission:savingsPlans-create')->name('saving.form');
    Route::get('/savings-plan/form/{id?}', [PlansController::class, 'SavingForm'])->middleware('permission:savingsPlans-edit')->name('saving.form');
    Route::post('/savings-plan/form', [PlansController::class, 'storeOrUpdateSaving'])->middleware('permission:savingsPlans-create')->name('saving.save');
    Route::post('/savings-plan/form/{id?}', [PlansController::class, 'storeOrUpdateSaving'])->middleware('permission:savingsPlans-edit')->name('saving.save');


    // Route::get('/fd-plan', [PlansController::class, 'FdIndex'])->name('fd.index');
    // Route::get('/fd-plan/form/{id?}', [PlansController::class, 'FdForm'])->name('fd.form');
    // Route::post('/fd-plan/form/{id?}', [PlansController::class, 'storeOrUpdateFd'])->name('fd.save');

    Route::get('/fd-plan', [PlansController::class, 'FdIndex'])->middleware('permission:fdPlans-list-view')->name('fd.index');
    Route::get('/fd-plan/form', [PlansController::class, 'FdForm'])->middleware('permission:fdPlans-create')->name('fd.form');
    Route::get('/fd-plan/form/{id?}', [PlansController::class, 'FdForm'])->middleware('permission:fdPlans-edit')->name('fd.form');
    Route::post('/fd-plan/form', [PlansController::class, 'storeOrUpdateFd'])->middleware('permission:fdPlans-create')->name('fd.save');
    Route::post('/fd-plan/form/{id?}', [PlansController::class, 'storeOrUpdateFd'])->middleware('permission:fdPlans-edit')->name('fd.save');

    Route::get('/dd-account-plan', [PlansController::class, 'DdIndex'])->name('dd.index');
    Route::get('/dd-plan/form/{id?}', [PlansController::class, 'DdForm'])->name('dd.form');
    Route::post('/dd-plan/form/{id?}', [PlansController::class, 'storeOrUpdateDd'])->name('dd.save');

   // Route::get('/rd-account-plan', [PlansController::class, 'RdIndex'])->name('rd.index');
    // Route::get('/rd-plan/form/{id?}', [PlansController::class, 'RdForm'])->name('rd.form');
    // Route::post('/rd-plan/form/{id?}', [PlansController::class, 'storeOrUpdateRd'])->name('rd.save');

    // RD Plan
    Route::get('/rd-account-plan', [PlansController::class, 'RdIndex'])->middleware('permission:rdPlans-list-view')->name('rd.index');
    Route::get('/rd-plan/form', [PlansController::class, 'RdForm'])->middleware('permission:rdPlans-create')->name('rd.form');
    Route::get('/rd-plan/form/{id?}', [PlansController::class, 'RdForm'])->middleware('permission:rdPlans-edit')->name('rd.form');
    Route::post('/rd-plan/form', [PlansController::class, 'storeOrUpdateRd'])->middleware('permission:rdPlans-create')->name('rd.save');
    Route::post('/rd-plan/form/{id?}', [PlansController::class, 'storeOrUpdateRd'])->middleware('permission:rdPlans-edit')->name('rd.save');
    
    // LoanAD Plan
    Route::get('/loanAD-plan', [PlansController::class, 'LoanADIndex'])->middleware('permission:loanADPlans-list-view')->name('loanAD.index');
    Route::get('/loanAD-plan/form', [PlansController::class, 'LoanADForm'])->middleware('permission:loanADPlans-create')->name('loanAD.form');
    Route::get('/loanAD-plan/form/{id?}', [PlansController::class, 'LoanADForm'])->middleware('permission:loanADPlans-edit')->name('loanAD.form');
    Route::post('/loanAD-plan/form', [PlansController::class, 'storeOrUpdateLoanAD'])->middleware('permission:loanADPlans-create')->name('loanAD.save');
    Route::post('/loanAD-plan/form/{id?}', [PlansController::class, 'storeOrUpdateLoanAD'])->middleware('permission:loanADPlans-edit')->name('loanAD.save');

    
    

    Route::get('/saving-accounts', [AccountController::class, 'index'])->middleware('permission:savingsAC-list-view')->name('sa.index');
    Route::get('/savings-accounts/store', [AccountController::class, 'CreateSVAccount'])->middleware('permission:savingsAC-create')->name('sa.create');
    Route::post('/savings-accounts', [AccountController::class, 'storeSVAccount'])->middleware('permission:savingsAC-create')->name('sa.store');
    
    
    Route::get('/pending-accounts', [AccountController::class, 'unapproveSVAccount'])->middleware('permission:pendingSAC-list-view')->name('sa.pending');
    Route::post('/SA-accounts/update-status/{id}', [AccountController::class, 'updateSAStatus'])->name('sa.updateStatus');
    Route::get('/sa-profile/{id}', [AccountController::class, 'SAProfile'])->middleware('permission:savingsAC-profile-view')->name('sa.profile');
    Route::post('/sa-transaction', [AccountController::class, 'SVAcTransaction'])->name('sa.transaction');

    
    // Route in web.php
    Route::get('/get-member-info/{id}', [AccountController::class, 'getMemberInfo']);
    Route::get('/get-plan-info/{id}', [AccountController::class, 'getPlanInfo']);
    Route::get('/get-plan-info-rd/{id}', [AccountController::class, 'getPlanInfoRd']);
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/rd-accounts', [AccountController::class, 'RdAccount'])->middleware('permission:rdAC-list-view')->name('rdAc.account');
    Route::get('/rd-accounts/store', [AccountController::class, 'CreateRDAccount'])->middleware('permission:rdAC-create')->name('rdAc.create');
    Route::post('/rd-accounts', [AccountController::class, 'storeRDAccount'])->middleware('permission:rdAC-create')->name('rdAc.store');
    Route::get('/pending-rd-accounts', [AccountController::class, 'unapproveRDAccount'])->middleware('permission:pendingrdAC-list-view')->name('rdAc.pending');
    Route::post('/RD-accounts/update-status/{id}', [AccountController::class, 'updateRDStatus'])->name('rd.updateStatus');
    Route::get('/rd-profile/{id}', [AccountController::class, 'RDProfile'])->middleware('permission:rdAC-profile-view')->name('rdAc.profile');
    Route::post('/rd-transaction', [AccountController::class, 'RDAcTransaction'])->name('rdAc.transaction');

    
        //this is the account transactions 
    Route::get('/deposit-blance', [AccountController::class, 'DepositBlncIndex'])->middleware('permission:savingsAC-transaction-create')->name('d.index');
    Route::get('/get-SA/search', [AccountController::class, 'SAsearch']);
    Route::get('/get-RD/search', [AccountController::class, 'RDsearch']);

    Route::get('/rd-blance', [AccountController::class, 'RDBlncIndex'])->middleware('permission:rdAC-transaction-create')->name('rd.deposit.index');

    
     //the transactions sheet
    Route::get('/transactions', [AccountController::class, 'TransactionIndex'])->middleware('permission:transaction-list-view')->name('transaction.index');

    Route::get('/pending-transactions', [AccountController::class, 'PendingTransaction'])->name('pending.transaction')->middleware('superAdmin');
    Route::get('/get-employees/{branch_id}', [EmployeeController::class, 'getEmployees']);

    Route::post('/transactions/approve/{id}', [AccountController::class, 'approveSingleTransaction'])->name('transactions.approve.single');
    Route::post('/transactions/approve-multiple', [AccountController::class, 'approveMultipleTransactions'])->name('transactions.approve.multiple');
    Route::post('/transactions/revert/{id}', [AccountController::class, 'revertTransaction'])->name('transactions.revert');


    //this is the route of the account information section 
    // Route::put('/settings/update-profile', [SettingsController::class, 'updateUserinfo'])->name('settings.updateProfile');
    Route::put('/settings/update-password', [EmployeeController::class, 'updateUserPassword'])->name('settings.updatePassword');
    
    
     // loan routes 
    Route::get('/loan-AD-application', [LoanController::class, 'LoanADApplication'])->name('LoanADApplication.index');
    Route::get('/loan-AD-application/store', [LoanController::class, 'CreateLoanADapplication'])->name('LoanADApplication.create');
    Route::post('/loan-Ad-application/created', [LoanController::class, 'StoreLoanADCreated'])->name('LoanADApplication.save');
    Route::post('/check-loan-eligibility', [LoanController::class, 'checkLoanEligibility']);
    
        // Show the loan calculator form
    Route::get('/loan-ad-calculator', [LoanController::class, 'showAdForm'])->name('loan.ad.calculator.form');
    // Handle calculation request
    Route::post('/loan-ad-calculator', [LoanController::class, 'calculateAdLoan'])->name('loan.ad.calculator.calculate');
    Route::post('/loan-ad/delete/{id}', [LoanController::class, 'LoanAddelete'])->name('LoanADApplication.delete');
    Route::get('/loan-ad-application/{id}', [LoanController::class, 'showJson']);
    
        //seeting part
    Route::get('/market-code', [SettingsController::class, 'Marketindex'])->middleware('permission:marketCodes-list-view')->name('marketcode.index');
    Route::get('/market-code/form', [SettingsController::class, 'Marketform'])->middleware('permission:marketCodes-create')->name('marketcode.form');
    Route::get('/market-code/form/{id?}', [SettingsController::class, 'Marketform'])->middleware('permission:marketCodes-edit')->name('marketcode.form');
    Route::post('/market-code/form', [SettingsController::class, 'MarketstoreOrUpdate'])->middleware('permission:marketCodes-create')->name('marketcode.save');
    Route::post('/market-code/form/{id?}', [SettingsController::class, 'MarketstoreOrUpdate'])->middleware('permission:marketCodes-edit')->name('marketcode.save');
    
    Route::get('/rd-interest-slab', [SettingsController::class, 'RdInSlabindex'])->middleware('permission:rdInterestSlab-list-view')->name('rd-interest-slab.index');
    Route::get('/rd-interest-slab/form', [SettingsController::class, 'RdInSlabform'])->middleware('permission:rdInterestSlab-create')->name('rd-interest-slab.form'); 
    Route::get('/rd-interest-slab/form/{id?}', [SettingsController::class, 'RdInSlabform'])->middleware('permission:rdInterestSlab-edit')->name('rd-interest-slab.form'); 
    Route::post('/rd-interest-slab/form', [SettingsController::class, 'RdInSlabstoreOrUpdate'])->middleware('permission:rdInterestSlab-create')->name('rd-interest-slab.save');
    Route::post('/rd-interest-slab/form/{id?}', [SettingsController::class, 'RdInSlabstoreOrUpdate'])->middleware('permission:rdInterestSlab-edit')->name('rd-interest-slab.save');
    
    Route::post('/rd-account/calculate', [AccountController::class, 'RDcalculate'])->name('rdAc.calculate');
    Route::get('/rd-accounts-quick-view/{id}', [AccountController::class, 'RDAccountQshow'])->name('rd-accounts-quick.show');
    
        //loan routes 
    Route::get('/get-deposit-account/{member_id}/{deposit_type}', [AccountController::class, 'getAccountNumber']);
    Route::get('/get-asset-values', [AccountController::class, 'getAssetValues']);
    Route::post('/check-emi-details', [LoanController::class, 'checkEmiDetails']);
    
    Route::put('/loan-ad-application/{id}/approve', [LoanController::class, 'LoanADapprove'])->name('loan-ad-application.approve');
    Route::put('/loan-ad-application/{id}/reject', [LoanController::class, 'LoanADreject'])->name('loan-ad-application.reject');
    
    
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index')->middleware('superAdmin');
        Route::get('/create/{role?}', [RoleController::class, 'create'])->name('create')->middleware('superAdmin'); // Optional role parameter
        Route::post('/', [RoleController::class, 'store'])->name('store')->middleware('superAdmin');
         // The edit route should still be separate from the create route.
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit')->middleware('superAdmin');
        
        // The update route is for saving changes to the existing role
        Route::put('/{role}', [RoleController::class, 'update'])->name('update')->middleware('superAdmin');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('destroy')->middleware('superAdmin'); // Delete route
    });
    
    
});

// Route group with 'auth' and 'verified' middleware for pdf export
Route::middleware(['auth'])->group(function () {
    // Define the route for exporting branches to PDF
    Route::get('branches/export-pdf', [PDFController::class, 'BranchExportPDF'])->name('branches.export.pdf');
    Route::get('branches/export-excel', function () {
        return Excel::download(new BranchExport, 'branches.xlsx');
    })->name('branches.export.excel');
});


require __DIR__.'/auth.php';
