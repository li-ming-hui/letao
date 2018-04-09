  <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="/assets/css/admin.css">
  <script src="/assets/vendors/nprogress/nprogress.js"></script>
  <script type="text/javascript" src="/assets/jquery.1.11.js"></script>
<?php 
//1. 接收admin_id
$admin_id = $_GET['id']; 
//2. 链接数据库
include_once '../include/mysql.php';
//3. 拼接SQL语句并执行
$sql = "select * from ali_admin where admin_id=$admin_id";
$res = mysql_query($sql);
//4. 将资源转为一维数组
$admin_info = mysql_fetch_assoc($res);
?>
<div class="col-md-4">
<form id="mainForm">
<h2>编辑管理员</h2>
  <input type="hidden" name="id" value="<?php echo $admin_info['admin_id'];?>" />
  <div class="form-group">
    <label for="email">邮箱</label>
    <input id="email" class="form-control" name="email" type="email" value="<?php echo $admin_info['admin_email'];?>">
  </div>
  <div class="form-group">
    <label for="nickname">昵称</label>
    <input id="nickname" class="form-control" name="nickname" type="text" value="<?php echo $admin_info['admin_nickname'];?>">
  </div>
  <div class="form-group">
    <label for="age">年龄</label>
    <input id="age" class="form-control" name="age" type="text" value="<?php echo $admin_info['admin_age'];?>">
  </div>
  <div class="form-group">
    <label for="gender">性别</label>
    <?php if($admin_info['admin_gender'] == '男') { ?>
    <input id="gender" name="gender" type="radio" value="男" checked>男
    <input id="gender" name="gender" type="radio" value="女">女
    <?php } else { ?>
    <input id="gender" name="gender" type="radio" value="男" >男
    <input id="gender" name="gender" type="radio" value="女" checked>女
    <?php } ?>
  </div>
  <div class="form-group">
    <label for="state">状态</label>
    <?php if($admin_info['admin_state'] == 1) { ?>
    <input id="state" name="state" type="radio" value="1" checked>激活
    <input id="state" name="state" type="radio" value="2">未激活
    <?php } else { ?>
    <input id="state" name="state" type="radio" value="1" >激活
    <input id="state" name="state" type="radio" value="2" checked>未激活
    <?php } ?>
  </div>
  <div class="form-group">
    <button class="btn btn-primary" type="button">修改</button>
  </div>
</form>
</div>
<script type="text/javascript">
//获取修改按钮，绑定点击事件
$('.btn-primary').click(function(){
  //获取表单数据
  var fm = document.getElementById('mainForm');
  var fd = new FormData(fm);

  //发送ajax请求
  $.ajax({
    url: 'editadmin_deal.php',
    type: 'post',
    data: fd,
    dataType: 'text',
    contentType: false,
    processData: false,
    success: function(msg){
      if(msg == 1){
        parent.layer.alert('修改管理员信息成功');
        var index = parent.layer.getFrameIndex(window.name);
        parent.layer.close(index);
        parent.location.reload();
      } else {
        parent.layer.alert('修改管理员信息失败');
      }
    }
  });
})
</script>