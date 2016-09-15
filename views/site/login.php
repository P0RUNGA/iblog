<?php 

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
 ?>
<div style="min-height:800px;">
    <div class="container"><!-- start main -->
        <h2 class="style"><span class="glyphicon glyphicon-log-in"></span> 登入</h2>
        <div class="main row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><span class="glyphicon glyphicon-log-in"></span> 登入</h3>
                    </div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin([
                            'id'                     => 'login-form',
                            'options' => [
                                    'class' => 'form-horizontal',
                                ],
                        ]); ?>

                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                        <?= $form->field($model, 'password')->passwordInput() ?>

                        <?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '4']) ?>

                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button', 'tabindex' => '3']) ?>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <a href="<?= Url::toRoute('site/registration') ?>" style="margin-left:85px;">没有账号？创建一个新账号</a>
            </div>
        </div>
    </div><!-- end main -->
</div>