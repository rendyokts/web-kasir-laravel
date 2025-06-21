@extends('layouts.app')
@section('styles')
    <style>
        .img-login-info{
            max-width: 1024px !important;
            margin: 0 auto;
        }
        .modal-dialog{
            max-width: 1100px !important;
        }
        .modal-body{
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ url('logo.png')}}" class="" alt="User Image" style="height: 80px !important;">
        </div>
        <div class="login-logo">
            <a href="/"><b>{{env('APP_TITLE')}}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="POST" action="{{ route('login') }}" class="form-signin" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input id="inputEmail" type="text"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @elseif($errors->has('error'))
                            <span class="invalid-feedback" role="alert" style="color: red;">
                                <strong>{{$errors->first('error')}}</strong>
                            </span>
                        @endif

                    </div>
                    <div class="input-group mb-3">
                        <input id="inputPassword" type="password"
                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="off" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    @if(!env('CAPTCHA_DISABLE',false))
                    <div class="input-group mb-3 captcha" >
                        <span>
                            <img src="{{ captcha_src() }}" alt="captcha">
                        </span>
                        <button type="button" class="btn btn-danger" class="reload" id="reload">
                            &#x21bb;
                        </button>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror" placeholder="Please Insert Captcha">
                        @error('captcha')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember"
                                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-block" value="2">Sign In
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="social-auth-links text-center mb-3">
                        <p>- OR -</p>
                        <button type="submit" value="3" name="submit" class="btn btn-block btn-primary">
                            <i class="fa fa-ship mr-2"></i> Sign up using Inaportnet
                        </button>
                    </div>
                </form>


                <!-- /.social-auth-links -->

                <p class="mb-1">
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot the password?') }}
                        </a>
                    @endif
                </p>
                <p class="mb-0">
                    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>


@if(env("LOGIN_POPUP",false))
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-body row">
                        <div class="col-md-12 col-lg-12 form-group">
                            <img src="{{asset('login_info.jpg')}}" class="img-login-info">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@section('script')
    <script>
        $('#reload').click(function () {
            // console.log('hi');
            $.ajax({
                type: 'GET',
                url: 'reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
        $(function(){
            @if(env("LOGIN_POPUP",false))
            $('#infoModal').modal('show');
            @endif
        });

    </script>
@endsection
