/**
 * content添加按钮操作
 */
$("#button-add").click(function() {
    var url = SCOPE.add_url;
    window.location.href = url;
});
/*content编辑按钮操作*/
$(".singcms-table #content-edit").click(function() {
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url + '&id=' + id;
    window.location.href = url;
});
/*编辑模型*/
$(".singcms-table #menu-edit").click(function() {
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url + '&id=' + id;
    window.location.href = url;
});
/**
 * 提交menu菜单编辑操作
 */
$("#singcms-button-submit-menu").click(function() {
    var menuname = $("#inputname").val();
    var id = $("#hidden_input").val();
    if (!menuname) {
        return dialog.error('菜单名不能为空');
    };
    var url = "/mysite/admin.php?m=admin&c=menu&a=checkmenuname";
    var data = {
        'menuname': menuname,
        'id': id,
    };
    console.log(data);
    jump_url = "/mysite/admin.php?m=admin&c=menu";
    // 执行异步请求  $.post
    $.post(url, data, function(result) {
        if (result.status == 0) {
            return dialog.error(result.message);
        }
        if (result.status == 1) {
            return dialog.success(result.message, jump_url);
        }
    }, 'JSON');
});

/*提交content编辑操作*/
/*$("#singcms-button-submit-content").click(function(){

});*/

$("#bac-submit").click(function() {
    var data = $("#singcms-form").serializeArray();
    postData = {};
    $(data).each(function(i) {
        postData[this.name] = this.value;

    });
    url = SCOPE.save_url;
    jump_url = SCOPE.jump_url;
    $.post(url, postData, function(result) {
        if (result.status == 1) {
            //成功
            return dialog.success(result.message, jump_url);
        } else if (result.status == 0) {
            // 失败
            return dialog.error(result.message);
        }
    }, "JSON");
});
/*
编辑模型
 */
/**
 * 删除操作JS
 */
$('.singcms-table #singcms-delete').on('click', function() {
    var id = $(this).attr('attr-id');
    var a = $(this).attr("attr-a");
    var message = $(this).attr("attr-message");
    var picurl = $(this).attr('attr-url');
    var url = SCOPE.set_status_url;
    postData = {};
    postData['src'] = '.' + picurl;
    var delurl = SCOPE.delet;
    console.log(postData);

    data = {};
    data['id'] = id;
    data['status'] = -1;
    layer.open({
        type: 0,
        title: '是否提交？',
        btn: ['yes', 'no'],
        icon: 3,
        closeBtn: 2,
        content: "是否确定" + message,
        scrollbar: true,
        yes: function() {
            // 执行相关跳转
            if (picurl) {
                $.post(delurl, postData, function(result) {
                    if (result.status = 1) {
                        return null;
                    }
                    if (result.status == 0) {
                        return null;
                    }

                }, "json");
            }
            todelete(url, data);
        },
    });
});

function todelete(url, data) {
    $.post(url, data, function(s) {
        if (s.status == 1) {
            return dialog.success(s.message, '');
            // 跳转到相关页面
        } else {
            return dialog.error(s.message);
        }
    }, "JSON");
}
/**
 * 排序操作 
 */
$('#button-listorder').click(function() {
    // 获取 listorder内容
    var data = $("#singcms-listorder").serializeArray();
    postData = {};
    $(data).each(function(i) {
        postData[this.name] = this.value;
    });
    console.log(data);
    var url = SCOPE.listorder_url;
    $.post(url, postData, function(result) {
        if (result.status == 1) {
            //成功
            return dialog.success(result.message, result['data']['jump_url']);
        } else if (result.status == 0) {
            // 失败
            return dialog.error(result.message, result['data']['jump_url']);
        }
    }, "JSON");
});
/**
 * 修改状态
 */
$('.singcms-table #singcms-on-off').on('click', function() {
    var id = $(this).attr('attr-id');
    var status = $(this).attr("attr-status");
    var url = SCOPE.set_status_url;
    data = {};
    data['id'] = id;
    data['status'] = status;
    layer.open({
        type: 0,
        title: '是否提交？',
        btn: ['yes', 'no'],
        icon: 3,
        closeBtn: 2,
        content: "是否确定更改状态",
        scrollbar: true,
        yes: function() {
            // 执行相关跳转
            todelete(url, data);
        },
    });
});
/**
 * 推送JS相关
 */
$("#singcms-push").click(function() {
    var id = $("#select-push").val();
    if (id == 0) {
        return dialog.error("请选择推荐位");
    }
    push = {};
    postData = {};
    $("input[name='pushcheck']:checked").each(function(i) {
        push[i] = $(this).val();
    });
    postData['push'] = push;
    postData['position_id'] = id;
    //console.log(postData);return;
    var url = SCOPE.push_url;
    $.post(url, postData, function(result) {
        if (result.status == 1) {
            // TODO
            return dialog.success(result.message, result['data']['jump_url']);
        }
        if (result.status == 0) {
            // TODO
            return dialog.error(result.message);
        }
    }, "json");
});
/*提交功能*/
$("#button-submit").click(function() {

    var data = $("#singcms-form").serializeArray();
    postData = {};
    $(data).each(function(i) {
        postData[this.name] = this.value;
    });
    console.log(data);
    // 将获取到的数据post给服务器
    url = SCOPE.save_url;
    jump_url = SCOPE.jump_url;
    
    var picurl = $("#imgbox").attr('attr-value');
    urlData = {};
    urlData['src'] = '.' + picurl;
    var delurl = SCOPE.delet;
    console.log(picurl);

    /*删除服务器上的旧图片*/
    var test = $("#uploadedpic").is(":visible");
    console.log(test);
    if (!test) {
          $.post(delurl, urlData, function(result) {
            if (result.status = 1) {
                return null;
            }
            if (result.status == 0) {
                return null;
            }

        }, "json"); 
    }else{
        postData['thumb'] = picurl;
    }

    /*删除数据库中的旧图片*/
    if (!postData['thumb']) {        
        postData['thumb']=null;        
    }

    $.post(url, postData, function(result) {
        if (result.status == 1) {
            //成功
            return dialog.success(result.message, jump_url);
        } else if (result.status == 0) {
            // 失败
            return dialog.error(result.message);
        }
    }, "JSON");
});
