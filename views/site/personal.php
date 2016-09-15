<?php 

use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\User;

$user = User::findOne($user_id)->toArray();
 ?>
<div style="margin-top:0px;background: #DDD7C7 url(images/bg.jpg) repeat;">
	<div class="container">
		<div class="col-lg-7" style="margin-top:50px;">
			<div class="blog_left">
				<h2 class="style">精美的博客</h2>
				<?php echo $msg; ?>
				<?php if(!empty($blogs)): ?>
					<?php foreach ($blogs as $blog): ?>
						<div class="blog_main">
							<img src="images/det_pic.jpg" alt="" class="blog_img img-responsive"/>
							<h4><a href="<?= Url::toRoute(['site/article', 'blog_id' => $blog->blog_id]);?>"><?= $blog->blog_title ?></a></h4>
								<div class="blog_list pull-left">
									<ul class="list-unstyled">
										<li style="font-size:20px;">发表时间：<span style="font-size:20px;"><?= $blog->blog_update ?></span></li>
								  	</ul>
								</div>
							<div class="b_left pull-right">
								<a href="<?= Url::toRoute(['site/update', 'blog_id' => $blog->blog_id]);?>" class="btn btn-primary" style="color:white;margin-right:20px;"><span class="glyphicon glyphicon-wrench"></span> 修改</a>
								<a class="btn btn-danger" style="color:white;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-trash"></span> 删除</a>
							</div>
							<div class="clearfix"></div>
							<pre class="para"><?= substr($blog->blog_body, 0, 400).'...'; ?></pre>
							<div class="read_more btm">
								<a href="<?= Url::toRoute(['site/article', 'blog_id' => $blog->blog_id]);?>">查看 全文</a>
							</div>
						</div>
					<?php endforeach; ?>
					<?= LinkPager::widget(['pagination' => $pagination]) ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-lg-5" style="background:url(images/pbg.jpg);min-height:1000px;margin-top:75px;padding:60px;">
			<img src="<?php echo PICPATH.$user['picture'] ?>" class="img-responsive img-circle" style="width:150px;">
			<h3 style="color:#666;margin-top:60px;line-height:40px;"><strong style="color:#fff;">我是 <?= $user['username'] ?></strong> 这里是一个简单的<br />
				示范文本 示范文本 示范文本<br />
				crafted by HTML 5</h3>
		</div>
	</div>
</div>
<!-- 模态框（Modal） -->
<?php if(!empty($blog)): ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
	    <div class="modal-content" style="width:450px;">
	        <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            <h4 class="modal-title" id="myModalLabel">您需要输入用户名及密码</h4>
	        </div>
	        <?php $form = ActiveForm::begin([
				'id' => 'confirm-form',
				'method' => 'post',
                'options' => [
						'class' => 'form-signin',
						'style' => 'padding:20px;',
                	],
            ]); ?>
		
			<?= $form->field($model, 'username',['labelOptions' => ['label' => '用户名:','class' => 'eml'],'inputOptions' => ['class' =>'form-control', 'placeholder' => 'User Name', 'required' => 'required']])->textInput() ?>

			<?= $form->field($model, 'password',['labelOptions' => ['label' => '密码:','class' => 'eml'],'inputOptions' => ['class' =>'form-control', 'placeholder' => 'PassWord', 'required' => 'required']])->passwordInput() ?>

			<?= $form->field($model, 'blog_id',['labelOptions' => ['label' => ' ']])->hiddenInput(['value'=> $blog->blog_id]) ?>

			<?= Html::submitButton('删除', ['class' => 'btn btn-danger', 'style' => 'margin-right:20px;','name' => 'submit-button', 'tabindex' => '3']) ?>

			<button type="button" class="btn btn-primary" data-dismiss="modal">关闭</button>

            <?php $form = ActiveForm::end(); ?>
	    </div><!-- /.modal-content -->
	</div><!-- /.modal -->
</div>
<?php endif; ?>