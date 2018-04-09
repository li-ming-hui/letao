<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>
  <?php include_once '../include/checksession.php'; ?>
  <div class="main">
    <?php include_once '../include/nav.php'; ?>
    <div class="container-fluid">
      <div class="page-title">
        <h1>管理员</h1>
        <button onclick="add_admin()">添加新管理员</button>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">

        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none;">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>昵称</th>
                <th>创建时间</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
<script type="text/javascript">
$.get('getAdminList.php', {}, function(msg){
  alert(msg);
}, 'json');
</script>

            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script type="text/javascript" src="/assets/layer/layer.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script type="text/javascript" src="/assets/require.js"></script>
  <script>NProgress.done()</script>

  <script type="text/javascript">
  require(['../../assets/module/dels'], function(result){
    result('您确定要删除该用户吗?', 'deladmin.php');
  });


  function add_admin(){
    layer.ready(function(){ 
      layer.open({
        type: 2,
        title: '欢迎页',
        maxmin: true,
        area: ['800px', '550px'],
        content: 'addadminform.html'
      });
    });
  }

  

  $('.btn-default').on('click', function(){
    // attr方法是jquery的方法，用来设置或者获取属性的值
    // 获取data属性的值，就是admin_id
    var id = $(this).attr('data');
    // 调用layer对象的open方法，打开弹出层
    layer.ready(function(){ 
      layer.open({
        type: 2,
        title: '编辑管理员信息',
        maxmin: true,
        area: ['800px', '550px'],
        content: 'editadminform.php?id='+id  //通过get传递参数
      });
    });
  });
  </script>
</body>
</html>
