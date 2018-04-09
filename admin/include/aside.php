<?php 

//print_r($_SERVER);
//获取当前访问的脚本路径
//$_SERVER['SCRIPT_NAME'] = '/admin/other/settings.php'
//将脚本路径拆分成数组
$arr = explode('/',$_SERVER['SCRIPT_NAME']);
//$arr = ['', 'admin', 'other', 'settings.php'];
//检测$arr[2]单元值
//如果是post或者cate, 文章下拉菜单是展开状态
//如果是other，设置下拉菜单是展开状态
echo $arr[2];
?>

<div class="profile">
      <img class="avatar" src="/uploads/avatar.jpg">
      <h3 class="name"><?php echo $_SESSION['nickname']; ?></h3>
    </div>
    <ul class="nav">
      <li class="active">
        <a href="index.html"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li>
        <a href="#menu-posts" class="collapsed" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse <?php if($arr[2]=='post' || $arr[2]=='cate') {echo 'in';}  ?>">
          <li><a href="/admin/post/posts.php">所有文章</a></li>
          <li><a href="/admin/post/addpost.php">写文章</a></li>
          <li><a href="/admin/cate/categories.php">分类目录</a></li>
          <li><a href="/admin/cate/addcate.php">添加分类</a></li>
        </ul>
      </li>
      <li>
        <a href="/admin/comment/comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="/admin/admin/admin.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" <?php if($arr[2]!='other') echo 'class="collapsed"' ?> data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse <?php if($arr[2]=='other'){echo 'in';} ?>">
          <li><a href="nav-menus.html">导航菜单</a></li>
          <li><a href="/admin/other/slides.php">图片轮播</a></li>
          <li><a href="/admin/other/settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>