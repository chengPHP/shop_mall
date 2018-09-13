@extends('layouts.admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>个人博客后台</h2>
            {!! Breadcrumbs::render('good'); !!}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>新增商品</h5>
                        {{--<a style="float: right" href="{{ url('admin/diary/create') }}" class="btn btn-m btn-primary" id="add-btn"><i class="fa fa-plus"></i> 添加</a>--}}
                        <a style="position: absolute;right: 30px;top: 8px;" class="btn btn-outline btn-default" title="返回" href="{{url('admin/good')}}" ><i class="fa fa-mail-reply" ></i> 返回</a>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{url('admin/good')}}">
                            {{csrf_field()}}
                            <div class="row" >
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="name" class="col-sm-4 control-label">商品名称<span style="color:red;">*</span></label>
                                        <div class="col-sm-8">
                                            <input id="name" type="text" name="name" placeholder="商品名称" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="category_id" class="col-sm-4 control-label">商品类别<span style="color:red;">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="category_id" class="form-control m-b select2" name="category_id">
                                                {!! category_select() !!}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="sn" class="col-sm-4 control-label">商品编号<span style="color:red;">*</span></label>
                                        <div class="col-sm-8">
                                            <input id="sn" type="text" name="sn" placeholder="商品编号" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="brand_id" class="col-sm-4 control-label">商品品牌<span style="color:red;">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="brand_id" class="form-control m-b select2" name="brand_id">
                                                {!! brand_select() !!}
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="keywords" class="col-sm-4 control-label">商品关键字</label>
                                        <div class="col-sm-8">
                                            <input id="keywords" type="text" name="keywords" placeholder="商品关键字" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="brief" class="col-sm-4 control-label">简短描述</label>
                                        <div class="col-sm-8">
                                            <input id="brief" type="text" name="brief" placeholder="简短描述" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="weight" class="col-sm-4 control-label">商品重量</label>
                                        <div class="col-sm-8">
                                            <input id="weight" type="text" name="weight" placeholder="商品重量" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="give_integral" class="col-sm-4 control-label">赠送积分数量</label>
                                        <div class="col-sm-8">
                                            <input id="give_integral" type="text" name="give_integral" placeholder="赠送积分数量" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label for="storage_time" class="col-sm-4 control-label">入库时间</label>
                                        <div class="col-sm-8">
                                            <input id="plan_start_time" type="text" name="storage_time" placeholder="入库时间" value="{{date("Y-m-d H:i:s")}}" data-error-container="#error-block" class="form-control jeinput" data-date-date = "0d">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">是否实物</label>
                                        <div class="col-sm-8">
                                            <div class="radio radio-info radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_real" checked>
                                                <label for="inlineRadio1">是 </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_real">
                                                <label for="inlineRadio2">否 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">是否精品</label>
                                        <div class="col-sm-8">
                                            <div class="radio radio-info radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_best" checked>
                                                <label for="inlineRadio1">是 </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_best">
                                                <label for="inlineRadio2">否 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">是否新品</label>
                                        <div class="col-sm-8">
                                            <div class="radio radio-info radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_new" checked>
                                                <label for="inlineRadio1">是 </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_new">
                                                <label for="inlineRadio2">否 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">是否促销</label>
                                        <div class="col-sm-8">
                                            <div class="radio radio-info radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio3" value="1" name="is_hot" checked>
                                                <label for="inlineRadio1">是 </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio4" value="0" name="is_hot">
                                                <label for="inlineRadio2">否 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" >
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">状态</label>
                                        <div class="col-sm-8">
                                            <div class="radio radio-info radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio1" value="1" name="status" checked="">
                                                <label for="inlineRadio1">启用 </label>
                                            </div>
                                            <div class="radio radio-inline">
                                                <input class="icheck_input" type="radio" id="inlineRadio2" value="0" name="status">
                                                <label for="inlineRadio2">禁用 </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="Comment" class="col-sm-2 control-label">商品图片</label>
                                        <div class="col-sm-10">
                                            <div id="imgs" >
                                                <img id="thumb_img" src="{{url('img/nopicture.jpg')}}" alt="" class="img-md">
                                            </div>
                                            <input type="hidden" id="upload_id" name="file_id" value="">
                                            <div id="single-upload" class="btn-upload m-t-xs">
                                                <div id="filePicker" class="pickers"><i class="fa fa-upload"></i> 选择图片</div>
                                                <div id="single-upload-file-list"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" >
                                <div class="col-md-12" >
                                    <a href="javascript:;" onclick="addStr()" class="add btn btn-md btn-success" >增加一栏</a>
                                    <a href="javascript:;" class="reduce btn btn-md btn-danger" >减去指定栏</a>
                                    <table class="table table-striped  table-bordered" id="good_list" >
                                        <thead>
                                        <tr role="row">
                                            <td><input type="checkbox" class="icheck_input" id="checkAll"></td>
                                            <th>版本、型号<span style="color: red;" >*</span></th>
                                            <th style="min-width: 160px;" >颜色<span style="color: red;" >*</span></th>
                                            <th>库存量<span style="color: red;" >*</span></th>
                                            <th>单价(元)<span style="color: red;" >*</span></th>
                                            <th>优惠单价(元)</th>
                                            <th>状态<span style="color: red;" >*</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr >
                                            <td><input type="checkbox" name="checks" class="icheck_input"></td>
                                            <td><input class="form-control" type="text" name="model_number[]" data-error-container="#error-block" ></td>
                                            <td>
                                                <select class="form-control select2 color_select" name="color_id[]" data-error-container="#error-block">
                                                    {!! color_select() !!}
                                                </select>
                                            </td>
                                            <td><input class="form-control" type="text" name="stock[]" data-error-container="#error-block" ></td>
                                            <td><input class="form-control" type="text" name="price[]" data-error-container="#error-block" ></td>
                                            <td><input class="form-control" type="text" name="promote_price[]" data-error-container="#error-block" ></td>
                                            <td>
                                                <select class="form-control select2" name="status[]" data-error-container="#error-block" id="category_id">
                                                    <option value="-1">下架</option>
                                                    <option value="0">暂时缺货</option>
                                                    <option value="1">正常</option>
                                                    <option value="2">新品</option>
                                                </select>
                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>



                            <div class="modal-footer">
                                <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
                                <button type="button" data-dismiss="modal" class="btn btn-default">取消</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" >

        $(document).ready(function () {
            // 初始化Web Uploader
            var uploader = WebUploader.create({

                // 选完文件后，是否自动上传。
                auto: true,

                // swf文件路径
                swf: '{{ asset("admin/js/plugins/webuploader/Uploader.swf") }}',

                // 文件接收服务端。
                server: "{{ route('image.upload') }}",

                formData: {
                    '_token':'{{ csrf_token() }}'
                },

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#filePicker',

                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            // 当有文件添加进来的时候
            uploader.on( 'fileQueued', function( file ) {
                var $li = $(
                        '<div id="' + file.id + '" class="file-item thumbnail">' +
                        '<img>' +
                        '<div class="info">' + file.name + '</div>' +
                        '</div>'
                    ),
                    $img = $li.find('img');

                var $list = $("#fileList");

                // $list为容器jQuery实例
                $list.append( $li );

            });


            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on( 'uploadSuccess', function( file, response ) {
                $( '#'+file.id ).addClass('upload-state-done');
                var id = response.ids.id;
                var str_id = $("#upload_id").val()+','+id;
                $("#upload_id").val(str_id);
//                $("#thumb_img").attr('src',response.ids.url);
                var str = "<img src='"+response.ids.url+"' class='img-md'>";
                $("#imgs").append(str);
            });

            // 文件上传失败，显示上传出错。
            uploader.on( 'uploadError', function( file ) {
                var $li = $( '#'+file.id ),
                    $error = $li.find('div.error');

                // 避免重复创建
                if ( !$error.length ) {
                    $error = $('<div class="error"></div>').appendTo( $li );
                }

                $error.text('上传失败');
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on( 'uploadComplete', function( file ) {
                $( '#'+file.id ).find('.progress').remove();
            });

        });

        function addStr() {
            $(".table-bordered tbody").append(
                '<tr>' +
                '<td><input type="checkbox" name="checks"></td>' +
                '<td><input class="form-control" type="text" name="model_number[]" data-error-container="#error-block" ></td>'+
                '<td><select class="form-control select2" name="color_id[]" data-error-container="#error-block">'
                +'{!! color_select() !!}'+
                '</select> </td>'+
                '<td><input class="form-control" type="text" name="stock[]" data-error-container="#error-block" ></td>'+
                '<td><input class="form-control" type="text" name="price[]" data-error-container="#error-block" ></td>'+
                '<td><input class="form-control" type="text" name="promote_price[]" data-error-container="#error-block" ></td>'+
                '<td> <select class="form-control select2" name="status[]" data-error-container="#error-block" id="category_id">'+
                ' <option value="-1">下架</option> <option value="0">暂时缺货</option> <option value="1">正常</option>'+
                ' <option value="2">新品</option> </select> </td>'+
                '</tr>'
            );

            $('.datepicker').datepicker({
                language: "zh-CN",
                format: 'yyyy-mm-dd',
                autoclose:true
            });
            $(".select2").select2();
        }

        $("document").ready(function () {
            /*$(".add").click(function () {

                console.log($(".color_select:last").attr('id'));
                console.log('------');
                var i = parseInt($(".color_select:last").attr('id')) + 1;

                console.log(i);

                $(".table-bordered tbody").append(
                    '<tr>' +
                    '<td><input type="checkbox" name="checks"></td>' +
                    '<td><input class="form-control" type="text" name="model_number[]" data-error-container="#error-block" ></td>'+
                    '<td><select class="form-control select2" id="'+i+'" name="color_id['+i+'][]" data-error-container="#error-block" multiple="true">'
{{--                        +'{!! color_select() !!}'+--}}
                    '</select> </td>'+
                    '<td><input class="form-control" type="text" name="stock[]" data-error-container="#error-block" ></td>'+
                    '<td><input class="form-control" type="text" name="price[]" data-error-container="#error-block" ></td>'+
                    '<td><input class="form-control" type="text" name="promote_price[]" data-error-container="#error-block" ></td>'+
                    '<td> <select class="form-control select2" name="status[]" data-error-container="#error-block" id="category_id">'+
                    ' <option value="-1">下架</option> <option value="0">暂时缺货</option> <option value="1">正常</option>'+
                    ' <option value="2">新品</option> </select> </td>'+
                    '</tr>'
                );
                $('.datepicker').datepicker({
                    language: "zh-CN",
                    format: 'yyyy-mm-dd',
                    autoclose:true
                });
                $(".select2").select2();

            });*/
            $(".reduce").click(function () {
                $(".table-bordered tbody tr input:checked").parents("tr").remove();
            });
            $("#checkAll").click(function () {
                var userids=this.checked;
                //获取name=box的复选框 遍历输出复选框
                $(".table-bordered tbody input:checkbox").each(function(){
                    this.checked=userids;
                });
            });
        });
    </script>

    <script type="text/javascript" >

        $(document).ready(function() {
            blog.handleSelect2();

            $('.icheck_input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
            }).iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

            $('.datepicker').datepicker({
                language: "zh-CN",
                format: 'yyyy-mm-dd HH:ii:sss',
                autoclose:true
            });

            jeDate("#plan_start_time",{
                festival:true,
                minDate:"1900-01-01",              //最小日期
                maxDate:"2099-12-31",              //最大日期
                method:{
                    choose:function (params) {

                    }
                },
                format: "YYYY-MM-DD hh:mm:ss"
            });
        });

        function tijiao(obj) {
            $.ajax({
                type: "post",
                url: "{{url('admin/good')}}",
                data: $('.form-horizontal').serialize(),
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
                            timer: 1000,
                        },function () {
                            window.location.href = "{{url('admin/good')}}";
                        });
                    }else{
                        swal("", data.message, "error");
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