<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;

 ?>

<div style="margin-top:0px;background: #DDD7C7 url(images/bg.jpg) repeat;"><!-- start main -->
	<div class="container">
		<div class="main row">
			<div class="col-md-8 blog_left">
				<h2 class="style">修改博客</h2>
				<?php echo $msg; ?>
				<img src="images/det_pic.jpg" alt="" class="blog_img img-responsive"/>
				<?php $form = ActiveForm::begin([
	                    'id' => 'editblog-form',
	                    'options' => [
	                            'class' => 'form-horizontal',
	                            'enctype' => 'multipart/form-data'
	                    	],
	                ]); ?>

					<?= $form->field($model, 'blog_title',['labelOptions' => ['label' => '标题:','class' => 'eml'], 'inputOptions' => ['value' => $blog['blog_title'], 'required' => 'required']])->textInput() ?>

					<?= $form->field($model, 'blog_body',['labelOptions' => ['label' => '内容:','class' => 'eml'], 'inputOptions' => ['value' => $blog['blog_body'], 'required' => 'required']])->textarea(['rows'=>12]) ?>

					<?= $form->field($model, 'blog_id',['labelOptions' => ['label' => '','class' => ''], 'inputOptions' => ['value' => $blog['blog_id']]])->hiddenInput() ?>

					<?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'style' => 'margin-left:50px;float:right;','name' => 'submit-button', 'tabindex' => '3']) ?>
				
				<?php $form = ActiveForm::end() ?>
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