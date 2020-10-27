<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('ucenter.title')}} | {{ trans('ucenter.login') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/vendor/ucenter/AdminLTE/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="/vendor/ucenter/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/vendor/ucenter/AdminLTE/dist/css/adminlte.min.css">
</head>
<style>
    body {
        background: url("https://open.saintic.com/api/bingPic/") no-repeat center center fixed;
        background-size: cover;
    }
</style>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b style="color: white;text-align: center;font-family: Verdana;font-size: 30px;font-weight: bold;-webkit-text-stroke: 1px #6f6f6f;">{{config('ucenter.name')}}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">

            <form action="{{ ucenter_url('auth/login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-group mb-3">
                    @if($errors->has('username'))
                        @foreach($errors->get('username') as $message)
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
                        @endforeach
                    @endif
                    <input type="text" class="form-control" name="username" placeholder="账号" value="{{ old('username') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    @if($errors->has('password'))
                        @foreach($errors->get('password') as $message)
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>{{$message}}</label><br>
                        @endforeach
                    @endif
                    <input type="password" name="password" class="form-control" placeholder="密码">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                记住
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">登录</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <p class="mb-1">
                <a href="forgot-password.html">找回密码</a>
            </p>
            <p class="mb-0">
                <a href="register" class="text-center">注册新用户</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="/vendor/ucenter/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/vendor/ucenter/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/vendor/ucenter/AdminLTE/dist/js/adminlte.min.js"></script>
</body>
</html>
