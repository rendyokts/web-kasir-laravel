<x-head-auth>Login</x-head-auth>

<body>
    <!-- Content -->
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
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
                    <img src="{{ asset('assets/img/restaurant-56.png') }}" alt="logo" style="width: 60px; height:auto;">
                </span>
            </span>
            <span class="app-brand-text demo text-heading fw-bold">WARKOPOS</span>
        </a>
        <!-- /Logo -->
        <div class="authentication-inner row m-0">
            <!-- /Left Text -->
            <div class="d-none d-xl-flex col-xl-8 p-0">
                <div class="auth-cover-bg d-flex justify-content-center align-items-center">
                    <img src="{{ asset('portos/assets/img/illustrations/auth-login-illustration-light.png') }}"
                        alt="auth-login-cover" class="my-5 auth-illustration" />
                    <img src="{{ asset('portos/assets/img/illustrations/bg-shape-image-light.png') }}"
                        alt="auth-login-cover" class="platform-bg" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-xl-4 align-items-center authentication-bg p-sm-12 p-6">
                <div class="w-px-400 mx-auto mt-12 pt-5">
                    <h4 class="mb-1">Selamat Datang di Warkop Aceng</h4>
                    <p class="mb-6">Silahkan login dulu borr</p>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="d-flex flex-column justify-start align-content-center mb-1 p-0">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item ">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="mb-6">
                        @csrf
                        <div class="mb-6">
                            <label for="login" class="form-label">Username/Email</label>
                            <input type="text" class="form-control" id="login" name="login" autofocus />
                        </div>
                        <div class="mb-6 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password" />
                                <span class="input-group-text cursor-pointer"><i
                                        class="icon-base ti tabler-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="my-8">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('password.request') }}">
                                    <p class="mb-0">Lupa Password?</p>
                                </a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100">Masuk</button>
                    </form>

                    <p class="text-center">
                        <span>Belum punya akun?</span>
                        <a href="{{ route('register') }}">
                            <span>Gass bikin dulu</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
    <!-- / Content -->
    <!-- Core JS -->
    @extends('layouts.scripts')
    @section('page-js')
    <!-- Vendors JS -->
    <script src="{{ asset('portos/assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('portos/assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('portos/assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('portos/assets/js/pages-auth.js') }}"></script>
    @endsection
</body>

</html>
