<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="UniPro App">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="{{ asset('assetsDashboard/img/fav.png') }}">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('assetsDashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsDashboard/css/main.css') }}">
</head>

<body class="authentication"
    style="background: url('{{ asset('assetsDashboard/img/bankBg.png') }}') no-repeat; background-size: cover; background-attachment: fixed; overflow: auto;">

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
                            <span>Design</span>
                            <span>Made</span>
                            <span>Simple.</span>
                        </div>
                        <div class="about-desc">
                            UniPro is an intelligent and communications tool, built for teams. It provides an integrated
                            platform that makes team communication easy and efficient.
                        </div>
                        <a href="#" class="know-more">Know More <img
                                src="{{ asset('assetsDashboard/img/right-arrow.svg') }}" alt="Uni Pro Admin"></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="login-wrapper">
                        <form method="POST" action="{{ route('password.store') }}" id="resetPasswordForm">
                            @csrf
                            <div class="login-screen">
                                <div class="login-body pb-4">
                                    <a href="#" class="login-logo">
                                        <img src="{{ asset('assetsDashboard/img/logo.png') }}" alt="Uni Pro Admin">
                                    </a>
                                    <h6>Enter the reset code sent to your email and set your new password below.</h6>

                                    <!-- Hidden Token -->
                                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                                    <!-- Email Address -->
                                    <div class="field-wrapper mb-3">
                                        <input type="email" id="email" name="email"
                                            value="{{ old('email', request()->email) }}" required autofocus>
                                        <div class="field-placeholder">Enter Email Address</div>
                                        @error('email')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="field-wrapper mb-3">
                                        <input type="password" id="password" name="password" required>
                                        <div class="field-placeholder">Enter New Password</div>
                                        @error('password')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="field-wrapper mb-3">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                            required>
                                        <div class="field-placeholder">Confirm New Password</div>
                                        @error('password_confirmation')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="actions">
                                        <button type="submit" class="btn btn-danger ms-auto" id="submitButton">
                                            <span id="buttonText">Reset Password</span>
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

    <script src="{{ asset('assetsDashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assetsDashboard/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetsDashboard/js/main.js') }}"></script>

    <script>
        document.getElementById('resetPasswordForm').addEventListener('submit', function (event) {
            const submitButton = document.getElementById('submitButton');
            const buttonText = document.getElementById('buttonText');
            const loadingSpinner = document.getElementById('loadingSpinner');

            // Disable button and show spinner
            submitButton.disabled = true;
            buttonText.textContent = 'Processing...';
            loadingSpinner.classList.remove('d-none');
        });
    </script>
</body>

</html>