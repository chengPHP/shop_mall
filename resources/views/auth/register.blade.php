<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>注册 个人博客</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('home/images/laozhang_avatar.png')}}">
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name" style="font-size: 130px;padding-bottom: 80px;">Blog</h1>

        </div>
        {{--<h3>Register to Blog</h3>--}}
        {{--<p>Create account to see it in action.</p>--}}
        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input id="name" type="text" class="form-control" name="name" placeholder="用户名" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input id="email" type="email" class="form-control" name="email" placeholder="邮箱" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input id="phone" type="text" class="form-control" name="phone" placeholder="手机号" value="{{ old('phone') }}" required>

                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('yzm') || $errors->has('result') ? ' has-error' : '' }}">
                <div class="col-md-6">
                    <input id="yzm" type="text" class="form-control" name="yzm" placeholder="验证码">
                    {{--错误信息提示--}}
                    @if ($errors->has('yzm'))
                        <span class="help-block">
                            <strong>{{ $errors->first('yzm') }}</strong>
                        </span>
                    @endif
                    @if ($errors->has('result'))
                        <span class="help-block">
                            <strong>{{ $errors->first('result') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="col-md-6">
                    <input id="getMeg" onclick="settime()" type="button" class="btn btn-w-m btn-default" value="获取短信验证码"/>
                </div>
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <input id="password" type="password" class="form-control" placeholder="密码" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <input id="password-confirm" type="password" placeholder="重复密码" class="form-control" name="password_confirmation" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary block full-width m-b">注册</button>
            <a class="btn btn-sm btn-white btn-block" href="{{route('login')}}">登录</a>
        </form>

        <p class="m-t"> <small>个人博客,后台(inspinia_admin-v2.7) &copy; 2014</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('admin/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('admin/js/plugins/iCheck/icheck.min.js')}}"></script>
<script>

    // 验证码倒计时
    var countdown=60;
    var status = 1;
    var btn = $("#getMeg");
    function settime(){
        console.log(countdown);
        var phone = $("#phone").val();
        if(phone.length == 0){
            alert("请输入手机号");
        }else{
            //已填写手机号
            if(countdown == 60){
                $.ajax({
                    type: "post",
                    url: "{{route('sendMsg')}}",
                    data: {
                        'phone' : phone,
                        '_token' : '{{csrf_token()}}'
                    },
                    dataType:"json",
                    success: function (data) {
                        if(data.code=="000000"){
                            btn.val(countdown+"S");
                            btn.attr("disabled",true);
                        }else{
                            alert("短信发送异常，请检查输入手机号是否正确");
                            return false;
                        }
                    },
                    complete: function () {
                        btn.val(countdown+"S");
                        btn.attr("disabled",true);
                        countdown--;
                    }
                });
            }else if(countdown>0){
                btn.val(countdown+"S");
                btn.attr("disabled",true);
                countdown--;
            }else{
                btn.attr("disabled",false);
                btn.val("获取短信验证码");
                //删除session
                {{session()->forget('yzm')}}
            }

            setTimeout(function() {
                settime() ;
            },1000)
        }

    }


    $(document).ready(function(){
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>
</body>

</html>

