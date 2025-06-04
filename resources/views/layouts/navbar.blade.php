<!-- Sidebar wrapper start -->
<nav class="sidebar-wrapper">

    <!-- Sidebar content start -->
    <div class="sidebar-tabs">

        <!-- Tabs nav start -->
        <div class="nav" role="tablist" aria-orientation="vertical">
            <a href="#" class="logo">
                {{-- <img src="{{ asset('assetsDashboard/img/logo.png') }}" alt="Uni Pro Admin"> --}}
            </a>

            <a class="nav-link {{ request()->routeIs('dashboard') || request()->routeIs('company*') || request()->routeIs('saving*') || request()->routeIs('fd*') || request()->routeIs('dd*') || request()->routeIs('rd.index') || request()->routeIs('loanAD*') ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" aria-controls="tab-dashboard" href="#tab-dashboard"
                aria-selected="false">
                <i class="fas fa-home"></i>
                <span class="nav-link-text">Masters</span>
            </a>



            <a class="nav-link {{ request()->routeIs('sa.index')  || request()->routeIs('rdAc*') ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" aria-controls="tab-accounts" href="#tab-accounts" aria-selected="false">
                <i class="fas fa-piggy-bank"></i> 
                <span class="nav-link-text">Accounts</span>
            </a>

            <a class="nav-link {{ request()->routeIs('member*') || request()->routeIs('employees*') || request()->routeIs('agent*') ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" aria-controls="tab-members" href="#tab-members" aria-selected="false">
                <i class="fas fa-briefcase"></i>
                <span class="nav-link-text">Patners</span>
            </a>
            
            <a class="nav-link {{ request()->routeIs('d.index*') || request()->routeIs('rd.deposit.index') || request()->routeIs('transaction.index') || request()->routeIs('pending.transaction') ? 'active' : '' }}"
                data-bs-toggle="tab" role="tab" aria-controls="tab-transaction" href="#tab-transaction"
                aria-selected="false">
                <i class="fas fa-exchange-alt"></i>
                <span class="nav-link-text">Account transactions</span>
            </a>
            
            <a class="nav-link {{ request()->routeIs('LoanADApplication*') || request()->routeIs('loan.ad.calculator.form') ? 'active' : '' }}" data-bs-toggle="tab"
                role="tab" aria-controls="tab-loanAD" href="#tab-loanAD" aria-selected="false">
                <i class="fas fa-hand-holding-usd"></i>
                <span class="nav-link-text">Loan Against Deposit Application </span>
            </a>
            
            
            @if(auth()->user()->user_type === 'SuperAdmin')
            <a class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}" data-bs-toggle="tab" role="tab"
                aria-controls="tab-roles" href="#tab-roles" aria-selected="false">
                <i class="fas fa-user-shield"></i>
                <span class="nav-link-text">Roles & Permissions</span>
            </a>
            @endif
            
            
            <a class="nav-link {{ request()->routeIs('marketcode.index') || request()->routeIs('marketcode.form') || request()->routeIs('rd-interest-slab.index') || request()->routeIs('rd-interest-slab.form') ? 'active' : '' }}"
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
            <div class="tab-pane fade {{ request()->routeIs('dashboard') || request()->routeIs('company*') || request()->routeIs('saving*')  || request()->routeIs('fd*') || request()->routeIs('dd*') || request()->routeIs('rd.index') || request()->routeIs('loanAD*')  ? 'show active' : '' }}"
                id="tab-dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Masters
                </div>
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                        <ul>
                            <li>
                                <a href="{{ route('dashboard') }}" @if(request()->routeIs('dashboard'))
                                    class="current-page" @endif><span class="fas fa-tachometer-alt me-1"></span>Dashboard</a>
                            </li>
                           @if(hasRolePermission('company-view'))
                            <li>
                                <a href="{{ route('company.view') }}" @if(request()->routeIs('company.view'))
                                    class="current-page" @endif> <span class="fas fa-industry me-1"></span>
                                    Company</a>
                            </li>
                            @endif

                            @if(hasRolePermission('branches-list-view'))
                            <li>
                                <a href="{{ route('company.branch') }}" @if(request()->routeIs('company.branch'))
                                    class="current-page" @endif><span class="fas fa-sitemap me-1"></span>
                                    Branches</a>
                            </li>
                            @endif
                        </ul>

                        <ul>

                            <li class="list-heading">Accounts Plans</li>

                            @if(hasRolePermission('savingsPlans-list-view'))

                            <li>
                                <a href="{{ route('saving.index') }}" @if(request()->routeIs('saving.index'))
                                    class="current-page" @endif><span class="fas fa-piggy-bank me-1"></span>
                                    Savings Plan</a>
                            </li>

                            @endif

                            @if(hasRolePermission('fdPlans-list-view'))
                            <li>
                                <a href="{{ route('fd.index') }}" @if(request()->routeIs('fd.index'))
                                    class="current-page" @endif><span class="fas fa-coins me-1"></span>
                                    FD Account Plan</a>
                            </li>
                            @endif

                            @if(hasRolePermission('rdPlans-list-view'))
                            <li>
                                <a href="{{ route('dd.index') }}" @if(request()->routeIs('dd.index'))
                                    class="current-page" @endif><span class="fas fa-file-invoice-dollar me-1"></span>
                                    DD Account Plan</a>
                            </li>
                            @endif

                            @if(hasRolePermission('rdPlans-list-view'))
                            <li>
                                <a href="{{ route('rd.index') }}" @if(request()->routeIs('rd.index'))
                                    class="current-page" @endif><span class="fas fa-chart-line me-1"></span>
                                    RD Account Plan</a>
                            </li>
                            @endif

                            @if(hasRolePermission('loanADPlans-list-view'))
                            <li>
                                <a href="{{ route('loanAD.index') }}" @if(request()->routeIs('loanAD.index'))
                                    class="current-page" @endif><span class="fas fa-hand-holding-usd me-1"></span>
                                    Loan AD Plans</a>
                            </li>
                            @endif
                            
                            
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

            <div class="tab-pane fade {{request()->routeIs('sa.index') || request()->routeIs('rdAc*') ? 'show active' : '' }}"
                id="tab-accounts" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Accounts
                </div>
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">

                        <ul>
                            <li class="list-heading">Savings Account</li>
                            @if(hasRolePermission('savingsAC-list-view'))
                            <li>
                                <a href="{{ route('sa.index') }}" @if(request()->routeIs('sa.index'))
                                    class="current-page" @endif><span class="fas fa-piggy-bank me-1"></span> Saving Accounts</a>
                            </li>
                            @endif
                            @if(hasRolePermission('pendingSAC-list-view'))
                            <li>
                                <a href="{{ route('sa.pending') }}" @if(request()->routeIs('sa.pending'))
                                    class="current-page" @endif><span class="fas fa-hourglass-half me-1"></span> Pending SA </a>
                            </li>
                            @endif
                        </ul>

                        <ul>
                            <li class="list-heading">RD Account</li>

                            @if(hasRolePermission('rdAC-list-view'))
                            <li>
                                <a href="{{ route('rdAc.account') }}" @if(request()->routeIs('rdAc.account'))
                                    class="current-page" @endif><span class="fas fa-chart-line me-1"></span> RD Accounts</a>
                            </li>
                            @endif

                            @if(hasRolePermission('pendingrdAC-list-view'))
                            <li>
                                <a href="{{ route('rdAc.pending') }}" @if(request()->routeIs('rdAc.pending'))
                                    class="current-page" @endif><span class="fas fa-hourglass-half me-1"></span> Pending RD</a>
                            </li>
                            @endif
                        </ul>


                    </div>
                </div>


            </div>

            <div class="tab-pane fade {{request()->routeIs('member*') || request()->routeIs('employees*') || request()->routeIs('agent*') ? 'show active' : '' }}"
                id="tab-members" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Member / Patners
                </div>
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">

                        <ul>
                            @if(hasRolePermission('member-list-view'))
                            <li>
                                <a href="{{ route('member.index') }}" @if(request()->routeIs('member.index'))
                                    class="current-page" @endif><span class="fas fa-user-friends me-1"></span> Members</a>
                            </li>
                            @endif

                            @if(hasRolePermission('agent-list-view'))
                            <li>
                                <a href="{{ route('agent.index') }}" @if(request()->routeIs('agent.index'))
                                    class="current-page" @endif><span class="fas fa-user-tie me-1"></span> Agents</a>
                            </li>
                            @endif
                            @if(hasRolePermission('employee-list-view'))
                            <li>
                                <a href="{{ route('employees.index') }}" @if(request()->routeIs('employees.index'))
                                    class="current-page" @endif><span class="fas fa-id-card me-1"></span> Empolyees</a>
                            </li>
                            @endif
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
            
              <div class="tab-pane fade {{ request()->routeIs('d.index*') || request()->routeIs('rd.deposit.index') || request()->routeIs('transaction.index') || request()->routeIs('pending.transaction') || request()->routeIs('transaction.index') || request()->routeIs('pending.transaction')  ? 'show active' : '' }} "
                id="tab-transaction" role="tabpanel" aria-labelledby="dashboard-tab">
                <!-- Here you can put content for the dashboard (which can be empty or just a placeholder if needed) -->
                <div class="tab-pane-header">
                    Transactions
                </div>

                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                       <ul>
                            @if(hasRolePermission('savingsAC-transaction-create'))
                            <li>
                                <a href="{{ route('d.index') }}"
                                    class="@if(request()->routeIs('d.index')) current-page @endif">
                                    <span class="fas fa-exchange-alt me-1"></span> Deposit / Withdrawal
                                </a>
                            </li>
                            @endif
                            @if(hasRolePermission('rdAC-transaction-create'))
                            <li>
                                <a href="{{ route('rd.deposit.index') }}"
                                    class="@if(request()->routeIs('rd.deposit.index')) current-page @endif"><span class="fas fa-arrow-circle-down me-1"></span> RD
                                    Deposit</a>
                            </li>
                            @endif
                            @if(hasRolePermission('transaction-list-view'))
                            <li>
                                <a href="{{ route('transaction.index') }}"
                                    class="@if(request()->routeIs('transaction.index')) current-page @endif"> <span class="fas fa-receipt me-1"></span> Transactions</a>
                            </li>
                            @endif

                            @if(auth()->user()->user_type === 'SuperAdmin')
                            <li>
                                <a href="{{ route('pending.transaction') }}"
                                    class="@if(request()->routeIs('pending.transaction')) current-page @endif"><span class="fas fa-list me-1"></span> All Transactions</a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            
            <div class="tab-pane fade {{ request()->routeIs('LoanADApplication*') || request()->routeIs('loan.ad.calculator.form') ? 'show active' : '' }} "
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
                                <a href="{{ route('loan.ad.calculator.form') }}"
                                    class="@if(request()->routeIs('loan.ad.calculator.form')) current-page @endif">
                                    <i class="fas fa-calculator me-2"></i> Loan/EMi Calculator
                                </a>
                            </li>
                            
                            <li>
                                <a href="{{ route('LoanADApplication.index') }}"
                                    class="@if(request()->routeIs('LoanADApplication.index')) current-page @endif">
                                    <span class="fas fa-file-signature me-1"></span> (LAD) Application
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
            </div>


            <!-- Pages tab -->
            {{-- <div class="tab-pane fade {{ request()->routeIs('company*') ? 'show active' : '' }}" id="tab-product"
                role="tabpanel" aria-labelledby="product-tab">

                <!-- Tab content header start -->
                <div class="tab-pane-header">
                    Masters
                </div>
                <!-- Tab content header end -->

                <!-- Sidebar menu starts -->
                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">

                    </div>
                </div>
                <!-- Sidebar menu ends -->

                <!-- Sidebar actions starts -->
                <div class="sidebar-actions">
                    <div class="support-tile">
                        <i class="icon-headphones"></i> 24/7 Support
                    </div>
                </div>
                <!-- Sidebar actions ends -->

            </div> --}}
            
            {{-- Tab content --}}
            
            @if(auth()->user()->user_type === 'SuperAdmin')
            <div class="tab-pane fade {{ request()->routeIs('roles.*') ? 'show active' : '' }}" id="tab-roles"
                role="tabpanel" aria-labelledby="dashboard-tab">

                <div class="tab-pane-header">
                    Access Control
                </div>

                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                        <ul>
                            <li class="list-heading">Roles Management</li>

                            <li>
                                <a href="{{ route('roles.index') }}"
                                    class="@if(request()->routeIs('roles.index')) current-page @endif">
                                    <span class="fas fa-user-shield me-2"></span> All Roles
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('roles.create') }}"
                                    class="@if(request()->routeIs('roles.create')) current-page @endif">
                                    <i class="fas fa-plus-circle me-2"></i> Create Role
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            
            
             <div class="tab-pane fade {{ request()->routeIs('marketcode.index') || request()->routeIs('marketcode.form') || request()->routeIs('rd-interest-slab.index') || request()->routeIs('rd-interest-slab.form') ? 'show active' : '' }}"
                id="tab-marketcode" role="tabpanel" aria-labelledby="dashboard-tab">

                <div class="tab-pane-header">
                    Settings
                </div>

                <div class="sidebarMenuScroll">
                    <div class="sidebar-menu">
                        <ul>
                            <li class="list-heading">Market Code</li>
                            @if(hasRolePermission('marketCodes-list-view'))
                            <li>
                                <a href="{{ route('marketcode.index') }}"
                                    class="@if(request()->routeIs('marketcode.index')) current-page @endif">
                                    <span class="fas fa-tags me-2"></span> All Market Codes
                                </a>
                            </li>
                            @endif
                            @if(hasRolePermission('marketCodes-create'))
                            <li>
                                <a href="{{ route('marketcode.form') }}"
                                    class="@if(request()->routeIs('marketcode.form')) current-page @endif">
                                    <i class="fas fa-plus-circle me-2"></i> Create Market Code
                                </a>
                            </li>
                            @endif

                            @if(hasRolePermission('rdInterestSlab-list-view')
                            ||hasRolePermission('rdInterestSlab-create'))
                            <li class="list-heading mt-3">RD Interest Slab</li>
                            @endif
                            @if(hasRolePermission('rdInterestSlab-list-view'))
                            <li>
                                <a href="{{ route('rd-interest-slab.index') }}"
                                    class="@if(request()->routeIs('rd-interest-slab.index')) current-page @endif">
                                    <span class="fas fa-layer-group me-1"></span> All RD Interest Slab
                                </a>
                            </li>
                            @endif
                            @if(hasRolePermission('rdInterestSlab-create'))
                            <li>
                                <a href="{{ route('rd-interest-slab.form') }}"
                                    class="@if(request()->routeIs('rd-interest-slab.form')) current-page @endif">
                                    <i class="fas fa-plus-circle me-2"></i> Create RD Interest Slab
                                </a>
                            </li>
                            @endif
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
                                                value="{{ auth()->user()->name }}" readonly>
                                            <div class="field-placeholder">Name</div>
                                        </div>

                                        <div class="field-wrapper">

                                            <input type="email" class="form-control" name="email"
                                                value="{{ auth()->user()->email }}" readonly>
                                            <div class="field-placeholder">Email</div>
                                        </div>

                                        <div class="field-wrapper">
                                            <input type="email" class="form-control" name="email"
                                                value="{{ auth()->user()->user_type }}" readonly>
                                            <div class="field-placeholder">Role</div>
                                        </div>
                                        {{--
                                        <button type="submit" class="btn btn-primary w-100" id="updateProfileBtn">
                                            <span class="spinner-border spinner-border-sm d-none"
                                                id="profileSpinner"></span>
                                            Update Profile
                                        </button> --}}

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
                                            @csrf
                                            @method('PUT')

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

        fetch("{{ route('settings.updatePassword') }}", {
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

</script>