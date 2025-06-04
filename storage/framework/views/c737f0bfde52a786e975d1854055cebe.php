<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no">
    <meta name="description" content="UniPro App">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="<?php echo e(asset('assetsDashboard/img/fav.png')); ?>">
    <title>Email Verification</title>
    <link rel="stylesheet" href="<?php echo e(asset('assetsDashboard/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assetsDashboard/css/main.css')); ?>">
</head>

<body class="authentication"
    style="background: url('<?php echo e(asset('assetsDashboard/img/bankBg.png')); ?>') no-repeat; background-size: cover; background-attachment: fixed; overflow: auto;">

    <!-- Loading wrapper start -->
    <div id="loading-wrapper">
        <div class="spinner-border"></div>
        Loading...
    </div>
    <!-- Loading wrapper end -->

    <div class="login-container">
        <div class="container-fluid h-100">
            <!-- Row start -->
            <div class="row no-gutters h-100">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="login-about">
                        <div class="slogan">
                            <span>Verify</span>
                            <span>Your</span>
                            <span>Email.</span>
                        </div>
                        <div class="about-desc">
                            Ensure the security of your account by verifying your email address. If you didn't receive
                            the verification email, you can request another one.
                        </div>
                        <a href="#" class="know-more">Learn More <img src="<?php echo e(asset('assetsDashboard/img/logo.png')); ?>"
                                alt="Uni Pro Admin"></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="login-wrapper">
                        <form method="POST" action="<?php echo e(route('verification.send')); ?>" id="verificationForm">
                            <?php echo csrf_field(); ?>
                            <div class="login-screen">
                                <div class="login-body pb-4">
                                    <a href="#" class="login-logo">
                                        <img src="<?php echo e(asset('assetsDashboard/img/logo.png')); ?>" alt="Uni Pro Admin">
                                    </a>
                                    <h6>Verify Your Email Address</h6>

                                    <?php if(session('status') == 'verification-link-sent'): ?>
                                    <div class="bg-success mb-4 font-medium text-sm text-green-600">
                                        <?php echo e(__('A new verification link has been sent to the email address you provided
                                        during registration.')); ?>

                                    </div>
                                    <?php endif; ?>

                                    <div class="actions">
                                        <button type="submit" class="btn btn-primary ms-auto" id="submitButton">
                                            <span id="buttonText">Send Verification Email</span>
                                            <span id="loadingSpinner"
                                                class="spinner-border spinner-border-sm d-none"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Row end -->
        </div>
    </div>

    <script src="<?php echo e(asset('assetsDashboard/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assetsDashboard/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assetsDashboard/js/main.js')); ?>"></script>

    <script>
        console.log('Script loaded');
        document.getElementById('verificationForm').addEventListener('submit', function (event) {
            console.log('Form submitted');
            const submitButton = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            console.log('Disabling button and showing spinner');
            // Disable button and show spinner
            submitButton.disabled = true;
            buttonText.textContent = 'Sending...';
            loadingSpinner.classList.remove('d-none');
        });
    </script>
</body>

</html><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/auth/verify-email.blade.php ENDPATH**/ ?>