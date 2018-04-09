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
    <?php include_once 'left.php';?>
    <div class="content">
      <div class="article">
        <div class="breadcrumb">
<?php 
//1. 接收article_id
$id = $_GET['id'];
//2. 查询数据
$sql = "select * from ali_article art
  join ali_admin a on art.article_adminid=a.admin_id
  join ali_cate c on art.article_cateid=c.cate_id
  where article_id=$id";
$res = mysql_query($sql);
$article = mysql_fetch_assoc($res);
//3. 对当前文章的点击量加1
$sql = "update ali_article set article_click=article_click+1 where article_id=$id";
mysql_query($sql);
?>
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;">奇趣事</a></dd>
            <dd><?php echo $article['article_title']; ?></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><?php echo $article['article_title']; ?></a>
        </h2>
        <div class="meta">
          <span><?php echo $article['admin_nickname']; ?> 
          发布于 <?php echo date('Y-m-d',$article['article_addtime']); ?></span>
          <span>分类: <a href="javascript:;"><?php echo $article['cate_name']; ?></a></span>
          <span>阅读: (<?php echo $article['article_click']; ?>)</span>
          <span>评论: (143)</span>
          <!-- htmlspecialchars_decode 会将html实体转回成标签 -->
          <div><?php echo htmlspecialchars_decode($article['article_content']); ?></div>
        </div>
      </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
</html>
