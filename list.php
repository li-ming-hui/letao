<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <?php include_once 'left.php'; ?>

    <?php 
    //1. 接收cate_id的值
    $cate_id = $_GET['id'];
    $sql = "select * from ali_article art
          join ali_admin a on art.article_adminid=a.admin_id
          join ali_cate c on art.article_cateid=c.cate_id
          where cate_id=$cate_id
          order by article_addtime desc
          limit 0,3";
    $res = mysql_query($sql);
    ?>
    <div class="content">
      <div class="panel new">
        <h3><?php echo $_GET['name']; ?></h3>
        <?php while($row = mysql_fetch_assoc($res)) { ?>
        <div class="entry">
          <div class="head">
            <a href="javascript:;"><?php echo $row['article_title']; ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $row['admin_nickname']; ?> 发表于 
            <?php echo date('Y-m-d', $row['article_addtime']); ?></p>
            <p class="brief"><?php echo $row['article_desc']; ?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $row['article_click']; ?>)</span>
              <span class="comment">评论(0)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $row['article_good']; ?>)</span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="/admin/uploads/<?php echo $row['article_pic']; ?>" alt="">
            </a>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
