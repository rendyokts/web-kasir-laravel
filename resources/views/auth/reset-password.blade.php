<x-head-auth>Reset Password</x-head-auth>

<body>
    <!-- Content -->

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
                    <img src="{{ asset('portos/assets/img/illustrations/auth-reset-password-illustration-light.png') }}"
                        alt="auth-reset-password-cover" class="my-5 auth-illustration" />
                    <img src="{{ asset('portos/assets/img/illustrations/bg-shape-image-light.png') }}"
                        alt="auth-reset-password-cover" class="platform-bg" />
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Reset Password -->
            <div class="d-flex col-12 col-xl-4 align-items-center authentication-bg p-6 p-sm-12">
                <div class="w-px-400 mx-auto mt-12 pt-5">
                    <h4 class="mb-1">Reset Password 🔒</h4>
                    <p class="mb-6"><span class="fw-medium">Kata sandi baru Anda harus berbeda dari kata sandi yang
                            digunakan sebelumnya</span></p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="d-flex flex-column justify-start align-content-center mb-1 p-0">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item ">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="formAuthentication" class="mb-6" action="{{ route('password.update') }}"
                        method="POST">
                        @csrf
                        <div class="mb-6 form-control-validation">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ request()->email }}" readonly />
                        </div>
                        <div class="mb-6 form-password-toggle form-control-validation">
                            <label class="form-label" for="password">New Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i
                                        class="icon-base ti tabler-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="mb-6 form-password-toggle form-control-validation">
                            <label class="form-label" for="confirm-password">Konfirmasi Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password_confirmation" class="form-control"
                                    name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i
                                        class="icon-base ti tabler-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="mb-6 form-password-toggle form-control-validation">
                            {{-- <label class="form-label" for="confirm-password">Token</label> --}}
                            <div class="input-group input-group-merge">
                                <input type="hidden" id="token" class="form-control" name="token"
                                    value="{{ $token }}" required />
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100 mb-6" type="submit">Set new password</button>
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="d-flex justify-content-center">
                                <i class="icon-base ti tabler-chevron-left scaleX-n1-rtl me-1_5"></i>
                                Back to login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Reset Password -->
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
