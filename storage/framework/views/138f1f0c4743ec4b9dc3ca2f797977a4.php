<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>App Onboarding</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .app-wrapper {
            width: 375px;
            max-width: 100%;
            min-height: 100vh;
            margin: auto;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 1.5rem;
            background: #fff;
        }

        .form-section {
            margin-bottom: 2rem;
        }

        .otp-input input,
        .pin-input input {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            text-align: center;
            border-radius: 10px;
            border: 1px solid #ced4da;
            margin: 0 5px;
        }

        .form-title {
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .btn-primary {
            border-radius: 10px;
        }

        .logo {
            width: 80px;
            height: auto;
            margin-bottom: 1rem;
            border-radius: 10px;
        }

        .text-muted {
            font-size: 0.9rem;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }
    </style>
</head>

<body>

    <div class="app-wrapper shadow-sm">

        <div class="text-center mb-4">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <img src="<?php echo e(asset($companyLogo)); ?>" class="img-fluid" style="max-height: 60px;" alt="App Logo">
            </div>
            <h4 class="fw-semibold text-dark mb-1">Welcome to <span class="text-primary">BrcFinance</span></h4>
            <p class="text-secondary small mb-0">Let's verify your identity</p>
        </div>


        <!-- Step 1: Email -->
        <div class="step active" id="step-1">
            <div class="form-section">
                <div class="form-title">Enter Your Email</div>
                <input type="email" id="email" class="form-control" placeholder="you@example.com" required>
            </div>
        </div>

        <!-- Step 2: OTP -->
        <div class="step" id="step-2">
            <div class="form-section">
                <div class="form-title">Enter OTP</div>
                <div class="d-flex justify-content-between otp-input">
                    <input type="text" maxlength="1" class="form-control otp" required>
                    <input type="text" maxlength="1" class="form-control otp" required>
                    <input type="text" maxlength="1" class="form-control otp" required>
                    <input type="text" maxlength="1" class="form-control otp" required>
                </div>
            </div>
        </div>

        <!-- Step 3: Set + Confirm PIN -->
        <div class="step" id="step-3">
            <div class="form-section">
                <div class="form-title">Set Your 4-Digit PIN</div>
                <div class="d-flex justify-content-between pin-input mb-3">
                    <input type="password" maxlength="1" class="form-control pin" required>
                    <input type="password" maxlength="1" class="form-control pin" required>
                    <input type="password" maxlength="1" class="form-control pin" required>
                    <input type="password" maxlength="1" class="form-control pin" required>
                </div>
                <div class="form-title">Confirm Your PIN</div>
                <div class="d-flex justify-content-between pin-input">
                    <input type="password" maxlength="1" class="form-control confirm-pin" required>
                    <input type="password" maxlength="1" class="form-control confirm-pin" required>
                    <input type="password" maxlength="1" class="form-control confirm-pin" required>
                    <input type="password" maxlength="1" class="form-control confirm-pin" required>
                </div>
            </div>
        </div>

        <!-- Button -->
        <button class="btn btn-primary w-100 py-2" id="continueBtn">
            <span class="spinner-border spinner-border-sm me-2 d-none" id="spinner"></span>
            Continue
        </button>

    </div>

    <!-- Script -->
    <script>
        let currentStep = 1;

        const steps = {
            1: document.getElementById("step-1"),
            2: document.getElementById("step-2"),
            3: document.getElementById("step-3")
        };

        const btn = document.getElementById("continueBtn");
        const spinner = document.getElementById("spinner");

        // Auto-tab between inputs
        document.querySelectorAll('.otp-input input, .pin-input input').forEach((input, idx, inputs) => {
            input.addEventListener('input', () => {
                if (input.value.length === 1 && idx < inputs.length - 1) {
                    inputs[idx + 1].focus();
                }
            });
        });

        btn.addEventListener("click", () => {
            spinner.classList.remove("d-none");
            btn.disabled = true;

            setTimeout(() => {
                spinner.classList.add("d-none");
                btn.disabled = false;

                if (currentStep === 1) {
                    const email = document.getElementById("email").value.trim();
                    if (!email) {
                        alert("Please enter your email.");
                        return;
                    }
                    showStep(2);
                } else if (currentStep === 2) {
                    const otpValues = Array.from(document.querySelectorAll(".otp")).map(el => el.value.trim());
                    if (otpValues.some(val => val === '')) {
                        alert("Please enter complete OTP.");
                        return;
                    }
                    showStep(3);
                } else if (currentStep === 3) {
                    const pin = Array.from(document.querySelectorAll(".pin")).map(el => el.value.trim()).join('');
                    const confirmPin = Array.from(document.querySelectorAll(".confirm-pin")).map(el => el.value.trim()).join('');

                    if (pin.length < 4 || confirmPin.length < 4) {
                        alert("Please enter complete PIN and confirmation.");
                        return;
                    }

                    if (pin !== confirmPin) {
                        alert("PIN and confirmation do not match.");
                        return;
                    }

                    // Redirect to /test
                    window.location.href = "/test";
                }
            }, 800); // simulate loading
        });

        function showStep(stepNumber) {
            for (let step in steps) {
                steps[step].classList.remove("active");
            }
            steps[stepNumber].classList.add("active");
            currentStep = stepNumber;
        }
    </script>
</body>

</html><?php /**PATH /home/u519289329/domains/brcfinance.in/public_html/resources/views/otp.blade.php ENDPATH**/ ?>