<?php /*a:1:{s:44:"E:\tp\tp\app\admin\view\admin\user-edit.html";i:1552465897;}*/ ?>
<!DOCTYPE html>
<html class="x-admin-sm">
  
  <head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="/static/css/font.css">
    <link rel="stylesheet" href="/static/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/static/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/static/js/xadmin.js?ab=2"></script>
    <script type="text/javascript" src="/static/js/cookie.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-body">
        <form id="form" method="post" class="layui-form layui-form-pane">
            <input type="hidden" name="id" value="<?php echo htmlentities($user['id']); ?>">
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>用户名
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" lay-verify="name"
                    autocomplete="off" class="layui-input" placeholder="如兰" value="<?php echo htmlentities($user['name']); ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="tel">
                    <span class="x-red">*</span>手机
                </label>
                <div class="layui-input-inline">
                    <input type="tel" id="tel" name="tel" lay-verify="required|phone" autocomplete="off" class="layui-input" placeholder="正确手机号" value="<?php echo htmlentities($user['tel']); ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label" for="pwd">
                    <span class="x-red">*</span>密码
                </label>
                <div class="layui-input-inline">
                    <input type="password" id="pwd" name="pwd" placeholder="密码不为空即修改" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label" for="mail">邮箱</label>
                <div class="layui-input-inline">
                    <input type="mail" id="mail" name="mail" lay-verify="mail" autocomplete="off" class="layui-input" value="<?php echo htmlentities($user['mail']); ?>">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">性别</label>
                <div class="layui-input-block">
                    <input type="radio" name="gender" value="1" title="男" <?php if($user['gender']==1): ?>checked<?php endif; ?>>
                    <input type="radio" name="gender" value="2" title="女" <?php if($user['gender']==2): ?>checked<?php endif; ?>>
                    <input type="radio" name="gender" value="0" title="保密" <?php if($user['gender']==0): ?>checked<?php endif; ?>>
                </div>
            </div>
            <div class="layui-form-item" id="x-city">
                <label class="layui-form-label">地址</label>
                <div class="layui-input-inline">
                    <select name="province" lay-filter="province">
                        <option>请选择省</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="city" lay-filter="city">
                        <option>请选择市</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <select name="area" lay-filter="area">
                        <option>请选择县/区</option>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" id="detail" name="detail" autocomplete="off" class="layui-input" placeholder="详细地址" value="<?php echo htmlentities($user['detail']); ?>">
                </div>
            </div>

                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        简介
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" id="desc" name="desc" class="layui-textarea"><?php echo htmlentities($user['desc']); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">添加</button>
              </div>
            </form>
    </div>

    <script type="text/javascript" src="/static/js/xcity.js"></script>
    <script>
        layui.use(['form','code'], function(){
            form = layui.form;

            layui.code();

            $('#x-city').xcity('<?php echo htmlentities($user['province']); ?>','<?php echo htmlentities($user['city']); ?>','<?php echo htmlentities($user['area']); ?>');

        });
    </script>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form,layer = layui.layer;
          //自定义验证规则
          form.verify({
            name: function(value){
              if(value.length < 2){
                return '昵称至少得2个字符啊';
              }
            }
            ,pwd: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
          });
          //监听提交
          form.on('submit(add)', function(data){
              $.post('<?php echo url("updateUser"); ?>',$('#form').serialize(),function(res){
                  if (res.status == 1) {
                      parent_reload_time(2000);
                      //发异步，把数据提交给php
                      layer.alert(res.msg, {icon: 6},function () {

                      });
                  } else {
                      layer.alert(res.msg, {icon: 2},function (index) {
                          // 获得frame索引
                          //var index = parent.layer.getFrameIndex(window.name);
                          //关闭当前frame
                          layer.close(index);
                      });
                  }
              })
              return false;
          });


        form.on('checkbox(father)', function(data){

            if(data.elem.checked){
                $(data.elem).parent().siblings('td').find('input').prop("checked", true);
                form.render();
            }else{
               $(data.elem).parent().siblings('td').find('input').prop("checked", false);
                form.render();
            }
        });
          
          
        });
    </script>
  </body>

</html>