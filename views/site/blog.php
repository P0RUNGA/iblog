<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
 ?>

<div style="margin-top:0px;background: #DDD7C7 url(images/bg.jpg) repeat;"><!-- start main -->
	<div class="container">
		<div class="main row">
			<div class="col-md-8 blog_left">
				<h2 class="style">精美的博客</h2>
				<?php foreach ($blogs as $blog): ?>
					<div class="blog_main">
						<img src="images/blog_pic1.jpg" alt="" class="blog_img img-responsive"/>
						<h4><a href="#"><?= $blog->blog_title ?></a></h4>
							<div class="blog_list pull-left">
								<ul class="list-unstyled">
									<li style="font-size:20px;">发表时间：<span style="font-size:20px;"><?= $blog->blog_update ?></span></li>
							  	</ul>
							</div>
						<div class="clearfix"></div>
						<pre class="para"><?= substr($blog->blog_body, 0, 400).'...'; ?> </pre>
						<div class="read_more btm">
							<a href="<?= Url::toRoute(['site/article', 'blog_id' => $blog->blog_id]);?>">查看 全文</a>
						</div>
					</div>
				<?php endforeach; ?>
				<?= LinkPager::widget(['pagination' => $pagination]) ?>
			</div>
			<div class="col-md-4 blog_right">
				<ul class="ads_nav list-unstyled">
					<h4>Ads 125 x 125</h4>
						<li><a href="#"><img src="images/ads_pic.jpg" alt=""> </a></li>
						<li><a href="#"><img src="images/ads_pic.jpg" alt=""> </a></li>
						<li><a href="#"><img src="images/ads_pic.jpg" alt=""> </a></li>
						<li><a href="#"><img src="images/ads_pic.jpg" alt=""> </a></li>
					<div class="clearfix"></div>
				</ul>
				<ul class="tag_nav list-unstyled">
					<h4>tags</h4>
						<li class="active"><a href="#">art</a></li>
						<li><a href="#">awesome</a></li>
						<li><a href="#">classic</a></li>
						<li><a href="#">photo</a></li>
						<li><a href="#">wordpress</a></li>
						<li><a href="#">videos</a></li>
						<li><a href="#">standard</a></li>
						<li><a href="#">gaming</a></li>
						<li><a href="#">photo</a></li>
						<li><a href="#">music</a></li>
						<li><a href="#">data</a></li>
						<div class="clearfix"></div>
				</ul>
				<!-- start social_network_likes -->
					<div class="social_network_likes">
				      		 <ul class="list-unstyled">
				      		 	<li><a href="#" class="tweets"><div class="followers"><p><span>2k</span>Followers</p></div><div class="social_network"><i class="twitter-icon"> </i> </div></a></li>
				      			<li><a href="#" class="facebook-followers"><div class="followers"><p><span>5k</span>Followers</p></div><div class="social_network"><i class="facebook-icon"> </i> </div></a></li>
				      			<li><a href="#" class="email"><div class="followers"><p><span>7.5k</span>members</p></div><div class="social_network"><i class="email-icon"> </i></div> </a></li>
				      			<li><a href="#" class="dribble"><div class="followers"><p><span>10k</span>Followers</p></div><div class="social_network"><i class="dribble-icon"> </i></div></a></li>
				      			<div class="clear"> </div>
				    		</ul>
		          	</div>
				<div class="news_letter">
					<h4>news letter</h4>
						<form>
							<span><input type="text" placeholder="Your email address"></span>
							<span  class="pull-right fa-btn btn-1 btn-1e"><input type="submit" value="subscribe"></span>
						</form>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
</div><!-- end main -->