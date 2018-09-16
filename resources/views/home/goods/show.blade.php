@extends('layouts.home')


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>商城前台</h2>
            {!! Breadcrumbs::render('brand'); !!}
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="contact-box">
                    <div class="col-sm-6">
                        <div class="text-center">
                            <img alt="image" class="img-circle m-t-xs img-responsive" src="{{asset($info->files[0]['path'])}}">
                            {{--<div class="m-t-xs font-bold">Graphics designer</div>--}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <form class="form-horizontal" action="{{url('add_good_to_car')}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="hidden" name="good_id" value="{{$info['id']}}">
                            <h1><strong>{{$info['name']}}</strong></h1>
                            <p><i class="fa fa-map-marker"></i> {{$info['keywords']}}</p>
                            <address>
                                商品简短描述：{{$info['brief']}}
                            </address>

                            @foreach($info->attr as $k=>$v)
                                <div>
                                    <input class="icheck_input" type="radio" name="attr_id" value="{{$v['id']}}">
                                    {{$v['model_number']}} {{$v->color['name']}}
                                    原价：{{$v['price']}} 活动价：{{$v['promote_price']}}
                                </div>
                            @endforeach

                            <span class="btn btn-primary" onclick="add_good_to_car(this)" >加入购物车</span>
                            <span class="btn btn-success" >立即购买</span>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" >

        $(document).ready(function () {
            $('.icheck_input,.icheck_input_all').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
            }).iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            //全选
            $('.icheck_input_all').on('ifChecked', function(event){
                $('.icheck_input').iCheck('check')
            });

            //全不选
            $('.icheck_input_all').on('ifUnchecked', function(event){
                $('.icheck_input').iCheck('uncheck')
            });
        });

        function add_good_to_car(obj) {
            $.ajax({
                type: "post",
                url: "{{url('add_good_to_car')}}",
                data: $('.form-horizontal').serialize(),
                {{--data: {--}}
                    {{--'_token' : "{{csrf_token()}}",--}}
                    {{--'good_id' : "{{$info['id']}}",--}}
                    {{--'attr_id' : "{{$info->attr['id']}}"--}}
                {{--},--}}
                dataType:"json",
                beforeSend:function () {
                    // 禁用按钮防止重复提交
                    $(obj).attr({ disabled: "disabled" });
                    blog.loading('正在提交，请稍等...');
                },
                success: function (data) {
                    if(data.code==1){
                        swal({
                            title: "",
                            text: data.message,
                            type: "success",
                            timer: 2000,
                        },function () {
//                            window.location.reload();
                        });
                    }else{
                        swal("", data.message, "warning");
                    }
                },
                complete:function () {
                    $(obj).removeAttr("disabled");
                    removeLoading('loading');
                },
                error:function (jqXHR, textStatus, errorThrown) {
                    blog.errorPrompt(jqXHR, textStatus, errorThrown);
                }
            });
        }

    </script>

@endsection