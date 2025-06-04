<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="UniPro App">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="<?php echo e(asset('assetsDashboard/img/fav.png')); ?>">
    <title>UniPro Login</title>
    <link rel="stylesheet" href="<?php echo e(asset('assetsDashboard/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assetsDashboard/css/main.css')); ?>">
</head>

<body class="authentication"
    style="background: url('<?php echo e(asset('assetsDashboard/img/bankBg.png')); ?>') no-repeat; background-size: cover; background-attachment: fixed; overflow: auto;">

    <div class="login-container">
        <div class="container-fluid h-100">
            <div class="row g-0 h-100">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="login-about">
                        <div class="slogan">
                            <span>Advanced</span>
                            <span>Banking</span>
                            <span>System.</span>
                        </div>
                        <div class="about-desc">
                            Advanced security measures, such as two-factor authentication and encryption, ensure data
                            protection. With mobile accessibility and real-time reporting tools, users can manage their
                            finances securely and conveniently from anywhere.
                        </div>
                        <a href="crm.html" class="know-more">Know More <img
                                src="<?php echo e(asset('assetsDashboard/img/right-arrow.svg')); ?>" alt="Uni Pro Admin"></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="login-wrapper">

                        <form method="POST" id="loginForm" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="login-screen">
                                <div class="login-body">
                                    <a href="#" class="login-logo">
                                        <img src="<?php echo e(asset('assetsDashboard/img/logo.png')); ?>" alt="iChat">
                                    </a>
                                    <h6>Welcome back,<br>Please login to your account.</h6>
                                    <?php if(session('status')): ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <?php echo e(session('status')); ?>

                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    <?php endif; ?>
                                    <!-- Email Field -->
                                    <div class="field-wrapper">
                                        <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required
                                            autofocus class="form-control">
                                        <div class=" field-placeholder">Email ID
                                        </div>
                                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger mt-2"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>


                                    <!-- Password Field -->
                                    <div class="field-wrapper mb-3">
                                        <input id="password" type="password" name="password" required
                                            class="form-control">
                                        <div class="field-placeholder">Password</div>
                                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="text-danger mt-2"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>


                                    <!-- Remember Me Checkbox -->
                                    <div class="actions">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox" name="remember"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                                        </label>
                                        <a href="<?php echo e(route('password.request')); ?>"
                                            class="text-sm text-gray-600 hover:text-gray-900">Forgot password?</a>
                                        <button type="submit" id="submitButton" class="btn btn-primary">
                                            <span id="buttonText">Login</span>
                                            <span id="loadingSpinner"
                                                class="spinner-border spinner-border-sm text-white d-none"
                                                role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('assetsDashboard/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assetsDashboard/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assetsDashboard/js/modernizr.js')); ?>"></script>
    <script src="<?php echo e(asset('assetsDashboard/js/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('assetsDashboard/js/main.js')); ?>"></script>
</body>

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
                this.form.addEventListener('submit', () => {
                    this.handleSubmit();
                });
            }
        }

        handleSubmit() {
            // Disable the button
            this.submitButton.disabled = true;
            // Show the loading spinner and change text
            this.loadingSpinner.classList.remove('d-none');
            this.buttonText.textContent = '';
        }
    }

    new FormSubmitHandler('loginForm', 'submitButton', 'buttonText', 'loadingSpinner');

</script>

</html><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/auth/login2.blade.php ENDPATH**/ ?>