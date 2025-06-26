<x-head-auth>Register</x-head-auth>

<body>
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="{{ route('login') }}" class="app-brand auth-cover-brand d-none d-xl-flex">
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
                    <img src="{{ asset('portos/assets/img/illustrations/auth-register-illustration-light.png') }}"
                        alt="auth-register-cover" class="my-5 auth-illustration"/>
                    <img src="{{ asset('portos/assets/img/illustrations/bg-shape-image-light.png') }}"
                        alt="auth-register-cover" class="platform-bg"/>
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Register -->
            <div class="d-flex col-12 col-xl-4 align-items-center authentication-bg p-sm-12 ">
                <div class="w-px-400 mx-auto mt-6">
                    <h4 class="mb-1">Bikin akun dulu yukk🚀</h4>
                    <p class="mb-6">Pastikan ga ada yang kelewat ya😉</p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="d-flex flex-column justify-start align-content-center mb-1 p-0">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item ">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="formAuthentication" class="mb-6" action="{{ route('registerProses') }}" method="POST">
                        @csrf
                        <div class="mb-4 form-control-validation">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}" placeholder="Enter your name" autofocus />
                        </div>
                        <div class="mb-4 form-control-validation">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ old('username') }}" placeholder="Enter your username" autofocus />
                        </div>
                        <div class="mb-4 form-control-validation">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{ old('email') }}" placeholder="Enter your email" />
                        </div>

                        <div class="mb-4 form-control-validation">
                            <label for="telp" class="form-label">No.Telp</label>
                            <input type="text" inputmode="numeric" class="form-control" id="telp" name="telp"
                                value="{{ old('telp') }}" placeholder="Enter your phone number" autofocus />
                        </div>

                        <div class="mb-4 form-password-toggle form-control-validation">
                            <label class="form-label" for="password">Password (min 8 karakter)</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    value="{{ old('password') }}"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i
                                        class="icon-base ti tabler-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="mb-4 form-password-toggle form-control-validation">
                            <label class="form-label" for="password-confirm">Konfirmasi Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password_confirmation" class="form-control"
                                    name="password_confirmation" value="{{ old('password_confirmation') }}"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i
                                        class="icon-base ti tabler-eye-off"></i></span>
                            </div>
                        </div>
                        {{-- <div class="my-8 form-control-validation">
                                <div class="form-check mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        I agree to
                                        <a href="javascript:void(0);">privacy policy & terms</a>
                                    </label>
                                </div>
                            </div> --}}
                        <button class="btn btn-primary d-grid w-100" type="submit">Buat</button>
                    </form>

                    <p class="text-center">
                        <span>Sudah punya akun?</span>
                        <a href="{{ route('login') }}">
                            <span>Ya tinggal login dong</span>
                        </a>
                    </p>

                </div>
            </div>
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
