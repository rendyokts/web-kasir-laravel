<!doctype html>

<html lang="en" class="layout-wide customizer-hide" dir="ltr" data-skin="default"
    data-assets-path="{{ asset('portos/assets') }}" data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Lupa password|WARKOPOS</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('portos/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/fonts/iconify-icons.css') }}" />

    <!-- Core CSS -->
    <!-- build:css assets/vendor/css/theme.css  -->

    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/pickr/pickr-themes.css') }}" />

    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('portos/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- endbuild -->

    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/libs/@form-validation/form-validation.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('portos/assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('portos/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('portos/assets/vendor/js/template-customizer.js') }}"></script>

    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script src="{{ asset('portos/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    @if (session('status'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('status') }}',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif


    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="{{ route('login') }}" class="app-brand auth-cover-brand">
            <span class="app-brand-logo demo">
                <span class="text-primary">
                    <img src="{{ asset('assets/img/restaurant-56.png') }}" alt="logo"
                        style="width: 60px; height:auto;">
                </span>
            </span>
            <span class="app-brand-text demo text-heading fw-bold">WARKOPOS</span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-xl-flex col-xl-8 p-0">
                <div class="auth-cover-bg d-flex justify-content-center align-items-center">
                    <img src="{{ asset('portos/assets/img/illustrations/auth-forgot-password-illustration-light.png') }}"
                        alt="auth-forgot-password-cover" class="my-5 auth-illustration" />
                    <img src="{{ asset('portos/assets/img/illustrations/bg-shape-image-light.png') }}"
                        alt="auth-forgot-password-cover" class="platform-bg" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Forgot Password -->
            <div class="d-flex col-12 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-12 mt-5">
                    <h4 class="mb-1">Lupa Password? 🔒</h4>
                    <p class="mb-6">Masukkan email Anda dan kami akan mengirimkan instruksi untuk mengatur ulang kata
                        sandi Anda</p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="formAuthentication" class="mb-6" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-6 form-control-validation">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Enter your email" autofocus />
                        </div>
                        <button class="btn btn-primary d-grid w-100" type="submit" >Send Reset Link</button>
                    </form>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="d-flex justify-content-center">
                            <i class="icon-base ti tabler-chevron-left scaleX-n1-rtl me-1_5"></i>
                            Back to login
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

    <script src="{{ asset('portos/assets/vendor/libs/jquery/jquery.js') }}"></script>


    <script src="{{ asset('portos/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('portos/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('portos/assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('portos/assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script>

    <script src="{{ asset('portos/assets/vendor/libs/pickr/pickr.js') }}"></script>

    <script src="{{ asset('portos/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('portos/assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{ asset('portos/assets/vendor/libs/i18n/i18n.js') }}"></script>

    <script src="{{ asset('portos/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('portos/assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('portos/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('portos/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Main JS -->

    <script src="{{ asset('portos/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('portos/assets/js/pages-auth.js') }}"></script>
</body>

</html>
