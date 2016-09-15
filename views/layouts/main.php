<?php 

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
 ?>
<!DOCTYPE HTML>
<html>
<head>
<title>i 博客</title>
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
     <script src="https://oss.maxcdn.com/libs/respond.web/js/1.4.2/respond.min.js"></script>
<![endif]-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="shortcut icon" href="images/icon.png" type="text/css">
<!-- start plugins -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
    <script>
        $(function() {
            var pull        = $('#pull');
                menu        = $('nav ul');
                menuHeight  = menu.height();
            $(pull).on('click', function(e) {
                e.preventDefault();
                menu.slideToggle();
            });
            $(window).resize(function(){
                var w = $(window).width();
                if(w > 320 && menu.is(':hidden')) {
                    menu.removeAttr('style');
                }
            });
        });
    </script>
</head>
<body>
<div class="header_bg" id="home"><!-- start header -->
<div class="container">
    <div class="row header text-center specials">
        <div class="h_logo">
            <a href="<?= Url::toRoute('site/index');?>"><img src="images/logo.png" alt="" class="responsive"/></a>
        </div>
        <nav class="top-nav">
            <ul class="top-nav nav_list">
                <li class="dropdown active">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-home"></span> 个人主页 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= Url::toRoute('site/personal');?>"><span class="glyphicon glyphicon-home"></span> 个 人 信 息</a></li>
                       <li><a href="<?= Url::toRoute('site/editblog');?>"><span class="glyphicon glyphicon-pencil"></span> 编 辑 博 客</a></li>
                       <li><a href="<?= Url::toRoute('site/editmsg');?>"><span class="glyphicon glyphicon-user"></span> 编 辑 信 息</a></li>
                    </ul>
                </li>
                <li class="page-scroll"><a href="<?= Url::toRoute('site/about');?>">关于</a></li>
                <li class="page-scroll"><a href="<?= Url::toRoute('site/blog');?>">博客</a></li>
                <li class="logo page-scroll"><a title="hexa" href="<?= Url::toRoute('site/index');?>"><img src="images/logo.png" alt="" class="responsive"/></a></li>
                <li class="page-scroll"><a href="#contact">联系我们</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">语言(language) <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">中文</a></li>
                        <li><a href="#">English</a></li>
                    </ul>
                </li>
                
                <?php 
                    echo Nav::widget([
                        'options' => ['class' => 'page-scroll','style' => 'position:absolute;display:inline-block;margin-top:12px;'],
                        'items' => [
                            Yii::$app->user->isGuest ? (
                                ['label' => '登入', 'url' => ['/site/login']]
                            ) : (
                                '<li>'
                                . Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                    '登出 (' . Yii::$app->user->identity->username . ')',
                                    ['class' => 'btn btn-link']
                                )
                                . Html::endForm()
                                . '</li>'
                            )
                        ],
                    ]);
                 ?>
                
            </ul>
            <a href="#" id="pull"><img src="images/nav-icon.png" title="menu" /></a>
        </nav>
    </div>
</div>
</div>

<?= $content ?>

<div class="copyrights">Collect from <a href="#" >ÆóÒµÍøÕ¾Ä£°å</a></div>
<div class="footer_bg" id="contact"><!-- start footer -->
<div class="container">
    <div class="row footer">
        <div class="col-md-8 contact_left">
            <h3>联系 我们</h3>
            <p>为了与我们取得联系 你必须填写以下的表单:</h4>
            <!-- <form method="post" action="iblog_yii2/web/index.php?r=site/Fcontact" method="post"> -->
            <?php $form = ActiveForm::begin([
                    'id' => 'contact-form',
                    'action' => ['site/index'],
                    'method'=>'post',
                ]); ?>
                <input type="text" name="name" value="姓名 （必填）" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '姓名';}">
                <input type="text" name="email" value="邮箱 （必填）" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '邮箱';}">
                <input type="text" name="subject" value="项目" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = '项目';}">
                <textarea name="body" onFocus="if(this.value == '你的要反馈的信息....') this.value='';" onBlur="if(this.value == '') this.value='你的要反馈的信息....;" >你的要反馈的信息....</textarea>
                <span class="pull-right"><input type="submit" value="提交 表单"></span>
            <!-- </form> -->
            <?php $form = ActiveForm::end(); ?>
        </div>
        <div class="col-md-4  contact_right">
            <p><span>以下保存的只是一些虚拟的文本: </span> 以下存有的是自从16世纪以来一直是行业的标准虚拟文本，该段文本没有提供任何的实际信息，它只是做一个示范。它不仅存活了五个世纪，而且还跨越了电子排版，基本上保持不变。它不仅存活了五个世纪，而且还跨越了电子排版，基本上保持不变它不仅存活了五个世纪，而且还跨越了电子排版，基本上保持不变 </p>
            <ul class="list-unstyled address">
                <li><i class="fa fa-map-marker"></i><span>50001 邮编 地址</span></li>
                <li><i class="fa fa-phone"></i><span>(00) 222 666 444</span></li>
                <li><i class="fa fa-envelope"></i><a href="mailto:3066463563@qq.com">info(at)mycompany.com</a></li>
            </ul>
        </div>      
    </div>
</div>
</div>
<div class="footer1_bg"><!-- start footer1 -->
    <div class="container">
        <div class="row  footer">
            <div class="copy text-center">
                <p class="link"><span>&#169; 该网站只是做为比赛作品 | 私人版权所有 <a href="#" target="_blank">Ä£°åÖ®¼Ò</a> - Collect from <a href="#" target="_blank">ÍøÒ³Ä£°å</a></span></p>
                <a href="#home" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"> </span></a>
            </div>
        </div>
        <script type="text/javascript">
                $(function() {
                  $('a[href*=#]:not([href=#])').click(function() {
                    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            
                      var target = $(this.hash);
                      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                      if (target.length) {
                        $('html,body').animate({
                          scrollTop: target.offset().top
                        }, 1000);
                        return false;
                      }
                    }
                  });
                });
        </script>
        <!-- start-smoth-scrolling  -->       
    </div>
</div>
</body>
</html>