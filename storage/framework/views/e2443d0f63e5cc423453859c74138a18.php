<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="UniPro App">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="<?php echo e(asset('assetsDashboard/img/fav.png')); ?>">
    <title>Forgot Password</title>
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
                            <span>Reset</span>
                            <span>Your</span>
                            <span>Password.</span>
                        </div>
                        <div class="about-desc">
                            Provide the email address associated with your account. We’ll send you a link to reset your
                            password.
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="login-wrapper">
                        <form id="forgotPasswordForm" action="<?php echo e(route('password.email')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="login-screen">
                                <div class="login-body pb-4">
                                    <a href="#" class="login-logo">
                                        <img src="<?php echo e(asset('assetsDashboard/img/logo.png')); ?>" alt="Uni Pro Admin">
                                    </a>
                                    <h6>Please enter your email to receive a password reset link.</h6>
                                    <div class="field-wrapper mb-3">
                                        <input type="email" name="email" id="email" placeholder="Enter your email"
                                            required autofocus>
                                        <div class="field-placeholder">Email Address</div>
                                        <div class="text-danger mt-1"><?php echo e($errors->first('email')); ?></div>
                                    </div>
                                    <div class="actions">
                                        <button type="submit" id="submitButton" class="btn btn-danger ms-auto">
                                            <span id="buttonText">Send Reset Link</span>
                                            <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none"
                                                role="status" aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <?php if(session('status')): ?>
                                    <div class="alert alert-success mt-3">
                                        <?php echo e(session('status')); ?>

                                    </div>
                                    <?php endif; ?>
                                    <div class="actions">

                                        <a href="<?php echo e(route('login')); ?>"
                                            class="text-sm text-gray-600 hover:text-gray-900">Back to Login</a>
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
        class FormSubmitHandler {
            constructor(formId, buttonId, buttonTextId, spinnerId) {
                this.form = document.getElementById(formId);
                this.submitButton = document.getElementById(buttonId);
                this.buttonText = document.getElementById(buttonTextId);
                this.loadingSpinner = document.getElementById(spinnerId);

                this.initialize();
            }

            initialize() {
                if (this.form && this.submitButton && this.buttonText && this.loadingSpinner) {
                    this.form.addEventListener('submit', (event) => {
                        this.handleSubmit(event);
                    });
                }
            }

            handleSubmit(event) {
                // Prevent form submission to allow for validations
                if (!this.validateForm()) {
                    event.preventDefault();
                    return;
                }

                // Disable the button
                this.submitButton.disabled = true;
                // Show the loading spinner and change text
                this.loadingSpinner.classList.remove('d-none');
                this.buttonText.textContent = 'Loading..';
            }

            validateForm() {
                const emailField = document.getElementById('email');
                if (!emailField.value) {
                    alert('Email is required.');
                    return false;
                }
                return true;
            }
        }

        new FormSubmitHandler('forgotPasswordForm', 'submitButton', 'buttonText', 'loadingSpinner');

    </script>

</body>

</html><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/auth/forgot-password2.blade.php ENDPATH**/ ?>