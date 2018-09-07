<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>登录页</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('home/images/laozhang_avatar.png')}}">
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>
            <h1 class="logo-name" style="font-size: 130px;padding-bottom: 80px;" >Blog</h1>
        </div>

        <form class="form-horizontal m-t" role="form" method="POST" action="{{ route('login') }}">

            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input type="text" class="form-control" name="name" placeholder="用户名" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input type="password" class="form-control" name="password" placeholder="密码" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ count($errors) > 0 ? ' has-error' : '' }}">
                <div class="col-md-6">
                    <input class="form-control" name="captcha" placeholder="验证码">

                    {{--错误信息提示--}}
                    @if (count($errors) > 0)

                        <span class="help-block">
                            @foreach ($errors->all() as $error)
                                <strong>{{ $error }}</strong>
                            @endforeach
                        </span>
                    @endif

                </div>
                <div class="col-md-6">
                    <img style="float: left" id="captcha" src="{{captcha_src()}}" onclick="this.src='/captcha/default?'+Math.random()" alt="验证码">
                </div>
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">登录</button>
            <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">注册一个新用户</a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('admin/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<script>

    function updateImg() {
        $("#captcha").attr("src",'/captcha/default?'+Math.random());
    }

</script>
</body>

</html>