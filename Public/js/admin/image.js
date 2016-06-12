/**
 * 图片上传功能
 */
$(function() {
    $('#file_upload').uploadify({

        'auto': false,
        'swf': SCOPE.ajax_upload_swf,
        'uploader': SCOPE.ajax_upload_image_url,
        'buttonText': '上传图片',
        'fileTypeDesc': 'Image Files',
        'fileObjName': 'file',
        //允许上传的文件后缀
        'fileTypeExts': '*.gif; *.jpg; *.png',
        'removeCompleted': false,
        'multi': false,
        'buttonText': '选择文件...',

        'onUploadSuccess': function(file, data, response) {
            // response true ,false
            if (response) {
                var obj = JSON.parse(data); //由JSON字符串转换为JSON对象
                window.purl = '/mysite' + obj.data;

                $('#' + file.id).find('.data').html(' 上传完毕');

                var imgstr = '<li style="list-style-type:none;"><img   src=" /mysite' + obj.data + '" alt="预览图片" width="80" height="70"></li>' + '<li style="list-style-type:none;"><input type="text" name="uploadfileurl" id="saveurl" size="50" style="border:none;" /></li>';

                $("#previewImgs").append(imgstr);

                $("#previewImgs #saveurl").val(obj.data);
            } else {
                alert('上传失败')
            }
        },


        'onClearQueue': function(queueItemCount) {

            $("#previewImgs").children().remove();
        }

    })











    $("#deletpic").click(function() {
        postData = {};
        postData['src'] = purl;
        var url = SCOPE.delet;
        console.log(postData);

        $.post(url, postData, function(result) {
            console.log(result);
            if (result.status = 1) {
                // TODO

                return dialog.onlysuccess(result.message);
            }
            if (result.status == 0) {
                // TODO
                return dialog.error(result.message);
            }
            
        }, "json");
    })
})
