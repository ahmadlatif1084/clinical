@extends('layouts.app')

@section('extra_css')
    <link href="{{ asset('public/images/icons/favicon.ico') }}" rel="icon" type="image/png">
    <link href="{{ asset('public/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/vendor/animate/animate.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/vendor/select2/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/util.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/main.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt="" style="will-change: transform; transform: perspective(300px) rotateX(0deg) rotateY(0deg);">
                    <img src="public/images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form"  method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
					<span class="login100-form-title">
						Member Registration
					</span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz" >
                        <input class="input100" type="text" name="name" value="{{ old('name') }}" placeholder="Name">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
                    </div>
                    <div class=" {{ $errors->has('name') ? ' has-error' : '' }} ">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz" >
                        <input class="input100" type="text" name="email" value="{{ old('email') }}" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                    </div>
                    <div class=" {{ $errors->has('email') ? ' has-error' : '' }} ">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                    </div>
                    <div class="{{ $errors->has('password') ? ' has-error' : '' }}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password_confirmation" placeholder="Retype Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Register
                        </button>
                    </div>
                    <div class="text-center p-t-136">
                        <a class="txt2" href="{{ route('login') }}">
                          Log In
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('extra_js')
@endsection
@section('script')
    <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script>
    <script src="{{asset('public/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('public/vendor/select2/select2.min.js')}}"></script>
    <script src="{{asset('public/vendor/tilt/tilt.jquery.min.js')}}"></script>
    <script src="{{asset('public/js/main.js')}}"></script>
    <script type="text/javascript">
        $('.js-tilt').tilt({
            scale: 1.1
        });
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-23581568-13');
    </script>
@endsection