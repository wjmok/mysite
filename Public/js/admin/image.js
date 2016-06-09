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
        'buttonText' : '选择文件...',



        'onUploadSuccess': function(file, data, response) {
            // response true ,false
            if (response) {
                var obj = JSON.parse(data); //由JSON字符串转换为JSON对象

                console.log(data);
                $('#' + file.id).find('.data').html(' 上传完毕');

                var imgstr = '<li style="list-style-type:none;"><img   src=" /mysite' + obj.data + '" alt="预览图片" width="80" height="70"></li>'+'<li style="list-style-type:none;"><input type="text" name="uploadfileurl" id="saveurl" size="50" style="border:none;" /></li>';
              
                $("#previewImgs").append(imgstr);
                
                $("#previewImgs #saveurl").val(obj.data);
            } else {
                alert('上传失败')
            }
        },


        'onClearQueue' : function(queueItemCount) {
            $("#previewImgs").children().remove();
        } 


    })











    function goDel(objdom, src) {
        //先执行ajax删除图片，删除成功之后 删除预览图片
        //alert(src);
        $(objdom).parent().remove();
        //删除预览图片之后还要 修改 id="saveurl" 隐藏域的值，这个是写入到数据库的图片路径（我这里只是写一个测试就没有完善见谅了）

        return false;
    }
})
