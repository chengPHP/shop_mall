@extends('layouts.admin')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>个人博客后台</h2>
            {!! Breadcrumbs::render('articleCreate'); !!}
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        {{--<h5>文章管理列表</h5>--}}
                        <a href="{{ url('admin/article/create') }}" data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-m btn-primary" id="add-btn"><i class="fa fa-plus"></i> 添加</a>
                        {{--<a href="{{ url('admin/article/create') }}"  class="btn blue " id="add-btn"><i class="fa fa-plus"></i> 添加</a>--}}
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" action="{{url('admin/article')}}" enctype="multipart/form-data">
                            <div class="modal-body">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="title" class="col-sm-2 control-label">标题名称</label>
                                    <div class="col-sm-10">
                                        <input id="title" type="text" name="title" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="category_id" class="col-sm-2 control-label">文章类别</label>
                                    <div class="col-sm-10">
                                        <select id="category_id" class="form-control m-b select2" name="category_id">
                                            <option value="0">请选择</option>
                                            @foreach($category as $v)
                                                <option value="{{$v['id']}}">{{$v['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="descr" class="col-sm-2 control-label">文章简介</label>
                                    <div class="col-sm-10">
                                        <input id="descr" type="text" name="descr" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="editor" class="col-sm-2 control-label">文章内容</label>
                                    <div class="col-sm-10">
                                        <script id="editor" type="text/plain" style="width:100%;height:200px;"></script>
                                        <script type="text/javascript">
                                        //实例化编辑器
                                        //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                                        var ue = UE.getEditor('editor');
                                        </script>
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="tags" class="col-sm-2 control-label">关键词</label>
                                    <div class="col-sm-10">
                                        <input id="tags" type="text" name="tags" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">状态</label>
                                    <div class="col-sm-10">
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

                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label for="Comment" class="col-sm-2 control-label">列表展示图</label>
                                    <div class="col-sm-10">

                                        <div id="uploader-demo">
                                            <!--用来存放item-->
                                            <div id="fileList" class="uploader-list"></div>
                                            <div id="filePicker">选择图片</div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="fanhui()" class="btn btn-default" >取消</button>
                                <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        //页面加载完成后初始化select2控件
        $(document).ready(function() {
            blog.handleSelect2();

            $('.icheck_input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
            }).iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });

        });

    </script>

<script type="text/javascript" >


    $(document).ready(function () {

        //页面加载完成后初始化select2控件
        blog.handleSelect2();

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

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
//            uploader.makeThumb( file, function( error, src ) {
//                if ( error ) {
//                    $img.replaceWith('<span>不能预览</span>');
//                    return;
//                }
//
//                $img.attr( 'src', src );
//            }, thumbnailWidth, thumbnailHeight );
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $li = $( '#'+file.id ),
                $percent = $li.find('.progress span');

            // 避免重复创建
            if ( !$percent.length ) {
                $percent = $('<p class="progress"><span></span></p>')
                    .appendTo( $li )
                    .find('span');
            }

            $percent.css( 'width', percentage * 100 + '%' );
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on( 'uploadSuccess', function( file, response ) {
            $( '#'+file.id ).addClass('upload-state-done');
            var id = response.ids.id;
            $('#uploader-demo').append('<input type="hidden" name="file[]" value="'+response.ids.id+'">');
//            $('.webuploader-element-invisible')
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


    function tijiao(obj) {
        $.ajax({
            type: "post",
            url: "{{url('admin/article')}}",
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
                        window.location.href="{{url('admin/article')}}";
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

    function fanhui() {
        window.location.href="{{url('admin/article')}}";
    }

</script>
@endsection
