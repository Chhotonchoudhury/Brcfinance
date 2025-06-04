<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Navbar with Sidebar & Footer</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="shortcut icon" href="<?php echo e($favicon); ?>">

    <style>
        /* Global Reset */
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        main {
            flex: 1;
        }

        /* Colors and Fonts */
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #3b82f6;
            --accent-color: #ef4444;
            --light-color: #f1f5f9;
            --dark-color: #1f2937;
            --text-light: #ffffff;
            --text-dark: #374151;

        }

        /* Navbar */
        .navbar {
            /* Ensure it's above other elements like sidebar */
            background-color: var(--primary-color);
        }

        .navbar-brand img {
            max-height: 40px;
        }

        .navbar-nav .nav-link {
            color: var(--text-light);
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: var(--accent-color);
        }

        .navbar-nav .nav-link.active {
            color: var(--accent-color) !important;
            /* Use your custom accent color */
            font-weight: bold;
            /* Optional for emphasis */
        }


        .navbar-toggler {
            border: none;
            color: var(--text-light);
            background-color: var(--secondary-color);
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar-toggler-icon {
            color: var(--text-light);
        }

        .navbar-toggler:hover {
            background-color: var(--accent-color);
            color: var(--text-light);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            height: 100%;
            background-color: var(--secondary-color);
            color: var(--text-light);
            padding-top: 60px;
            z-index: 1050;
            transition: left 0.3s ease;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
        }

        .sidebar ul li a {
            color: var(--text-light);
            text-decoration: none;
            font-size: 18px;
            display: block;
            transition: background-color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: var(--accent-color);
            border-radius: 5px;
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }

        .overlay.show {
            display: block;
        }

        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: var(--text-light);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        footer a {
            color: var(--text-light);
            text-decoration: none;
            margin-right: 15px;
            transition: color 0.3s;
        }

        footer a:hover {
            color: var(--accent-color);
        }

        .footer-links {
            display: flex;
            gap: 20px;
        }

        .social-icons a {
            font-size: 20px;
            margin-right: 15px;
        }

        @media (max-width: 768px) {
            .footer-links {
                flex-wrap: wrap;
                gap: 10px;
            }
        }
    </style>
    <?php echo $__env->make('layouts.headerLink', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top top-0 ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="<?php echo e(asset($companyLogo)); ?>" alt="Logo"></a>
            <button class="navbar-toggler btn-warning" id="toggleSidebar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-none d-lg-flex">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link <?php echo e(Request::is('/') ? 'active' : ''); ?>" href="/">Home</a>
                    </li>
                    <li class="nav-item"><a class="nav-link <?php echo e(Request::is('accounts') ? 'active' : ''); ?>"
                            href="/accounts">Accounts</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo e(route('frontend.test1')); ?>">ProtoType</a></li>

                    <!-- Download App Button -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-danger text-white" href="<?php echo e(asset('AndriodApp.apk')); ?>"
                            id="downloadBtnNavbar">
                            <i class="fas fa-download me-2"></i> Download App
                        </a>
                        <div id="loadingNavbar" style="display: none; margin-top: 10px;">
                            <i class="fas fa-spinner fa-spin"></i> Downloading...
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="/" class="<?php echo e(Request::is('/') ? 'active' : ''); ?>">Home</a></li>
            <li><a href="/accounts" class="<?php echo e(Request::is('accounts') ? 'active' : ''); ?>">Accounts</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="<?php echo e(route('login')); ?>">Login</a></li>
            <li><a href="<?php echo e(route('frontend.test1')); ?>">ProtoType</a></li>
            <!-- Sidebar Download Button -->
            <div class="download-app">
                <a href="<?php echo e(asset('AndriodApp.apk')); ?>" class="btn btn-outline-success text-white download-btn"
                    download id="downloadBtnSidebar">
                    <i class="fas fa-download me-2"></i> Download Our App
                </a>
                <div id="loadingSidebar" style="display: none; margin-top: 10px;">
                    <i class="fas fa-spinner fa-spin"></i> Downloading...
                </div>
            </div>
        </ul>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>




    <!-- Main Content -->
    <main class="container py-5">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-links">
            <a href="#">About Us</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');
        const toggleSidebar = document.getElementById('toggleSidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });


    function showLoading(buttonId, loadingId) {
        const downloadBtn = document.getElementById(buttonId);
        const loadingText = document.getElementById(loadingId);

        if (downloadBtn) {
            downloadBtn.addEventListener("click", function () {
                loadingText.style.display = "block";

                // Hide loading text after 5 seconds
                setTimeout(() => {
                    loadingText.style.display = "none";
                }, 5000);
            });
        }
    }

    // Apply to both download buttons
    showLoading("downloadBtnNavbar", "loadingNavbar");
    showLoading("downloadBtnSidebar", "loadingSidebar");

    </script>
    <?php echo $__env->make('layouts.footerLink', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('scripts'); ?>


</body>

</html><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/home.blade.php ENDPATH**/ ?>