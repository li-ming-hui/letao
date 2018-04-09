<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
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
        <h1>所有文章</h1>
        <a href="post-add.html" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
<?php 
//1. 链接MySQL
include_once '../include/mysql.php';
//额外定义两个变量
//当前页号
$pageno = isset($_GET['p'])?$_GET['p']:1;
//每页显示数量
$pagesize = 5;
//计算查询的起始点
$start =  ($pageno - 1) * $pagesize;
//2. 编写SQL语句并执行
$sql = "select article_id,article_title,admin_nickname,cate_name,article_addtime,
        article_state from ali_article art
        join ali_admin a on art.article_adminid=a.admin_id
        join ali_cate c on art.article_cateid=c.cate_id
        order by article_id asc
        limit $start,$pagesize";
        echo $sql;
$res = mysql_query($sql);
?>
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn dels btn-warning btn-sm" href="javascript:;">批量删除</a>
        <form class="form-inline">
          <select name="" class="form-control input-sm">
            <option value="">所有分类</option>
            <option value="">未分类</option>
          </select>
          <select name="" class="form-control input-sm">
            <option value="">所有状态</option>
            <option value="">草稿</option>
            <option value="">已发布</option>
          </select>
          <button class="btn btn-default btn-sm">筛选</button>
        </form>
<?php 
//计算导航条长度
//获取总条数
$sql_count = "select count(*) num from ali_article art
 join ali_admin a on art.article_adminid=a.admin_id
 join ali_cate c on art.article_cateid=c.cate_id";
$res_count = mysql_query($sql_count);
$arr_count = mysql_fetch_assoc($res_count);
//总页数
$page_length = ceil($arr_count['num']/$pagesize);
echo $page_length;

?>
        <ul class="pagination pagination-sm pull-right">
          <li><a href="posts.php?p=1">首页</a></li>
          <?php 
            if($pageno > 1) {
              $prev = $pageno - 1;
              echo "<li><a href='posts.php?p=$prev'>上一页</a></li>";
            } else {
              echo "<li><a href='javascript:;'>上一页</a></li>";
            }
          ?>
          <?php for($i = 1; $i <= $page_length; $i++) { ?>
          <li><a href="posts.php?p=<?php echo $i; ?>"><?php echo $i; ?></a></li>
          <?php } ?>

          <?php 
            if($pageno < $page_length) {
              $next = $pageno + 1;
              echo "<li><a href='posts.php?p=$next'>下一页</a></li>";
            } else {
              echo "<li><a href='javascript:;'>下一页</a></li>";
            }
          ?>
          <li><a href="posts.php?p=<?php echo $page_length; ?>">末页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php while($row = mysql_fetch_assoc($res)) { ?>
          <tr>
            <td class="text-center"><input type="checkbox" value="<?php echo $row['article_id']; ?>"></td>
            <td><?php echo $row['article_title']; ?></td>
            <td><?php echo $row['admin_nickname']; ?></td>
            <td><?php echo $row['cate_name']; ?></td>
            <td class="text-center">
              <?php echo date('Y-m-d H:i:s', $row['article_addtime']); ?>
            </td>
            <td class="text-center">
              <?php echo $row['article_state']==1?'已发布':'草稿'; ?>
            </td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" data="<?php echo $row['article_id'];?>" class="btn btn-danger btn-xs">删除</a>
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

  
  <script type="text/javascript" src="/assets/require.js"></script>
  <script>NProgress.done()</script>

  <script type="text/javascript">
  requirejs.config({
    baseUrl: '../../assets',
    paths: {
      'jq': 'jquery.1.11',
      'layer': 'layer/layer'
    }
  });
  require(['../../assets/module/dels'], function(result){
    result('您确定要删除该文章吗?', 'postdel.php', 'btn-danger');
  })

  //获取批量删除按钮对象，绑定点击事件
  /*$('.dels').click(function(){
    //获取已选中的checkbox中的value值
    //$(':checkbox') 找到当前页面中所有的checkbox
    //$(':checkbox:checked') 找到已勾选的checkbox
    //因为check_list对象内部是一个类似于数组的结构
    //所以需要使用each来进行循环，来取出value值
    var check_list = $(':checkbox:checked');
    //console.log(check_list);
    //index是索引
    //elem是每次循环取出的对象，这里是一个dom对象
    //通过dom的value属性取出 article_id,再拼接为字符串
    var ids = '';
    /*check_list.each(function(index, elem){
      //alert(index + " " + elem.value);
      ids += elem.value + ',';  //innerHTML
    }) //1,2,*/
    /*$.each(check_list, function(index, elem){
      ids += elem.value + ',';  //innerHTML
    })*/
    //console.log(ids);

    //截取掉最后一个逗号
    //ids = ids.slice(0, -1);  //1,2
    //跳转到批量删除文章的php页面中
    //location.href = 'delposts.php?ids='+ids;
  //})*/
  </script>
</body>
</html>
