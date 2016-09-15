<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<div class="row" style="min-height:800px;">
    <div class="container">
    <h2 class="style"><span class="glyphicon glyphicon-log-in"></span> 登入</h2>
    <?php echo $msg; ?>
    <div class="col-md-4 col-md-offset-4" style="margin-top:40px;">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">注册</h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id'                     => 'registration-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); ?>

                <?= $form->field($model, 'username')->textInput() ?>

                <?= $form->field($model, 'password1')->passwordInput() ?>

                <?= $form->field($model, 'password2',['labelOptions' => ['label' => '再输入一次']])->passwordInput() ?>

                <?= Html::submitButton('registration', ['class' => 'btn btn-primary btn-block', 'name' => 'registration-button']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <a href="<?= Url::toRoute('site/login')?>">已创建用户？现在登录</a>
        </p>
    </div>
    </div>
</div>
