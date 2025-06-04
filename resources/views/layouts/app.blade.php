<!doctype html>
<html lang="en">

<!-- Mirrored from www.bootstrapget.com/demos/themeforest/unipro-admin-template/demos/01-design-blue/layout-full-screen.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Dec 2024 04:30:50 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap4 Dashboard Template">
    <meta name="author" content="ParkerThemes">
    <link rel="shortcut icon" href="{{ $favicon }}">

    <!-- Title -->
    <title>@yield('title')</title>


    <!-- *************
			************ Common Css Files *************
		************ -->
    <!-- Bootstrap css -->
    @include('layouts/headerLink')

    @yield('style')

</head>

<body class="fullscreen ">

    <!-- Loading wrapper start -->
    @yield('loading')


    <!-- Loading wrapper end -->

    <!-- Page wrapper start -->
    <div class="page-wrapper">

        <!-- Sidebar wrapper start -->
        @include('layouts/navbar')
        <!-- Sidebar wrapper end -->

        <!-- *************
				************ Main container start *************
			************* -->
        <div class="main-container">

            <!-- Page header starts -->
            @include('layouts/header')
            <!-- Page header ends -->

            <!-- Content wrapper scroll start -->
            <div class="content-wrapper-scroll">

                <!-- Content wrapper start -->
                <div class="content-wrapper">

                    @yield('content')

                </div>
                <!-- Content wrapper end -->

                <!-- App Footer start -->
                <div class="app-footer">© Uni Pro Admin 2021</div>
                <!-- App footer end -->

            </div>
            <!-- Content wrapper scroll end -->

        </div>
        <!-- *************
				************ Main container end *************
			************* -->

    </div>
    <!-- Page wrapper end -->

    <!-- *************
			************ Required JavaScript Files *************
		************* -->
    <!-- Required jQuery first, then Bootstrap Bundle JS -->
    @include('layouts/footerLink')
    <script>
        function showLoadingEffect(event) {
        event.preventDefault(); // Prevents immediate redirection
        const button = event.target.closest('a');
        const spinner = document.getElementById('loadingSpinner');
        
        if (spinner) {
            spinner.style.display = 'inline-block'; // Show spinner
        }

        // Navigate to the URL after showing the spinner
        if (button && button.href) {
            window.location.href = button.href;
        } else {
            console.error("Button URL is undefined.");
        }
    }



    // Function to preview the selected image or display default if not selected
        function previewImage(event, previewId, previewContainerId) {
            const file = event.target.files[0];
            const reader = new FileReader();

            // Check if a file is selected
            if (file) {
                // Create an image URL
                reader.onload = function() {
                    const previewContainer = document.getElementById(previewContainerId);
                    const previewImg = document.getElementById(previewId);
                    
                    // Set the source of the preview image
                    previewImg.src = reader.result;

                    // Show the preview container
                    previewContainer.style.display = 'block';
                };

                // Read the file as a Data URL (base64)
                reader.readAsDataURL(file);
            }
            else {
                // Hide preview if no file selected
                const previewContainer = document.getElementById(previewContainerId);
                previewContainer.style.display = 'none';
            }
        }


        //form submitting 
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
                this.buttonText.textContent = 'Loading..';
            }
        }

    </script>


    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right", // You can change this to any other position class
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",  // Duration of the show animation
            "hideDuration": "1000", // Duration of the hide animation
            "timeOut": "5000",      // Time the toast is visible (ms)
            "extendedTimeOut": "1000", // Time for which the toast stays after hover
            "showEasing": "swing",  // Easing function for the show animation
            "hideEasing": "linear", // Easing function for the hide animation
            "showMethod": "fadeIn", // Animation method for showing the toast
            "hideMethod": "fadeOut" // Animation method for hiding the toast
        };
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
        // Check if session has a 'success' message
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @elseif(session('error'))
            toastr.error("{{ session('error') }}");
        @elseif(session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    });
    </script>

    <script>
        function setupPrintButton(buttonId, tableId) {
            document.getElementById(buttonId).addEventListener('click', function() {
                let printWindow = window.open('', '', 'height=500,width=800');
                printWindow.document.write('<html><head><title>Print Table</title>');
                printWindow.document.write('</head><body>');
                printWindow.document.write(document.getElementById(tableId).outerHTML);
                printWindow.document.write('</body></html>');
                printWindow.document.close();
                printWindow.print();
            });
        }

    

    </script>

    @yield('script')

</body>

<!-- Mirrored from www.bootstrapget.com/demos/themeforest/unipro-admin-template/demos/01-design-blue/layout-full-screen.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 07 Dec 2024 04:30:50 GMT -->

</html>