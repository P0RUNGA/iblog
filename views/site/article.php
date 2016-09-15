<?php 

use app\models\User;

$sql = 'SELECT * FROM iblog_user WHERE user_id = "'.$blog['user_id'].'"';
$user = User::findBySql($sql)->one();
 ?>
<div class="blog" style="margin:0px;background: #DDD7C7 url(images/bg.jpg) repeat;"><!-- start main -->
	<div class="container">
		<div class="main row">
			<h2 class="style">文章标题：<?= $blog['blog_title'] ?></h2>
			<div class="details row">
				<div class="col-md-6">
					<img src="images/det_pic.jpg" alt="" class="img-responsive"/>
				</div>
				<div class="col-md-6">
					<h2 class="style1" style="margin:0px;">作者：<?= $user['username'];?></h2>
					<div class="col-md-6">
						<img src="<?php echo PICPATH.$user["picture"]; ?>" class="img-responsive img-circle" style="width:150px;padding:6px;display:inline-block;">
					</div>
					<div class="col-md-6" style="font-size:17px;font-weight:bold;color:#666;margin:20px 0px 20px -25px;">
						<p>姓名：<?= $user['first_name'].'  '.$user['last_name']; ?></p>
						<p>所在地：<?= $user['state'].'  '.$user['city']; ?></p>
						<p>电话：<?= $user['phone']; ?></p>
						<p>邮箱：<?= $user['email']; ?></p>
					</div>
					<h2 class="style2" style="margin:0px;clear:both;">写作日期：<?= $blog['blog_update'] ?></h2>
				</div>
				<div class="clearfix"></div>
			</div>
			<pre class="para"><?= $blog['blog_body'] ?></pre>
		</div>
	</div>
</div><!-- end main -->

