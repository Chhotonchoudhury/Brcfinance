<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Banking Dashboard</title>

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="shortcut icon" href="<?php echo e($favicon); ?>">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .card-balance {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            border: none;
            border-radius: 15px;
        }

        .offcanvas-body a {
            padding: 0.6rem 0;
            border-bottom: 1px solid #f1f1f1;
            font-size: 0.95rem;
        }

        .footer-icon i {
            color: #6c757d;
            transition: color 0.2s;
        }

        .footer-icon.active i,
        .footer-icon:hover i {
            color: #0d6efd;
        }

        .bottom-nav a {
            font-size: 0.85rem;
        }

        .offcanvas-end {
            width: 100% !important;
            max-width: 375px;
        }

        /* Custom Sidebar Styles */
        .offcanvas-header {
            border-bottom: 1px solid #ddd;
        }

        .sidebar-logo img {
            width: 35px;
            /* Adjusted size */
            height: auto;
            object-fit: contain;
            /* Ensures the logo scales without distortion */
        }

        /* User Profile Section */
        .profile-header {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .profile-header h6 {
            margin-bottom: 0;
        }

        .profile-header p {
            font-size: 0.8rem;
            color: #6c757d;
        }

        /* Navbar Logo */
        header .navbar-logo img {
            width: 5px;
            /* Adjust this value to fit the logo */
            height: auto;
            object-fit: contain;
        }

        /* Ensure the sidebar is scrollable */
        .offcanvas-body {
            overflow-y: auto;
        }


        /* Custom Scrollbar Styles */
        ::-webkit-scrollbar {
            width: 3px;
            /* Very thin scrollbar */
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
            /* Transparent track */
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgba(0, 123, 255, 0.7);
            /* Blue color matching your theme */
            border-radius: 10px;
            /* Rounded edges */
            border: 1px solid transparent;
            /* Border to prevent thumb from looking too thick */
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: rgba(0, 123, 255, 1);
            /* Slightly darker color on hover */
        }

        /* For Firefox */
        scrollbar-width: thin;
        scrollbar-color: rgba(0, 123, 255, 0.7) transparent;
    </style>
</head>

<body class="d-flex justify-content-center bg-light">

    <!-- Mobile Fixed Width Wrapper -->
    <div class="d-flex flex-column vh-100 shadow-sm bg-white position-relative" style="width: 375px; max-width: 100%;">

        <!-- Header -->
        <header class="bg-primary text-white p-3 d-flex justify-content-between align-items-center shadow-sm">
            <div class="d-flex align-items-center">
                
                <h5 class="mb-0">BRCFinance</h5>
            </div>
            <i class="fas fa-user-circle fs-4"></i>
        </header>

        <!-- Main Content -->
        <main class="flex-fill overflow-auto p-3">

            <!-- Welcome -->
            <!--<div class="mb-3">-->
            <!--    <h6>Hello, John Doe 👋</h6>-->
            <!--    <p class="text-muted mb-0">Welcome back to your dashboard</p>-->
            <!--</div>-->

             <!--Balance Card -->
            <div class="card card-balance mb-4 rounded-4 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase">Available RD Balance</small>
                            <h4 class="fw-bold mt-1">₹24,360.00</h4>
                        </div>
                        <i class="fas fa-wallet fa-2x"></i>
                    </div>
                </div>
            </div>

                  <!-- Row 1 -->
        <!--<div class="row text-center g-3">-->
        <!--      <div class="col-4">-->
        <!--               <a href="<?php echo e(route('frontend.tran')); ?>" class="text-decoration-none text-dark">-->
        <!--                    <div class="bg-white rounded-4 py-3 shadow-sm">-->
        <!--                        <i class="fas fa-receipt text-primary fs-4 mb-1"></i>-->
        <!--                        <div class="small">RD Tran..</div>-->
        <!--                    </div>-->
        <!--                </a>-->
        <!--       </div>-->
        <!--    <div class="col-4">-->
        <!--        <div class="bg-white rounded-4 py-3 shadow-sm">-->
        <!--            <i class="fas fa-download text-success fs-4 mb-1"></i>-->
        <!--            <div class="small">Receive</div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--    <div class="col-4">-->
        <!--        <div class="bg-white rounded-4 py-3 shadow-sm">-->
        <!--            <i class="fas fa-exchange-alt text-warning fs-4 mb-1"></i>-->
        <!--            <div class="small">Transfer</div>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div><br>-->
        
            <!-- Transaction Section -->
    <div class="mt-4">
        <h6 class="mb-3">Recent Transactions</h6>
    
        <!-- Transaction Item -->
        <div class="card border-0 shadow-sm mb-3 rounded-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 45px; height: 45px;">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">Sent to Ramesh</div>
                        <small class="text-muted">Apr 28, 2025 • 9:42 AM</small>
                    </div>
                </div>
                <div class="text-end">
                    <div class="text-danger fw-semibold">- ₹1,250.00</div>
                    <small class="text-muted">UPI</small>
                </div>
            </div>
        </div>
    
        <!-- Another Transaction -->
        <div class="card border-0 shadow-sm mb-3 rounded-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 45px; height: 45px;">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">Received from Salary</div>
                        <small class="text-muted">Apr 27, 2025 • 6:00 PM</small>
                    </div>
                </div>
                <div class="text-end">
                    <div class="text-success fw-semibold">+ ₹52,000.00</div>
                    <small class="text-muted">Bank Transfer</small>
                </div>
            </div>
        </div>
        
         <!-- Transaction Item -->
        <div class="card border-0 shadow-sm mb-3 rounded-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 45px; height: 45px;">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">Sent to Ramesh</div>
                        <small class="text-muted">Apr 28, 2025 • 9:42 AM</small>
                    </div>
                </div>
                <div class="text-end">
                    <div class="text-danger fw-semibold">- ₹1,250.00</div>
                    <small class="text-muted">UPI</small>
                </div>
            </div>
        </div>
    
        <!-- Another Transaction -->
        <div class="card border-0 shadow-sm mb-3 rounded-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 45px; height: 45px;">
                        <i class="fas fa-arrow-down"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">Received from Salary</div>
                        <small class="text-muted">Apr 27, 2025 • 6:00 PM</small>
                    </div>
                </div>
                <div class="text-end">
                    <div class="text-success fw-semibold">+ ₹52,000.00</div>
                    <small class="text-muted">Bank Transfer</small>
                </div>
            </div>
        </div>
    
        <!-- Third Transaction -->
        <div class="card border-0 shadow-sm mb-3 rounded-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                        style="width: 45px; height: 45px;">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">Electricity Bill</div>
                        <small class="text-muted">Apr 26, 2025 • 11:10 AM</small>
                    </div>
                </div>
                <div class="text-end">
                    <div class="text-danger fw-semibold">- ₹1,100.00</div>
                    <small class="text-muted">BillDesk</small>
                </div>
            </div>
        </div>
    </div>



            
        </main>

        <!-- Footer Navigation -->
        <footer class="bg-white border-top shadow-sm py-2">
            <div class="container d-flex justify-content-between px-3">
                <a href="<?php echo e(route('frontend.test')); ?>" class="text-center flex-fill footer-icon active">
                    <i class="fas fa-home fs-5"></i>
                </a>
                <a href="#" class="text-center flex-fill footer-icon">
                    <i class="fas fa-wallet fs-5"></i>
                </a>
                <a href="#" class="text-center flex-fill footer-icon">
                    <i class="fas fa-bell fs-5"></i>
                </a>
                <a href="#" class="text-center flex-fill footer-icon" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu">
                    <i class="fas fa-bars fs-5"></i>
                </a>
            </div>
        </footer>

        <!-- Sidebar Menu -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="sidebarMenu" style="width: 455px; max-width: 100%;">
            <div class="offcanvas-header">
                <h6 class="offcanvas-title">Menu</h6>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column gap-3">
                <div class="profile-header">
                    <img src="<?php echo e(asset($companyLogo)); ?>" alt="User" class="img-fluid">
                    <div>
                        <h6>John Doe</h6>
                        <p>Premium Member</p>
                    </div>
                </div>
                <a href="#" class="text-dark d-flex align-items-center">
                    <i class="fas fa-user me-2"></i> Profile
                </a>
                <a href="#" class="text-dark d-flex align-items-center">
                    <i class="fas fa-history me-2"></i> Transaction History
                </a>
                <a href="#" class="text-dark d-flex align-items-center">
                    <i class="fas fa-lock me-2"></i> Security
                </a>
                <a href="#" class="text-dark d-flex align-items-center">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/tran.blade.php ENDPATH**/ ?>