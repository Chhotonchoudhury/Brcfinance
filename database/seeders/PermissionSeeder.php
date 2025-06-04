<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //    // Create the SuperAdmin role
        //    Role::create(['name' => 'SuperAdmin']);
        //    Role::create(['name' => 'Agent']);
        //    Role::create(['name' => 'Employee']);
        //    Role::create(['name' => 'Member']);
        //    Role::create(['name' => 'Promoter']);
        //    Role::create(['name' => 'Director']);
        //    $user = User::find(1); // Assuming the first user is the SuperAdmin
        //    $role = Role::where('name', 'SuperAdmin')->first();
           
        //    if ($user && $role) {
        //        $user->assignRole($role);
        //    }

        $permissions = [
            'company-view',
            'company-edit',
            'company-shares-update',

            'branches-list-view',
            'branches-create',
            'branches-data-export',
            'branches-edit',

            'savingsPlans-list-view',
            'savingsPlans-create',
            'savingsPlans-data-export',
            'savingsPlans-edit',

            'fdPlans-list-view',
            'fdPlans-create',
            'fdPlans-data-export',
            'fdPlans-edit',

            'rdPlans-list-view',
            'rdPlans-create',
            'rdPlans-data-export',
            'rdPlans-edit',

            'loanADPlans-list-view',
            'loanADPlans-create',
            'loanADPlans-data-export',
            'loanADPlans-edit',

            'savingsAC-list-view',
            'savingsAC-create',
            'savingsAC-data-export',
            'savingsAC-edit',
            'savingsAC-profile-view',

            'pendingSAC-list-view',
            'pendingSAC-approve',
            'pendingSAC-reject',
            'savingsAC-data-export',

            'rdAC-list-view',
            'rdAC-create',
            'rdAC-data-export',
            'rdAC-edit',
            'rdAC-profile-view',

            'pendingrdAC-list-view',
            'pendingrdAC-approve',
            'pendingrdAC-reject',
            'pendingrdAC-data-export',

            'member-list-view',
            'member-create',
            'member-data-export',
            'member-edit',
            'member-profile-view',

            'agent-list-view',
            'agent-create',
            'agent-data-export',
            'agent-edit',
            'agent-profile-view',

            'employee-list-view',
            'employee-create',
            'employee-data-export',
            'employee-edit',
            'employee-delete',
            'employee-profile-view',
            'employee-export-appointment',
            'employee-export-agreement',


            'savingsAC-transaction-create',
            'rdAC-transaction-create',
            'transaction-list-view',
            'transaction-data-export',

            'all-transaction-list-view',
            'all-transaction-data-export',
            'transaction-approve',
            'transaction-reject',
            'transaction-approve-all',

            'loanEMI-calculate',
            'loanAd-application-create',
            'loanAd-application-list-view',
            'loanAd-application-data-export',

            'sidemenu-password-change',
            
            'marketCodes-list-view',
            'marketCodes-create',
            'marketCodes-data-export',
            'marketCodes-edit',
            'marketCodes-edit',
            
            'rdInterestSlab-list-view',
            'rdInterestSlab-create',
            'rdInterestSlab-data-export',
            'rdInterestSlab-edit',
            
            // 'view roles',
            // 'create roles',
            // 'edit roles',
            // 'delete roles',
            // 'assign roles',
            // 'view reports',
            // 'export reports',
            // 'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
