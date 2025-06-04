<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">

    <!-- Sidebar content start -->
    <div class="sidebar-tabs">

        <!-- Tabs nav start -->
        <div class="nav" role="tablist" aria-orientation="vertical">
            <a href="#" class="logo">
                
            </a>

            <a class="nav-link <?php echo e(request()->routeIs('dashboard') || request()->routeIs('company*') || request()->routeIs('saving*') || request()->routeIs('fd*') || request()->routeIs('dd*') || request()->routeIs('rd.index') || request()->routeIs('loanAD*') ? 'active' : ''); ?>"
                data-bs-toggle="tab" role="tab" aria-controls="tab-dashboard" href="#tab-dashboard"
                aria-selected="false">
                <i class="fas fa-home"></i>
                <span class="nav-link-text">Masters</span>
            </a>



            <a class="nav-link <?php echo e(request()->routeIs('sa.index')  || request()->routeIs('rdAc*') ? 'active' : ''); ?>"
                data-bs-toggle="tab" role="tab" aria-controls="tab-accounts" href="#tab-accounts" aria-selected="false">
                <i class="fas fa-piggy-bank"></i> 
                <span class="nav-link-text">Accounts</span>
            </a>

            <a class="nav-link <?php echo e(request()->routeIs('member*') || request()->routeIs('employees*') || request()->routeIs('agent*') ? 'active' : ''); ?>"
                data-bs-toggle="tab" role="tab" aria-controls="tab-members" href="#tab-members" aria-selected="false">
                <i class="fas fa-briefcase"></i>
                <span class="nav-link-text">Patners</span>
            </a>
            
            <a class="nav-link <?php echo e(request()->routeIs('d.index*') || request()->routeIs('rd.deposit.index') || request()->routeIs('transaction.index') || request()->routeIs('pending.transaction') ? 'active' : ''); ?>"
                data-bs-toggle="tab" role="tab" aria-controls="tab-transaction" href="#tab-transaction"
                aria-selected="false">
                <i class="fas fa-exchange-alt"></i>
                <span class="nav-link-text">Account transactions</span>
            </a>
            
            <a class="nav-link <?php echo e(request()->routeIs('LoanADApplication*') || request()->routeIs('loan.ad.calculator.form') ? 'active' : ''); ?>" data-bs-toggle="tab"
                role="tab" aria-controls="tab-loanAD" href="#tab-loanAD" aria-selected="false">
                <i class="fas fa-hand-holding-usd"></i>
                <span class="nav-link-text">Loan Against Deposit Application </span>
            </a>
            
            
            <?php if(auth()->user()->user_type === 'SuperAdmin'): ?>
            <a class="nav-link <?php echo e(request()->routeIs('roles.*') ? 'active' : ''); ?>" data-bs-toggle="tab" role="tab"
                aria-controls="tab-roles" href="#tab-roles" aria-selected="false">
                <i class="fas fa-user-shield"></i>
                <span class="nav-link-text">Roles & Permissions</span>
            </a>
            <?php endif; ?>
            
            
            <a class="nav-link <?php echo e(request()->routeIs('marketcode.index') || request()->routeIs('marketcode.form') || request()->routeIs('rd-interest-slab.index') || request()->routeIs('rd-interest-slab.form') ? 'active' : ''); ?>"
                data-bs-toggle="tab" role="tab" aria-controls="tab-marketcode" href="#tab-marketcode"
                aria-selected="false">
                <i class="fas fa-cogs"></i>
                <span class="nav-link-text">Settings </span>
            </a>

            <a class="nav-link settings" id="settings-tab" data-bs-toggle="tab" href="#tab-settings" role="tab"
                aria-controls="tab-authentication" aria-selected="false">
                <i class="fas fa-cog"></i>
                <span class="nav-link-text">Settings</span>
            </a>


        </div>
        <!-- Tabs nav end -->

        <!-- Tabs content start -->
        <div class="tab-content">

            <!-- Chat tab -->
            <div class="tab-pane fade <?php echo e(request()->routeIs('dashboard') || request()->routeIs('company*') || request()->routeIs('saving*')  || request()->routeIs('fd*') || request()->routeIs('dd*') || request()->routeIs('rd.index') || request()->routeIs('loanAD*')  ? 'show active' : ''); ?>"
                id="tab-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Masters
                </div>
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                        <ul>
                            <li>
                                <a href="<?php echo e(route('dashboard')); ?>" <?php if(request()->routeIs('dashboard')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-tachometer-alt me-1"></span>Dashboard</a>
                            </li>
                           <?php if(hasRolePermission('company-view')): ?>
                            <li>
                                <a href="<?php echo e(route('company.view')); ?>" <?php if(request()->routeIs('company.view')): ?>
                                    class="current-page" <?php endif; ?>> <span class="fas fa-industry me-1"></span>
                                    Company</a>
                            </li>
                            <?php endif; ?>

                            <?php if(hasRolePermission('branches-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('company.branch')); ?>" <?php if(request()->routeIs('company.branch')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-sitemap me-1"></span>
                                    Branches</a>
                            </li>
                            <?php endif; ?>
                        </ul>

                        <ul>

                            <li class="list-heading">Accounts Plans</li>

                            <?php if(hasRolePermission('savingsPlans-list-view')): ?>

                            <li>
                                <a href="<?php echo e(route('saving.index')); ?>" <?php if(request()->routeIs('saving.index')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-piggy-bank me-1"></span>
                                    Savings Plan</a>
                            </li>

                            <?php endif; ?>

                            <?php if(hasRolePermission('fdPlans-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('fd.index')); ?>" <?php if(request()->routeIs('fd.index')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-coins me-1"></span>
                                    FD Account Plan</a>
                            </li>
                            <?php endif; ?>

                            <?php if(hasRolePermission('rdPlans-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('dd.index')); ?>" <?php if(request()->routeIs('dd.index')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-file-invoice-dollar me-1"></span>
                                    DD Account Plan</a>
                            </li>
                            <?php endif; ?>

                            <?php if(hasRolePermission('rdPlans-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('rd.index')); ?>" <?php if(request()->routeIs('rd.index')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-chart-line me-1"></span>
                                    RD Account Plan</a>
                            </li>
                            <?php endif; ?>

                            <?php if(hasRolePermission('loanADPlans-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('loanAD.index')); ?>" <?php if(request()->routeIs('loanAD.index')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-hand-holding-usd me-1"></span>
                                    Loan AD Plans</a>
                            </li>
                            <?php endif; ?>
                            
                            
                        </ul>
                    </div>
                </div>

                <!-- Sidebar actions starts -->
                <div class="sidebar-actions">
                    <div class="support-tile">
                        <i class="icon-headphones"></i> 24/7 Support
                    </div>
                </div>
                <!-- Sidebar actions ends -->

            </div>

            <div class="tab-pane fade <?php echo e(request()->routeIs('sa.index') || request()->routeIs('rdAc*') ? 'show active' : ''); ?>"
                id="tab-accounts" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Accounts
                </div>
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">

                        <ul>
                            <li class="list-heading">Savings Account</li>
                            <?php if(hasRolePermission('savingsAC-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('sa.index')); ?>" <?php if(request()->routeIs('sa.index')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-piggy-bank me-1"></span> Saving Accounts</a>
                            </li>
                            <?php endif; ?>
                            <?php if(hasRolePermission('pendingSAC-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('sa.pending')); ?>" <?php if(request()->routeIs('sa.pending')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-hourglass-half me-1"></span> Pending SA </a>
                            </li>
                            <?php endif; ?>
                        </ul>

                        <ul>
                            <li class="list-heading">RD Account</li>

                            <?php if(hasRolePermission('rdAC-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('rdAc.account')); ?>" <?php if(request()->routeIs('rdAc.account')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-chart-line me-1"></span> RD Accounts</a>
                            </li>
                            <?php endif; ?>

                            <?php if(hasRolePermission('pendingrdAC-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('rdAc.pending')); ?>" <?php if(request()->routeIs('rdAc.pending')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-hourglass-half me-1"></span> Pending RD</a>
                            </li>
                            <?php endif; ?>
                        </ul>


                    </div>
                </div>


            </div>

            <div class="tab-pane fade <?php echo e(request()->routeIs('member*') || request()->routeIs('employees*') || request()->routeIs('agent*') ? 'show active' : ''); ?>"
                id="tab-members" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Member / Patners
                </div>
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">

                        <ul>
                            <?php if(hasRolePermission('member-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('member.index')); ?>" <?php if(request()->routeIs('member.index')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-user-friends me-1"></span> Members</a>
                            </li>
                            <?php endif; ?>

                            <?php if(hasRolePermission('agent-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('agent.index')); ?>" <?php if(request()->routeIs('agent.index')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-user-tie me-1"></span> Agents</a>
                            </li>
                            <?php endif; ?>
                            <?php if(hasRolePermission('employee-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('employees.index')); ?>" <?php if(request()->routeIs('employees.index')): ?>
                                    class="current-page" <?php endif; ?>><span class="fas fa-id-card me-1"></span> Empolyees</a>
                            </li>
                            <?php endif; ?>
                        </ul>


                    </div>
                </div>

                <!-- Sidebar actions starts -->
                <div class="sidebar-actions">
                    <div class="support-tile">
                        <i class="icon-headphones"></i> 24/7 Support
                    </div>
                </div>
                <!-- Sidebar actions ends -->

            </div>
            
              <div class="tab-pane fade <?php echo e(request()->routeIs('d.index*') || request()->routeIs('rd.deposit.index') || request()->routeIs('transaction.index') || request()->routeIs('pending.transaction') || request()->routeIs('transaction.index') || request()->routeIs('pending.transaction')  ? 'show active' : ''); ?> "
                id="tab-transaction" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Transactions
                </div>

                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                       <ul>
                            <?php if(hasRolePermission('savingsAC-transaction-create')): ?>
                            <li>
                                <a href="<?php echo e(route('d.index')); ?>"
                                    class="<?php if(request()->routeIs('d.index')): ?> current-page <?php endif; ?>">
                                    <span class="fas fa-exchange-alt me-1"></span> Deposit / Withdrawal
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if(hasRolePermission('rdAC-transaction-create')): ?>
                            <li>
                                <a href="<?php echo e(route('rd.deposit.index')); ?>"
                                    class="<?php if(request()->routeIs('rd.deposit.index')): ?> current-page <?php endif; ?>"><span class="fas fa-arrow-circle-down me-1"></span> RD
                                    Deposit</a>
                            </li>
                            <?php endif; ?>
                            <?php if(hasRolePermission('transaction-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('transaction.index')); ?>"
                                    class="<?php if(request()->routeIs('transaction.index')): ?> current-page <?php endif; ?>"> <span class="fas fa-receipt me-1"></span> Transactions</a>
                            </li>
                            <?php endif; ?>

                            <?php if(auth()->user()->user_type === 'SuperAdmin'): ?>
                            <li>
                                <a href="<?php echo e(route('pending.transaction')); ?>"
                                    class="<?php if(request()->routeIs('pending.transaction')): ?> current-page <?php endif; ?>"><span class="fas fa-list me-1"></span> All Transactions</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane fade <?php echo e(request()->routeIs('LoanADApplication*') || request()->routeIs('loan.ad.calculator.form') ? 'show active' : ''); ?> "
                id="tab-loanAD" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Loans
                </div>

                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                        <ul>
                            <li class="list-heading">Loan Against Deposit</li>
                            <li>
                                <a href="<?php echo e(route('loan.ad.calculator.form')); ?>"
                                    class="<?php if(request()->routeIs('loan.ad.calculator.form')): ?> current-page <?php endif; ?>">
                                    <i class="fas fa-calculator me-2"></i> Loan/EMi Calculator
                                </a>
                            </li>
                            
                            <li>
                                <a href="<?php echo e(route('LoanADApplication.index')); ?>"
                                    class="<?php if(request()->routeIs('LoanADApplication.index')): ?> current-page <?php endif; ?>">
                                    <span class="fas fa-file-signature me-1"></span> (LAD) Application
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>


            <!-- Pages tab -->
            
            
            
            
            <?php if(auth()->user()->user_type === 'SuperAdmin'): ?>
            <div class="tab-pane fade <?php echo e(request()->routeIs('roles.*') ? 'show active' : ''); ?>" id="tab-roles"
                role="tabpanel" aria-labelledby="dashboard-tab">

                <div class="tab-pane-header">
                    Access Control
                </div>

                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                        <ul>
                            <li class="list-heading">Roles Management</li>

                            <li>
                                <a href="<?php echo e(route('roles.index')); ?>"
                                    class="<?php if(request()->routeIs('roles.index')): ?> current-page <?php endif; ?>">
                                    <span class="fas fa-user-shield me-2"></span> All Roles
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo e(route('roles.create')); ?>"
                                    class="<?php if(request()->routeIs('roles.create')): ?> current-page <?php endif; ?>">
                                    <i class="fas fa-plus-circle me-2"></i> Create Role
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            
             <div class="tab-pane fade <?php echo e(request()->routeIs('marketcode.index') || request()->routeIs('marketcode.form') || request()->routeIs('rd-interest-slab.index') || request()->routeIs('rd-interest-slab.form') ? 'show active' : ''); ?>"
                id="tab-marketcode" role="tabpanel" aria-labelledby="dashboard-tab">

                <div class="tab-pane-header">
                    Settings
                </div>

                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                        <ul>
                            <li class="list-heading">Market Code</li>
                            <?php if(hasRolePermission('marketCodes-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('marketcode.index')); ?>"
                                    class="<?php if(request()->routeIs('marketcode.index')): ?> current-page <?php endif; ?>">
                                    <span class="fas fa-tags me-2"></span> All Market Codes
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if(hasRolePermission('marketCodes-create')): ?>
                            <li>
                                <a href="<?php echo e(route('marketcode.form')); ?>"
                                    class="<?php if(request()->routeIs('marketcode.form')): ?> current-page <?php endif; ?>">
                                    <i class="fas fa-plus-circle me-2"></i> Create Market Code
                                </a>
                            </li>
                            <?php endif; ?>

                            <?php if(hasRolePermission('rdInterestSlab-list-view')
                            ||hasRolePermission('rdInterestSlab-create')): ?>
                            <li class="list-heading mt-3">RD Interest Slab</li>
                            <?php endif; ?>
                            <?php if(hasRolePermission('rdInterestSlab-list-view')): ?>
                            <li>
                                <a href="<?php echo e(route('rd-interest-slab.index')); ?>"
                                    class="<?php if(request()->routeIs('rd-interest-slab.index')): ?> current-page <?php endif; ?>">
                                    <span class="fas fa-layer-group me-1"></span> All RD Interest Slab
                                </a>
                            </li>
                            <?php endif; ?>
                            <?php if(hasRolePermission('rdInterestSlab-create')): ?>
                            <li>
                                <a href="<?php echo e(route('rd-interest-slab.form')); ?>"
                                    class="<?php if(request()->routeIs('rd-interest-slab.form')): ?> current-page <?php endif; ?>">
                                    <i class="fas fa-plus-circle me-2"></i> Create RD Interest Slab
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Settings tab -->
            <div class="tab-pane fade" id="tab-settings" role="tabpanel" aria-labelledby="settings-tab">

                <!-- Tab content header start -->
                <div class="tab-pane-header">
                    Settings
                </div>
                <!-- Tab content header end -->

                <!-- Settings start -->
                <div class="sidebarMenuScroll">
                    <div class="sidebar-settings">
                        <div class="accordion" id="settingsAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="genInfo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#genCollapse" aria-expanded="true" aria-controls="genCollapse">
                                        General Info
                                    </button>
                                </h2>
                                <div id="genCollapse" class="accordion-collapse collapse show" aria-labelledby="genInfo"
                                    data-bs-parent="#settingsAccordion">
                                    <div class="accordion-body">


                                        <div class="field-wrapper">
                                            <input type="text" class="form-control" name="name"
                                                value="<?php echo e(auth()->user()->name); ?>" readonly>
                                            <div class="field-placeholder">Name</div>
                                        </div>

                                        <div class="field-wrapper">

                                            <input type="email" class="form-control" name="email"
                                                value="<?php echo e(auth()->user()->email); ?>" readonly>
                                            <div class="field-placeholder">Email</div>
                                        </div>

                                        <div class="field-wrapper">
                                            <input type="email" class="form-control" name="email"
                                                value="<?php echo e(auth()->user()->user_type); ?>" readonly>
                                            <div class="field-placeholder">Role</div>
                                        </div>
                                        

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="chngPwd">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#chngPwdCollapse" aria-expanded="false"
                                        aria-controls="chngPwdCollapse">
                                        Change Password
                                    </button>
                                </h2>
                                <div id="chngPwdCollapse" class="accordion-collapse collapse" aria-labelledby="chngPwd"
                                    data-bs-parent="#settingsAccordion">
                                    <div class="accordion-body">

                                        <form id="passwordUpdateForm">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>

                                            <div class="field-wrapper">
                                                <input type="password" class="form-control" id="current_password"
                                                    name="current_password" required>
                                                <div class="field-placeholder">Current Password</div>
                                            </div>

                                            <div class="field-wrapper">
                                                <input type="password" class="form-control" id="new_password"
                                                    name="new_password" required>
                                                <div class="field-placeholder">New Password</div>
                                            </div>

                                            <div class="field-wrapper">
                                                <input type="password" class="form-control"
                                                    id="new_password_confirmation" name="new_password_confirmation"
                                                    required>
                                                <div class="field-placeholder">Confirm New Password</div>
                                            </div>

                                            <div id="passwordError" class="alert alert-danger d-none"></div>
                                            <div id="passwordSuccess" class="alert alert-success d-none"></div>

                                            <button type="button" class="btn btn-warning w-100" id="updatePasswordBtn">
                                                <span class="spinner-border spinner-border-sm d-none"
                                                    id="passwordSpinner"></span>
                                                Update Password
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="sidebarNotifications">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#notiCollapse" aria-expanded="false"
                                        aria-controls="notiCollapse">
                                        Notifications
                                    </button>
                                </h2>
                                <div id="notiCollapse" class="accordion-collapse collapse"
                                    aria-labelledby="sidebarNotifications" data-bs-parent="#settingsAccordion">
                                    <div class="accordion-body">
                                        <div class="list-group m-0">
                                            <div class="noti-container">
                                                <div class="noti-block">
                                                    <div>Alerts</div>
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox" id="showAlertss"
                                                            checked>
                                                        <label class="form-check-label" for="showAlertss"></label>
                                                    </div>
                                                </div>
                                                <div class="noti-block">
                                                    <div>Enable Sound</div>
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="soundEnable">
                                                        <label class="form-check-label" for="soundEnable"></label>
                                                    </div>
                                                </div>
                                                <div class="noti-block">
                                                    <div>Allow Chat</div>
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox" id="allowChat">
                                                        <label class="form-check-label" for="allowChat"></label>
                                                    </div>
                                                </div>
                                                <div class="noti-block">
                                                    <div>Desktop Messages</div>
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="desktopMessages">
                                                        <label class="form-check-label" for="desktopMessages"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Settings end -->

                <!-- Sidebar actions starts -->
                <div class="sidebar-actions">
                    <div class="support-tile blue">
                        <a href="account-settings.html" class="btn btn-light m-auto">Advance Settings</a>
                    </div>
                </div>
                <!-- Sidebar actions ends -->
            </div>

        </div>
        <!-- Tabs content end -->

    </div>
    <!-- Sidebar content end -->

</nav>
<!-- Sidebar wrapper end -->

<script>
    document.getElementById("updatePasswordBtn").addEventListener("click", function () {
        const btn = this;
        const spinner = document.getElementById("passwordSpinner");
        const errorDiv = document.getElementById("passwordError");
        const successDiv = document.getElementById("passwordSuccess");

        // Reset previous messages
        errorDiv.classList.add("d-none");
        successDiv.classList.add("d-none");
        errorDiv.textContent = "";
        successDiv.textContent = "";

        // Show spinner and disable button
        btn.disabled = true;
        spinner.classList.remove("d-none");

        // Get input values
        const formData = {
            current_password: document.getElementById("current_password").value,
            new_password: document.getElementById("new_password").value,
            new_password_confirmation: document.getElementById("new_password_confirmation").value
        };

        fetch("<?php echo e(route('settings.updatePassword')); ?>", {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify(formData)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            btn.disabled = false;
            spinner.classList.add("d-none");

            if (data.success) {
                successDiv.textContent = data.message;
                successDiv.classList.remove("d-none");
            } else {
                errorDiv.textContent = data.message;
                errorDiv.classList.remove("d-none");
            }
        })
        .catch(error => {
            console.error("Fetch error:", error);
            btn.disabled = false;
            spinner.classList.add("d-none");
            errorDiv.textContent = error.message || "An error occurred. Please try again.";
            errorDiv.classList.remove("d-none");
        });
    });

</script><?php /**PATH C:\xampp\htdocs\NidhiBank\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>