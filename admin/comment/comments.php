<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
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
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
<?php 
//1. 链接MySQL
include_once '../include/mysql.php';

//定义当前页号和每页显示数量
//判断是否有$_GET['p']参数，如果有则接收
//如果没有，默认为 1
$pageno = isset($_GET['p'])?$_GET['p']:1;
$pagesize = 3;
//提前计算起始位置
$start = ($pageno - 1) * $pagesize;


//2. 编写SQL并执行
$sql = "select cmt_id,cmt_content,member_nickname,article_title,cmt_time,cmt_state 
 from ali_comment c
 join ali_member m on c.cmt_memid=m.member_id
 join ali_article a on c.cmt_postid=a.article_id
 order by cmt_id desc
 limit $start, $pagesize";
$res = mysql_query($sql);
?>
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm">批量删除</button>
        </div>
<?php  
//1. 查询数据总条数
$sql = "select count(*) num from ali_comment c
 join ali_member m on c.cmt_memid=m.member_id
 join ali_article a on c.cmt_postid=a.article_id";
//2. 查询 
$res_count = mysql_query($sql);
//$arr_count['num'] = 16; 
$arr_count = mysql_fetch_assoc($res_count);
//3. 计算总页数
$page_count = ceil($arr_count['num']/$pagesize);
?>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="comments.php?p=1">首页</a></li>
          <?php
            if($pageno > 1){
              //计算上一页的页号
              $prev = $pageno - 1;
              echo "<li><a href='comments.php?p=$prev'>上一页</a></li>";
            } else {
              echo "<li><a href='javascript:;'>上一页</a></li>";
            }
          ?>
          <?php for($i = 1; $i <= $page_count; $i++){ ?>
          <li><a href="comments.php?p=<?php echo $i;?>"><?php echo $i;?></a></li>
          <?php } ?>
          <?php
            //当前页号小于总页数时，才有下一页
            if($pageno < $page_count){
              $next = $pageno + 1;
              echo "<li><a href='comments.php?p=$next'>下一页</a></li>";
            } else {
              echo "<li><a href='javascript:;'>下一页</a></li>";
            }
          ?>
          <li><a href="comments.php?p=<?php echo $page_count; ?>">末页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysql_fetch_assoc($res)) { ?>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td><?php echo $row['member_nickname']; ?></td>
            <td><?php echo $row['cmt_content']; ?></td>
            <td><?php echo $row['article_title']; ?></td>
            <td><?php echo date('Y-m-d' ,$row['cmt_time']); ?></td>
            <td><?php echo $row['cmt_state']; ?></td>
            <td class="text-center">
              <?php if($row['cmt_state'] == '批准'){ ?>
              <a href="javascript:;" data="<?php echo $row['cmt_id']; ?>" class="btn state btn-warning btn-xs">驳回</a>
              <?php } elseif($row['cmt_state'] == '驳回') { ?>
              <a href="javascript:;" data="<?php echo $row['cmt_id']; ?>" class="btn state btn-info btn-xs">批准</a>
              <?php } ?>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="aside">
    <?php include_once '../include/aside.php'; ?>
  </div>

  <script src="/assets/vendors/jquery/jquery.js"></script>
  <script src="/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/javascript">
  //获取页面上所有的驳回或者批准按钮，绑定点击事件
  $('.state').on('click', function(){
    //获取当前行的cmt_id
    var cmt_id = $(this).attr('data');
    //获取按钮上的文字
    var state = $(this).html();
    //转存当前的按钮对象
    _this = $(this);
    //发送ajax请求
    var data = {id:cmt_id, state: state, '_':Math.random()};
    $.get('changeState.php', data, function(msg){
      if(msg == 1){
        alert('修改成功');
        //判断当前按钮上的文字    批准(btn-info)-->驳回(btn-warning)
        //如果文字是批准，则状态列修改为批准，按钮文字修改为驳回
        //  按钮的样式先删除btn-info,再增加btn-warning
        //如果文字是驳回，则状态类修改为驳回，按钮文字修改为批准
        //   驳回-->批准，先删除btn-warning，再增加btn-info
        if(state == '批准'){
          _this.parent().prev().html('批准');
          _this.html('驳回').removeClass('btn-info').addClass('btn-warning');
        } else if(state == '驳回'){
          _this.parent().prev().html('驳回');
          _this.html('批准').removeClass('btn-warning').addClass('btn-info');
        }
      } else {
        alert('修改失败');
      }
    });
  })

  </script>
</body>
</html>
