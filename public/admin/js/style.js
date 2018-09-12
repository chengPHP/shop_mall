/**
 * Created by CCM on 2018/8/10.
 */
var blog = function(){


    var handleiCheck = function() {
        if (!$().iCheck) {
            return;
        }

        $('.radio_input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function(event){
        }).iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%'
        });

    };

    var handleCheckAll = function(){
        if (!$().iCheck) {
            return;
        }

           $('.icheck_input_all').on('ifChecked', function(event){
               $('.icheck_input').iCheck('check')
           });

        //全不选
           $('.icheck_input_all').on('ifUnchecked', function(event){
               $('.icheck_input').iCheck('uncheck')
           });
    };


    return {


        //main function to initiate core javascript
        init:function (){
            handleiCheck();
            handleCheckAll();
        },
        //main function to initiate core javascript after ajax complete
        initAjax:function (){
            handleiCheck();
            handleCheckAll();
        },

        handleCheckAll : function(){
            $('.icheck_input_all').on('ifChecked', function(event){
                $('.icheck_input').iCheck('check')
            });
            //全不选
            $('.icheck_input_all').on('ifUnchecked', function(event){
                $('.icheck_input').iCheck('uncheck')
            });
        },

        handleiCheck : function() {
            if ($().iCheck()) {
                $('.icheck_input').on('ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed', function (event) {
                }).iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%'
                });
            }

        },

        loading: function (message) {
            $('body').loading({
                loadingWidth:240,
                title:'',
                name:'loading',
                discription:message,
                direction:'column',
                type:'origin',
                // originBg:'#71EA71',
                originDivWidth:40,
                originDivHeight:40,
                originWidth:6,
                originHeight:6,
                smallLoading:false,
                loadingMaskBg:'rgba(0,0,0,0.2)'
            });
        },

        handleSelect2 : function() {
            if ($().select2) {
                $.fn.select2.defaults.set("theme", "bootstrap");
                $('.select2').select2({
                    width: '100%'
                });
            }
        },

        initSlimScroll: function(el) {
            if (!$().slimScroll) {
                return;
            }

            $(el).each(function() {
                if ($(this).attr("data-initialized")) {
                    return; // exit
                }

                var height = '100%';

                if ($(this).attr("data-height")) {
                    height = $(this).attr("data-height");
                }

                $(this).slimScroll({
                    allowPageScroll: true, // allow page scroll when the element scroll is ended
                    size: '7px',
                    color: ($(this).attr("data-handle-color") ? $(this).attr("data-handle-color") : 'rgb(0, 0, 0)'),
                    wrapperClass: ($(this).attr("data-wrapper-class") ? $(this).attr("data-wrapper-class") : 'slimScrollDiv'),
                    railColor: ($(this).attr("data-rail-color") ? $(this).attr("data-rail-color") : '#eaeaea'),
                    position: 'right',
                    height: height,
                    alwaysVisible: ($(this).attr("data-always-visible") == "1" ? true : false),
                    railVisible: ($(this).attr("data-rail-visible") == "1" ? true : false),
                    disableFadeOut: true
                });

                $(this).attr("data-initialized", "1");
            });
        },

        errorPrompt: function(jqXHR, textStatus, errorThrown){
            if(jqXHR.status == 422) {
                var arr = "";
                for (var i in jqXHR.responseJSON) {
                    if (i == "errors") {
                        var xarr = jqXHR.responseJSON[i];
                        for (var j in xarr) {
                            var str = xarr[j];
                            for (k = 0; k < str.length; k++) {
                                arr += str[k] + ",";
                            }
                        }
                    }
                }
                swal("", arr.substring(0, arr.length - 1), "error");
            }
        },

        singleImageUpload: function(options){
            // {
            //     'uploader':options.uploader
            //     'picker':options.picker, //必须
            //     'swf':options.swf,//必须
            //     'server':options.server,//必须
            //     'formData':options.formData,
            //     'errorMsgHiddenTime':options.errorMsgHiddenTime, #自动隐藏上传出错时间
            //     'isAutoInsertInput':options.isAutoInsertInput,#是否自动追加上传成功后的input存储框
            //     'storageInputName':options.storageInputName,#上传成功后的input存储框名称
            //     'isHiddenResult':options.isHiddenResult,#是否隐藏上传成功后的提示信息
            //     'uploadSuccess':function
            //     'uploadError':function
            //     'uploadComplete':function
            // }
            options = $.extend(true, {}, options);
            //console.log(options);
            var uploader = options.uploader,
                autoCreateInput = !options.isAutoInsertInput ? options.isAutoInsertInput : true,
                isHiddenResult = !options.isHiddenResult ? options.isHiddenResult : true,
                storageInputName = options.storageInputName ? options.storageInputName : 'image';
            // 初始化Web Uploader
            uploader = WebUploader.create({

                // 选完文件后，是否自动上传。
                auto: options.auto ? options.auto : true,

                // swf文件路径
                swf: options.swf,

                // 文件接收服务端。
                server: options.server,
                formData: options.formData ? options.formData : {},

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {
                    id: '#' + options.picker + '-picker',
                    multiple:false
                },
                fileNumLimit:options.fileNumLimit ? options.fileNumLimit : 1,
                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/jpg,image/jpeg,image/png,image/bmp,image/gif'
                }
            });
            // 当有文件添加进来的时候
            uploader.on( 'fileQueued', function( file ) {
                var $li = $(
                    '<div id="' + file.id + '" class="p-xs b-r-sm m-b-sm border-top-bottom border-left-right">' +
                    '<div class="file-info overflow" title="' + file.name + '" data-file-id="'+file.id+'"> ' + file.name + '</div>' +
                    '</div>'
                );
                $("#" + options.picker + "-file-list").html( $li );
            });
            // 文件上传过程中创建进度条实时显示。
            uploader.on( 'uploadProgress', function( file, percentage) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.file-info i');
                $info = $li.find('div.file-info');

                // 避免重复创建
                if ( !$percent.length ) {
                    $percent = $('<i class="fa fa-spinner fa-spin font-blue"></i>')
                        .prependTo( $info );
                }
            });
            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on( 'uploadSuccess', function( file, response ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.file-info i');
                $info = $li.find('.file-info');
                if(response.status == 1){
                    $percent.removeClass("fa-spinner fa-spin").addClass("fa-check font-blue");
                    $info.attr('data-response-info',JSON.stringify(response));
                    if(autoCreateInput){
                        $li.append('<input type="hidden" name="'+storageInputName+'" value="'+response.data.id+'">');
                    }
                    if(isHiddenResult){
                        window.setTimeout(function () {
                            $li.hide();
                        }, options.errorMsgHiddenTime ? options.errorMsgHiddenTime : 1500);
                    }
                    if (options.uploadSuccess instanceof Function) {
                        options.uploadSuccess(file, response, uploader);
                    }
                }else{
                    $info.addClass('font-red').html('<i class="fa fa-exclamation-circle font-red"></i> ' + response.message);
                    if (options.errorMsgHiddenTime) {
                        window.setTimeout(function () {
                            $li.remove();
                        }, options.errorMsgHiddenTime);
                    }
                }

            });
            // 文件上传失败，显示上传出错。
            uploader.on( 'uploadError', function( file ) {
                var $li = $( '#'+file.id ),
                    $error = $li.find('div.file-info');
                $error.addClass('font-red').html('<i class="fa fa-exclamation-circle font-red"></i> 上传出错，请重试');
                if (options.errorMsgHiddenTime) {
                    window.setTimeout(function () {
                        $li.remove();
                    }, options.errorMsgHiddenTime);
                }
                if (options.uploadError instanceof Function) {
                    options.uploadError(file, uploader);
                }
            });
            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on( 'uploadComplete', function( file ) {
                if (options.uploadComplete instanceof Function) {
                    options.uploadComplete(file, uploader);
                }
                uploader.removeFile( file,true);
            });

        },
        fileUpload:function(options){
            // {
            //     'uploader':options.uploader, //必须
            //     'picker':options.picker, //必须
            //     'swf':options.swf,//必须
            //     'server':options.server,//必须
            //     'formData':options.formData,
            //     'fileNumLimit':options.fileNumLimit,
            //     'isAutoInsertInput':options.isAutoInsertInput,#是否自动追加上传成功后的input存储框
            //     'storageInputName':options.storageInputName,#上传成功后的input存储框名称
            //     'uploadSuccess':function
            //     'uploadError':function
            //     'uploadComplete':function
            //     'fileDelete':function
            //     'fileCannel':function
            // }
            options = $.extend(true, {}, options);
            var pickers = options.picker,
                uploaders = options.uploader,
                autoCreateInput = !options.isAutoInsertInput ? options.isAutoInsertInput : true,
                storageInputName = options.storageInputName ? options.storageInputName : 'files',
                limit = options.fileNumLimit ? options.fileNumLimit : 50;
            uploaders = WebUploader.create({
                // 选完文件后，是否自动上传。
                auto: options.auto ? options.auto : true,
                // swf文件路径
                swf: options.swf,
                // 文件接收服务端。
                server: options.server,
                formData: options.formData ? options.formData : {},
                fileNumLimit:limit,
                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {
                    id: '#'+pickers+'-picker',
                    multiple:limit > 1 ? true : false
                }
            });

            // 当有文件添加进来的时候
            uploaders.on( 'fileQueued', function( file ) {
                var $li = $('<div id="' + file.id + '" title="'+file.name+'" class="file-item pull-left m-r-sm m-b-sm b-r-sm border-top-bottom border-left-right p-xxs">' +
                    '<div class="file-item-bg bg-grey-cararra full-height">' +
                    '<div class="text-right file-cannel">' +
                    '<a href="javascript:;" title="删除" data-file-id="' + file.id + '" class="font-red">' +
                    '<i class="fa fa-ban"></i>' +
                    '</a>' +
                    '</div>' +
                    '<div class="file-progress text-center ">' +
                    '<i class="fa fa-circle-o-notch font-red fa-2x fa-fw font-yellow-crusta"></i>' +
                    '</div>' +
                    '<div class="file-state text-center">' +
                    '等待中...' +
                    '</div>' +
                    '<div class="file-info text-center" title="'+file.name+'">' +
                    file.name +
                    '</div>' +
                    '</div>' +
                    '</div> '
                );
                if(uploaders.option('fileNumLimit') == 1){
                    $('#'+pickers+'-file-list').html($li);
                }else{
                    $('#'+pickers+'-file-list').append( $li );
                }
            });
            // 文件上传过程中创建进度条实时显示。
            uploaders.on( 'uploadProgress', function( file, percentage ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.file-progress'),
                    $state = $li.find('.file-state');
                if(!$percent.find('i.fa-spinner').length){
                    $percent.html('<i class="fa fa-spinner fa-spin font-blue fa-2x fa-fw"></i>');
                }
                $state.text( parseInt(percentage * 100) + '%' );
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploaders.on( 'uploadSuccess', function( file,response ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.file-progress'),
                    $state = $li.find('.file-state'),
                    $cannel = $li.find('.file-cannel'),
                    $cannelBtn = $cannel.find('a');
                if(response.status == 1){
                    $percent.html('<i class="fa fa-check-circle-o font-blue fa-2x fa-fw"></i>');
                    $state.text(WebUploader.formatSize( file.size ));
                    $cannelBtn.html('<i class="fa fa-trash"></i>');
                    $cannel.removeClass('file-cannel').addClass('file-delete');
                    $cannelBtn.attr('data-response-info',JSON.stringify(response));
                    if(autoCreateInput){
                        if(uploaders.option('fileNumLimit') == 1){
                            $li.append('<input type="hidden" name="'+storageInputName+'" value="'+response.data.id+'">');
                        }else{
                            $li.append('<input type="hidden" name="'+storageInputName+'[]" value="'+response.data.id+'">');
                        }
                    }
                    if (options.uploadSuccess instanceof Function) {
                        options.uploadSuccess(file, response, uploaders);
                    }
                }else{
                    $percent.html('<i class="fa fa-exclamation-circle font-red fa-2x fa-fw"></i>');
                    $state.addClass('font-red').text(response.message);
                }
            });

            // 文件上传失败，显示上传出错。
            uploaders.on( 'uploadError', function( file ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.file-progress'),
                    $state = $li.find('.file-state');
                if(!$percent.find('i.fa-exclamation-circle').length){
                    $percent.html('<i class="fa fa-exclamation-circle font-red fa-2x fa-fw"></i>');
                }
                $state.addClass('font-red').text('上传失败，稍后重试');
                if (options.uploadError instanceof Function) {
                    options.uploadError(file, uploaders);
                }
            });
            uploaders.on( 'uploadComplete', function( file ) {
                if (options.uploadComplete instanceof Function) {
                    options.uploadComplete(file, uploaders);
                }
                uploaders.removeFile( file,true);
            });
            //未上传取消文件
            $('#'+pickers+'-file-list').on('click', ".file-cannel a", function(){
                var $fileid = $(this).data('file-id');
                if(uploaders.getFile($fileid) != undefined){
                    uploaders.removeFile( $fileid,true);
                }
                $('#'+pickers+'-file-list').find('#'+$fileid).remove();
                if (options.fileCannel instanceof Function) {
                    options.fileCannel($fileid, uploaders);
                }
            });
            $('#'+pickers+'-file-list').on('click', ".file-delete a", function(){
                var $fileid = $(this).data('file-id');
                if(uploaders.getFile($fileid) != undefined){
                    uploaders.removeFile( $fileid,true);
                }
                $('#'+pickers+'-file-list').find('#'+$fileid).remove();
                if (options.fileDelete instanceof Function) {
                    options.fileDelete($fileid, uploaders);
                }
            });
        },
        imageUpload:function(options){
            // {
            //     'uploader':options.uploader, //必须
            //     'picker':options.picker, //必须
            //     'swf':options.swf,//必须
            //     'server':options.server,//必须
            //     'formData':options.formData,
            //     'fileNumLimit':options.fileNumLimit
            //     'isAutoInsertInput':options.isAutoInsertInput,#是否自动追加上传成功后的input存储框
            //     'storageInputName':options.storageInputName,#上传成功后的input存储框名称
            //     'uploadSuccess':function
            //     'uploadError':function
            //     'uploadComplete':function
            //     'fileDelete':function
            //     'fileCannel':function
            // }
            options = $.extend(true, {}, options);
            var pickers = options.picker,
                uploaders = options.uploader,
                autoCreateInput = !options.isAutoInsertInput ? options.isAutoInsertInput : true,
                storageInputName = options.storageInputName ? options.storageInputName : 'images',
                limit = options.fileNumLimit ? options.fileNumLimit : 50;
            uploaders = WebUploader.create({
                // 选完文件后，是否自动上传。
                auto: options.auto == false ? options.auto : true,
                // swf文件路径
                swf: options.swf,
                // 文件接收服务端。
                server: options.server,
                formData: options.formData ? options.formData : {},
                fileNumLimit:limit,
                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {
                    id: '#'+pickers+'-picker',
                    multiple:limit > 1 ? true : false
                },
                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/jpg,image/jpeg,image/png,image/bmp,image/gif'
                }
            });

            // 当有文件添加进来的时候
            uploaders.on( 'fileQueued', function( file ) {
                var $li = $('<div id="' + file.id + '" title="'+file.name+'" class="file-item pull-left m-r-sm m-b-sm b-r-sm border-top-bottom border-left-right p-xxs">' +
                    '<div class="file-preview">'+
                    '<span class="preview"><img class="hide" src=""></span>'+
                    '</div>'+
                    '<div class="file-item-bg full-height">' +
                    '<div class="text-right file-cannel">' +
                    '<a href="javascript:;" title="删除" data-file-id="' + file.id + '" class="font-red">' +
                    '<i class="fa fa-ban"></i>' +
                    '</a>' +
                    '</div>' +
                    '<div class="file-progress text-center ">' +
                    '<i class="fa fa-circle-o-notch font-red fa-2x fa-fw font-yellow-crusta"></i>' +
                    '</div>' +
                    '<div class="file-state text-center">' +
                    '等待中...' +
                    '</div>' +
                    '<div class="file-info text-center" title="'+file.name+'">' +
                    file.name +
                    '</div>' +
                    '</div>' +
                    '</div> '
                );
                if(uploaders.option('fileNumLimit') == 1){
                    $('#'+pickers+'-file-list').html($li);
                }else{
                    $('#'+pickers+'-file-list').append( $li );
                }
                // 如果为非图片文件，可以不用调用此方法。
                // thumbnailWidth x thumbnailHeight 为 100 x 100
                uploaders.makeThumb( file, function( error, src ) {
                    var $item = $( '#'+file.id ),
                        $img = $li.find('img');
                    if ( error ) {
                        $img.replaceWith('<span>不能预览</span>');
                        return;
                    }
                    $img.attr( 'src', src );
                }, 1, 1 );
            });
            // 文件上传过程中创建进度条实时显示。
            uploaders.on( 'uploadProgress', function( file, percentage ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.file-progress'),
                    $state = $li.find('.file-state');
                if(!$percent.find('i.fa-spinner').length){
                    $percent.html('<i class="fa fa-spinner fa-spin font-blue fa-2x fa-fw"></i>');
                }
                $state.text( parseInt(percentage * 100) + '%' );
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploaders.on( 'uploadSuccess', function( file,response ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.file-progress'),
                    $state = $li.find('.file-state'),
                    $info = $li.find('.file-info'),
                    $cannel = $li.find('.file-cannel'),
                    $cannelBtn = $cannel.find('a'),
                    $img = $li.find('img');
                if(response.status == 1){
                    $info.hide();
                    $percent.html('<i class="fa fa-check-circle-o font-blue fa-2x fa-fw"></i>').hide();
                    $state.text(WebUploader.formatSize( file.size )).hide();
                    $cannelBtn.html('<i class="fa fa-trash"></i>');
                    $cannel.removeClass('file-cannel').addClass('file-delete');
                    $cannelBtn.attr('data-response-info',JSON.stringify(response));
                    $img.removeClass('hide');
                    if(autoCreateInput){
                        if(uploaders.option('fileNumLimit') == 1){
                            $li.append('<input type="hidden" name="'+storageInputName+'" value="'+response.data.id+'">');
                        }else{
                            $li.append('<input type="hidden" name="'+storageInputName+'[]" value="'+response.data.id+'">');
                        }
                    }
                    if (options.uploadSuccess instanceof Function) {
                        options.uploadSuccess(file, response, uploaders);
                    }
                }else{
                    $percent.html('<i class="fa fa-exclamation-circle font-red fa-2x fa-fw"></i>');
                    $state.addClass('font-red').text(response.message);
                }
            });

            // 文件上传失败，显示上传出错。
            uploaders.on( 'uploadError', function( file, reason ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.file-progress'),
                    $state = $li.find('.file-state');
                if(!$percent.find('i.fa-exclamation-circle').length){
                    $percent.html('<i class="fa fa-exclamation-circle font-red fa-2x fa-fw"></i>');
                }
                $state.addClass('font-red').text('上传失败，稍后重试');
                if (options.uploadError instanceof Function) {
                    options.uploadError(file, uploaders);
                }
            });
            uploaders.on( 'uploadComplete', function( file ) {
                if (options.uploadComplete instanceof Function) {
                    options.uploadComplete(file, uploaders);
                }
                uploaders.removeFile( file,true);
            });
            //未上传取消文件
            $('#'+pickers+'-file-list').on('click', ".file-cannel a", function(){
                var $fileid = $(this).data('file-id');
                if(uploaders.getFile($fileid) != undefined){
                    uploaders.removeFile( $fileid,true);
                }
                $('#'+pickers+'-file-list').find('#'+$fileid).remove();
                if (options.fileCannel instanceof Function) {
                    options.fileCannel($fileid, uploaders);
                }
            });
            $('#'+pickers+'-file-list').on('click', ".file-delete a", function(){
                var $fileid = $(this).data('file-id');
                if(uploaders.getFile($fileid) != undefined){
                    uploaders.removeFile( $fileid,true);
                }
                $('#'+pickers+'-file-list').find('#'+$fileid).remove();
                if (options.fileDelete instanceof Function) {
                    options.fileDelete($fileid, uploaders);
                }
            });
        }
    }
}();

jQuery(document).ready(function() {
    // blog.init();
});