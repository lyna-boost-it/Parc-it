<!DOCTYPE html>
<html>
	@include('layouts.headForLogIn')
    <body class="login-page">
        <body class="login-page">
            <div class="login-header box-shadow">
                <div
                    class="container-fluid d-flex justify-content-between align-items-center"
                >
                    <div class="brand-logo">
                        <a href="{{ URL('/') }}">
                             <img src="{{URL('assets/vendors/images/parcit.jpeg')}}"; alt="" />
                        </a>
                    </div>
                    <div class="login-menu">

                    </div>
                </div>
            </div>
            <div
                class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
            >
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-6 col-lg-7">
                            <img src="{{URL('assets/vendors/images/parc_logo_white.jpeg')}}"; alt="" />
                        </div>
                        <div class="col-md-6 col-lg-5">
                            <div class="login-box bg-white box-shadow border-radius-10">
                                <div class="login-title">
                                    <h2 class="text-center text-orange">Connexion</h2>
                                </div>
                                <form class="form" method="POST" action="{{ route('login.custom') }}">
                                    @csrf
                                    <div class="input-group custom">
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"
                                                ><i class="icon-copy dw dw-user1"></i
                                            ></span>
                                        </div>
                                    </div>
                                    <div class="input-group custom">
                                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        <div class="input-group-append custom">
                                            <span class="input-group-text"
                                                ><i class="dw dw-padlock1"></i
                                            ></span>
                                        </div>
                                    </div>



                                    <div class="row pb-30">
                                        <div class="col-6">
                                            <div class="custom-control custom-checkbox">
                                                <input
                                                    type="checkbox"
                                                    class="custom-control-input"
                                                    id="customCheck1"
                                                    value="" {{ old('remember') ? 'checked' : '' }}
                                                    name="remember"
                                                />
                                                <label class="custom-control-label" for="customCheck1"
                                                    >Souviens-toi de moi</label
                                                >



                                            </div>
                                        </div>

                                    </div>



                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group mb-0">



                                                <button  type="submit"class="btn btn-primary btn-lg btn-block" >{{ __('s\'identifier') }}</button>


                                            </div>


                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.footerForLogIn')
        </body>


</html>
