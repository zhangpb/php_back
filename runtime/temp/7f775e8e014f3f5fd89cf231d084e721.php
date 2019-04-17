<?php /*a:1:{s:46:"E:\tp\tp\app\admin\view\admin\member-list.html";i:1552357882;}*/ ?>
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
    <script type="text/javascript" src="/static/js/xadmin.js"></script>
    <script type="text/javascript" src="/static/js/cookie.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">会员管理</a>
        <a href="">会员</a>
        <a>
          <cite>列表</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">&#xe669;</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">
        <form class="layui-form layui-col-md12 x-so" id="search_form">
          <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start_time" id="start" value="<?php echo htmlentities((isset($search['start_time']) && ($search['start_time'] !== '')?$search['start_time']:'')); ?>">
          <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end_time" id="end" value="<?php echo htmlentities((isset($search['end_time']) && ($search['end_time'] !== '')?$search['end_time']:'')); ?>">
          <input type="text" name="name"  placeholder="请输入用户名" autocomplete="off" class="layui-input" value="<?php echo htmlentities((isset($search['name']) && ($search['name'] !== '')?$search['name']:'')); ?>">
            <input type="hidden" id="sub_page" name="page" value="<?php echo htmlentities((isset($search['page']) && ($search['page'] !== '')?$search['page']:'')); ?>">
          <button class="layui-btn"  lay-submit="" lay-filter="search" id="search"><i class="layui-icon">&#xe615;</i></button>
            <button id="reset" type="button" class="layui-btn layui-btn-primary">重置</button>
        </form>
      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加会员','<?php echo htmlentities($add_user_url); ?>',950,600)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock>
      <table class="layui-table x-admin">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>用户名</th>
            <th>性别</th>
            <th>手机</th>
            <th>邮箱</th>
            <th>地址</th>
            <th>加入时间</th>
            <th>状态</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
        <?php if(is_array($users) || $users instanceof \think\Collection || $users instanceof \think\Paginator): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "无数据" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo htmlentities($user['id']); ?>'><i class="layui-icon">&#xe605;</i></div>
                </td>
                <td><?php echo htmlentities($user['id']); ?></td>
                <td><?php echo htmlentities($user['name']); ?></td>
                <td><?php echo htmlentities($user['gender']); ?></td>
                <td><?php echo htmlentities($user['tel']); ?></td>
                <td><?php echo htmlentities($user['mail']); ?></td>
                <td><?php echo htmlentities($user['address']); ?></td>
                <td><?php echo htmlentities($user['create_time']); ?></td>
                <td class="td-status">
                    <?php if($user['is_use'] == 1): ?>
                        <span class="layui-btn layui-btn-normal layui-btn-mini">已启用</span></td>
                    <?php else: ?>
                        <span class="layui-btn layui-btn-normal layui-btn-mini layui-btn-disabled">已启用</span></td>
                    <?php endif; ?>
                <td class="td-manage">
                    <?php if($user['is_use'] == 1): ?>
                        <a onclick="member_stop(this,'<?php echo htmlentities($user['id']); ?>')" href="javascript:;"  title="启用">
                            <i class="layui-icon">&#xe601;</i>
                        </a>
                    <?php else: ?>
                        <a onclick="member_stop(this,'<?php echo htmlentities($user['id']); ?>')" href="javascript:;"  title="停用">
                            <i class="layui-icon">&#xe62f;</i>
                        </a>
                    <?php endif; ?>

                    <a title="编辑"  onclick="x_admin_show('编辑','<?php echo htmlentities($add_user_url); ?>',950,600)">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <!--<a onclick="x_admin_show('修改密码','member-password.html',600,400)" title="修改密码" href="javascript:;">
                        <i class="layui-icon">&#xe631;</i>
                    </a>-->
                    <a title="删除" onclick="member_del(this,'要删除的id')" href="javascript:;">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
        <?php endforeach; endif; else: echo "无数据" ;endif; ?>
        </tbody>
      </table>
        <div id="page"></div>
    </div>
    <script>
      layui.use(['laydate','laypage','form'], function(){
        var laydate = layui.laydate;
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
          var laypage = layui.laypage;
          laypage.render({
              elem: 'page'
              ,count: "<?php echo htmlentities($user_list['total']); ?>"
              ,limit: "<?php echo htmlentities($user_list['per_page']); ?>"
              ,layout: ['count', 'prev', 'page', 'next', 'skip']
              ,curr:"<?php echo htmlentities($user_list['current_page']); ?>"
              ,jump: function(obj,first){
                  //页面跳转
                  if(!first){
                      $("#sub_page").val(obj.curr);
                      $("#search").trigger('click');
                  }
              }
          });
          var form = layui.form;
          //监听提交
          form.on('submit(search)', function(data){
              var params = '';
              $.each(data.field,function(k,v){
                  if (params) {
                      params += "&"+k+'='+v;
                  } else {
                      params += "?"+k+'='+v;
                  }
              })
              var url = location.origin+location.pathname+params;
              location.replace(url);
              return false;
          });
      });

       /*用户-停用*/
      function member_stop(obj,id){
          layer.confirm('确认要停用吗？',function(index){

              if($(obj).attr('title')=='启用'){

                //发异步把用户状态进行更改
                $(obj).attr('title','停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!',{icon: 5,time:1000});

              }else{
                $(obj).attr('title','启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!',{icon: 5,time:1000});
              }
              
          });
      }

      /*用户-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $(obj).parents("tr").remove();
              layer.msg('已删除!',{icon:1,time:1000});
          });
      }

      $(function(){
          $('#reset').click(function(){
              $('#search_form input').attr('value','')
              return ;
          })
      })


      function delAll (argument) {

        var data = tableCheck.getData();
  
        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>