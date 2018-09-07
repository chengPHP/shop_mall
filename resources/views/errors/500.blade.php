<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('home/images/laozhang_avatar.png')}}" >
    <title>500 Error</title>

    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

</head>

<body class="gray-bg">


<div class="middle-box text-center animated fadeInDown">
    <h1>500</h1>
    <h3 class="font-bold">Internal Server Error</h3>

    <div class="error-desc">
        服务器又睡懒觉了，大人您请稍后
        <br/><a href="{{url('admin/home')}}" class="btn btn-primary m-t">返回</a>
    </div>
</div>

<!-- Mainly scripts -->
<script src="{{asset('admin/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>

</body>

</html>