<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
 ?>
<div style="margin-top:0px;background: #DDD7C7 url(images/bg.jpg) repeat;">
	<div class="container">
		<div id="main" style="margin-top:50px;">
			<div class="col-lg-4" style="background:#2EB398;padding:40px;color:#fff;margin:28px 0px 50px 0px;">
				<h1 style="margin-bottom:50px;font-size:50px;"><?= Html::encode($user['username']) ?></h1>
				<div style="border:2px solid #fff;padding:25px;"><img class="img-responsive" src="<?php echo PICPATH.$user['picture']; ?>"></div>
				<div class="swrap">
					<h3>电话:</h3>
					<p><?= Html::encode($user['phone']) ?></p>
				</div>
				<div class="swrap">
					<h3>邮箱:</h3>
					<p><?= Html::encode($user['email']) ?></p>
				</div>
				<div class="swrap">
					<h3>地址:</h3>
					<p><?php echo $user['state'].'  '.$user['city']; ?></p>
				</div>
			</div>
			<div class="col-lg-8">
				<h2 class="style">填写个人信息</h1>
				<?php echo $errmsg; ?>
				<div id="form" style="margin:0px 30px;">
					<?php $form = ActiveForm::begin([
	                    'id'                     => 'login-form',
	                    'enableAjaxValidation'   => true,
	                    'enableClientValidation' => false,
	                    'validateOnBlur'         => false,
	                    'validateOnType'         => false,
	                    'validateOnChange'       => false,
	                    'options' => [
	                            'class' => 'form-horizontal',
	                            'enctype' => 'multipart/form-data'
	                    	],
	                ]); ?>
					
					<?= $form->field($model, 'first_name',['labelOptions' => ['label' => '姓:','class' => 'eml'],'inputOptions' => ['value' => Html::encode($user['first_name'])]])->textInput() ?>
					
					<?= $form->field($model, 'last_name',['labelOptions' => ['label' => '名:','class' => 'eml'],'inputOptions' => ['value' => Html::encode($user["last_name"])]])->textInput() ?>

					<?= $form->field($model, 'gender',['labelOptions' => ['label' => '性别:','class' => 'eml']])->dropDownList(['M'=>'男','F'=>'女']) ?>

					<?= $form->field($model, 'birthdate',['labelOptions' => ['label' => '出生年月日:','class' => 'eml'],'inputOptions' => ['value' => Html::encode($user["birthdate"])]])->textInput() ?>

					<?= $form->field($model, 'picture',['labelOptions' => ['label' => '头像:','class' => 'eml']])->fileInput() ?>

					<h2 class="style1">联系方式</h2>

					<?= $form->field($model, 'phone',['labelOptions' => ['label' => '电话:','class' => 'eml'],'inputOptions' => ['value' => Html::encode($user["phone"])]])->textInput() ?>

					<?= $form->field($model, 'email',['labelOptions' => ['label' => '邮箱:','class' => 'eml'],'inputOptions' => ['value' => Html::encode($user["email"])]])->textInput() ?>

					<h2 class="style2">居住地</h2>

					<?= $form->field($model, 'city',['labelOptions' => ['label' => '城市:','class' => 'eml'],'inputOptions' => ['value' => Html::encode($user["city"])]])->textInput() ?>

					<?= $form->field($model, 'state',['inputOptions' => ['style' => 'float:left;'], 'labelOptions' => ['label' => '省份:','class' => 'eml'],'inputOptions' => ['value' => Html::encode($user["state"])]])->textInput() ?>

					<?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'style' => 'margin-left:50px;float:right;','name' => 'submit-button', 'tabindex' => '3']) ?>

					<?= Html::resetButton('重置', ['class'=>'btn btn-danger', 'style' => 'float:right;','name' =>'reset-button', 'tabindex' => '3']) ?>
				
					<?php $form = ActiveForm::end(); ?>
	            </div>
			</div>
		</div>
	</div>
</div>