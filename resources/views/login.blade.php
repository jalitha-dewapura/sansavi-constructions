<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
    <head>
        <title>{{ config('app.name', 'Title') }}</title>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" id="meta-viewport"/>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <!-- fonts -->
        <link rel="stylesheet" type="text/css" href="{!! asset('fonts/@fortawesome/fontawesome-free/css/all.min.css') !!}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('fonts/font-awesome/css/font-awesome.min.css') !!}"/>

        <link rel="stylesheet" type="text/css" href="{!! asset('css/app.css') !!}"/>
        <link rel="stylesheet" type="text/css" href="{!! asset('css/main.css') !!}"/>
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"/>
    </head>
    <body class="hold-transition login-page bg-light">
        <div class="login-box" >
            <div class="login-logo">
                <h2>User Login</h2>
                <!-- <img src="/img/Ransavi-Construction-Logo.png" alt="logo" class="img-responsive"> -->
            </div>
            <!-- /.login-logo -->
            <div class="card login">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="{{route('login.login')}}" method="post">
                    
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required/>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12 mb-3">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12 d-flex justify-content-center">
                                <a href="{{ route('forgot_password.index') }}">Forgot Password?</a>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
        <!-- scripts -->
        <!-- /.scripts -->
    </body>
</html>
