<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">修改后台用户信息</h4>
</div>
<form method="post" class="form-horizontal" action="{{url('admin/member')}}/{{$info->id}}">
    <div class="modal-body">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="_method" value="PUT">
        <div class="row" >
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="nickname" class="col-sm-4 control-label">会员昵称<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="nickname" type="text" name="nickname" value="{{$info->nickname}}" placeholder="会员昵称" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="name" class="col-sm-4 control-label">会员名称<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="name" type="text" name="name" placeholder="会员名称" value="{{$info->name}}" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="phone" class="col-sm-4 control-label">手机号<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="phone" type="text" name="phone" value="{{$info->phone}}" placeholder="手机号" class="form-control">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="password" class="col-sm-4 control-label">密码<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="password" type="password" class="form-control" name="password" placeholder="密码为空，则不修改密码" required>
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="password-confirm" class="col-sm-4 control-label">确认密码<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="确认密码" required>
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="birthday" class="col-sm-4 control-label">出生日期</label>
                    <div class="col-sm-8">
                        <input id="birthday" type="text" name="birthday" placeholder="出生日期" value="{{$info->birthday}}" data-error-container="#error-block" class="form-control datepicker" data-date-date = "0d">
                    </div>
                </div>
            </div>

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="password_question" class="col-sm-4 control-label">密码提问</label>
                    <div class="col-sm-8">
                        <input id="password_question" type="text" name="password_question" value="{{$info->password_question}}" placeholder="密码提问" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="password_answer" class="col-sm-4 control-label">密码回答</label>
                    <div class="col-sm-8">
                        <input id="password_answer" type="text" name="password_answer" value="{{$info->password_answer}}" placeholder="密码答案" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label class="col-sm-4 control-label">性别</label>
                    <div class="col-sm-8">
                        <select id="sex" class="form-control m-b select2" name="sex">
                            <option value="0" {{$info->sex==0?'selected':''}} >保密</option>
                            <option value="1" {{$info->sex==1?'selected':''}} >男</option>
                            <option value="2" {{$info->sex==2?'selected':''}} >女</option>
                        </select>
                    </div>
                </div>
            </div>



            {{--<div class="col-md-4" >
                <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">邮箱<span style="color:red;">*</span></label>
                    <div class="col-sm-8">
                        <input id="email" type="email" name="email" value="{{$info->email}}" placeholder="邮箱地址" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="qq" class="col-sm-4 control-label">qq账号</label>
                    <div class="col-sm-8">
                        <input id="qq" type="text" name="qq" value="{{$info->qq}}" placeholder="qq账号" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="office_phone" class="col-sm-4 control-label">办公电话</label>
                    <div class="col-sm-8">
                        <input id="office_phone" type="text" name="office_phone" value="{{$info->office_phone}}" placeholder="办公电话" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-4" >
                <div class="form-group">
                    <label for="home_phone" class="col-sm-4 control-label">家庭电话</label>
                    <div class="col-sm-8">
                        <input id="home_phone" type="text" name="home_phone" value="{{$info->home_phone}}" placeholder="家庭电话" class="form-control">
                    </div>
                </div>
            </div>--}}

            <div class="col-md-4" >
                <div class="form-group">
                    <label for="Comment" class="col-sm-4 control-label">照片</label>
                    <div class="col-sm-8">
                        @if($info->get_member_head)
                            <img id="thumb_img" src="{{asset($info->get_member_head['path'])}}" alt="" class="img-md">
                        @else
                            <img id="thumb_img" src="{{asset('img/nopicture.jpg')}}" alt="" class="img-md">
                        @endif
                        <input type="hidden" id="upload_id" name="file_id" value="{{$info->member_head}}">
                        <div id="single-upload" class="btn-upload m-t-xs">
                            <div id="filePicker" class="pickers"><i class="fa fa-upload"></i> 选择图片</div>
                            <div id="single-upload-file-list"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" >
                <div class="form-group">
                    <label class="col-sm-2 control-label">状态</label>
                    <div class="col-sm-10">
                        <div class="radio radio-info radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio1" value="1" name="status" {{$info->status==1?'checked':''}}>
                            <label for="inlineRadio1">启用</label>
                        </div>
                        <div class="radio radio-inline">
                            <input class="icheck_input" type="radio" id="inlineRadio2" value="0" name="status" {{$info->status==0?'checked':''}}>
                            <label for="inlineRadio2">禁用</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" onclick="tijiao(this)" class="btn btn-primary">提交</button>
    </div>
</form>

<script type="text/javascript" >
    //页面加载完成后初始化select2控件
    $(document).ready(function() {
        blog.handleSelect2();

        $('.datepicker').datepicker({
            language: "zh-CN",
            format: 'yyyy-mm-dd',
            autoclose:true
        });

        $('.icheck_input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
        }).iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });


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
            $("#upload_id").val(id);
            $("#thumb_img").attr('src',response.ids.url);
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
            url: "{{url('admin/member')}}/{{$info->id}}",
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
                        window.location.reload();
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

