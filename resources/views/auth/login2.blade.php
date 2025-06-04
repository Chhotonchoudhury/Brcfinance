<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="UniPro App">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="{{ asset('assetsDashboard/img/fav.png') }}">
    <title>UniPro Login</title>
    <link rel="stylesheet" href="{{ asset('assetsDashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assetsDashboard/css/main.css') }}">
</head>

<body class="authentication"
    style="background: url('{{ asset('assetsDashboard/img/bankBg.png') }}') no-repeat; background-size: cover; background-attachment: fixed; overflow: auto;">

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
                                src="{{ asset('assetsDashboard/img/right-arrow.svg') }}" alt="Uni Pro Admin"></a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="login-wrapper">

                        <form method="POST" id="loginForm" action="{{ route('login') }}">
                            @csrf
                            <div class="login-screen">
                                <div class="login-body">
                                    <a href="#" class="login-logo">
                                        <img src="{{ asset('assetsDashboard/img/logo.png') }}" alt="iChat">
                                    </a>
                                    <h6>Welcome back,<br>Please login to your account.</h6>
                                    @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                    <!-- Email Field -->
                                    <div class="field-wrapper">
                                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                            autofocus class="form-control">
                                        <div class=" field-placeholder">Email ID
                                        </div>
                                        @error('email')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <!-- Password Field -->
                                    <div class="field-wrapper mb-3">
                                        <input id="password" type="password" name="password" required
                                            class="form-control">
                                        <div class="field-placeholder">Password</div>
                                        @error('password')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <!-- Remember Me Checkbox -->
                                    <div class="actions">
                                        <label for="remember_me" class="inline-flex items-center">
                                            <input id="remember_me" type="checkbox" name="remember"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                                        </label>
                                        <a href="{{ route('password.request') }}"
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
                                {{-- <div class="login-footer">
                                    <span class="additional-link">No Account? <a href="" class="btn btn-light">Sign
                                            Up</a></span>
                                </div> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assetsDashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assetsDashboard/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assetsDashboard/js/modernizr.js') }}"></script>
    <script src="{{ asset('assetsDashboard/js/moment.js') }}"></script>
    <script src="{{ asset('assetsDashboard/js/main.js') }}"></script>
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

</html>