<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EditmsgForm;
use app\models\EditblogForm;
use app\models\RegistrationForm;
use app\models\Confirm;
use app\models\Blog;
use app\models\User;
use yii\helpers\Url;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','personal','editmsg','editblog'],
                'rules' => [
                    [
                        'actions' => ['logout','personal','editmsg','editblog'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $msg = '';
        if(!empty(Yii::$app->request->post())){
            $post = Yii::$app->request->post();
            $mail = Yii::$app->mailer->compose();
            $mail->setTo('3066463563@qq.com');
            $mail->setSubject($post['name']);
            $mail->setHtmlBody($post['body']);
            if($mail->send()){
                echo '<script>alert("邮箱发送成功，感谢与我们的联系！");</script>';
            }
        }
        return $this->render('index');
    }

    public function actionRegistration()
    {
        $msg = '';
        $model = new RegistrationForm();
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->validate()){
            $post = Yii::$app->request->post('RegistrationForm');
            //判断是否存在该用户
            $sql = 'SELECT username FROM iblog_user WHERE username = "'.$post['username'].'"';
            $user = User::findBySql($sql)->one();
            if(empty($user['username'])){
                $user = new User();
                $user->username = $post['username'];
                $user->password = sha1($post['password1']);
                $user->join_date = date("Y-m-d H:i:s");
                $user->save();
                $msg = '<div class="alert alert-success">
                           <a href="#" class="close" data-dismiss="alert">
                              &times;
                           </a>
                           <strong style="padding:10px;font-size:20px;">注册成功，<a href="'.Url::toRoute(['site/login']).'">点击登入</a>！</strong>
                        </div>';
                return $this->render('registration',[
                    'model' => $model,
                    'msg' => $msg,
                ]);
                
            }
            else{
                $msg = '<div class="alert alert-danger">
                           <a href="#" class="close" data-dismiss="alert">
                              &times;
                           </a>
                           <strong style="padding:10px;font-size:20px;">该用户名已经存在，请换一个用户名！</strong>
                        </div>';
                return $this->render('registration',[
                    'model' => $model,
                    'msg' => $msg,
                ]);
            }
        }
        return $this->render('registration',[
                'model' => $model,
                'msg' => $msg,
            ]);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {

    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionBlog()
    {
        $query = Blog::find();
        if($query->count() > 30 ) $query->count = 30; 

        $pagination = new Pagination([
            'defaultPageSize' => 3,
            'totalCount' => $query->count(),
        ]);

        $blogs = $query->orderBy('blog_update desc')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return $this->render('blog', [
            'blogs' => $blogs,
            'pagination' => $pagination,
        ]);
    }

    public function actionPersonal()
    {
        $msg = '';
        $user_id = Yii::$app->user->getId();
        
        $query = Blog::find()->where(['user_id' => $user_id]);
        $pagination = new Pagination([
            'defaultPageSize' => 2,
            'totalCount' => $query->count(),
        ]);
        $blogs = $query->orderBy('blog_update desc')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        if($query->count() == 0){
            $msg = '<div class="alert alert-warning">
                        <a href="#" class="close" data-dismiss="alert">
                           &times;
                        </a>
                        <strong style="padding:10px;font-size:20px;">您还没有博客，点击此处<a href="'.Url::toRoute('site/editblog').'">编写博客</a>！</strong>
                    </div>';
            $model = new Confirm();
            return $this->render('personal',[
                'model' => $model,
                'user_id' => $user_id,
                'blogs' => $blogs,
                'pagination' => $pagination,
                'msg' => $msg,
            ]);
        }

        $model = new Confirm();
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
            if($model->validate()){
                $msg = Yii::$app->request->post('Confirm');
                $blog_id = $msg['blog_id'];

                $this_blog = Blog::find()->where(['user_id' => $user_id])->one();
                $this_blog->delete();
                $this->refresh();
                $msg = '';
                return $this->render('personal',[
                    'model' => $model,
                    'user_id' => $user_id,
                    'blogs' => $blogs,
                    'pagination' => $pagination,
                    'msg' => $msg,
                ]);
            }
            else{
                echo '<script>alert("用户名或密码错误，不允许删除该篇博客！");</script>';
            }
        }
        
        return $this->render('personal',[
            'model' => $model,
            'user_id' => $user_id,
            'blogs' => $blogs,
            'pagination' => $pagination,
            'msg' => $msg,
        ]);
    }

    public function actionArticle()
    {
        if(Yii::$app->request->isGet) {
            $get = Yii::$app->request->get();
            $blog_id = $get['blog_id'];

            $blog = Blog::findOne($blog_id)->toArray();
        }
        
        return $this->render('article',[
            'blog' => $blog,
            ]);
    }

    public function actionEditmsg()
    {
        $errmsg = " ";
        $user_id = Yii::$app->user->getId();
        $user = User::findOne($user_id)->toArray();
        
        $model = new EditmsgForm();
        
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->picture = UploadedFile::getInstance($model, 'picture');
        }
        $model->picture = UploadedFile::getInstance($model, 'picture');
        if($model->picture && $model->validate()) {
            $model->picture->saveAs('userimages/' . $model->picture->baseName . '.' . $model->picture->extension);
            $data = Yii::$app->request->post('EditmsgForm');
            $user = User::findOne($user_id);
            $user->first_name = $data['first_name']; $user->last_name = $data['last_name'];
            $user->gender = $data['gender']; $user->birthdate = $data['birthdate'];
            $user->phone = $data['phone']; $user->email = $data['email'];
            $user->city = $data['city']; $user->state = $data['state'];
            $user->picture = $model->picture->name;
            if($user->save()){
                $errmsg =  '<div class="alert alert-success">
                               <a href="#" class="close" data-dismiss="alert">
                                  &times;
                               </a>
                               <strong style="padding:10px;font-size:20px;">个人信息保存成功！</strong>
                            </div>';
            }
            else{
                $errmsg = '<div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert">
                                   &times;
                                </a>
                                <strong style="padding:10px;font-size:20px;">个人信息保存失败！</strong>
                            </div>';
                
            }
            return $this->render('editmsg',[
            'model' => $model,
            'user' => $user,
            'errmsg' => $errmsg,
            ]);
        }
        else{
            if($model->load(Yii::$app->request->post())){
                $errmsg = '<div class="alert alert-danger">
                               <a href="#" class="close" data-dismiss="alert">
                                  &times;
                               </a>
                               <strong style="padding:10px;font-size:20px;">个人信息保存失败！</strong>
                           </div>';
            }
        }
        
        return $this->render('editmsg',[
            'model' => $model,
            'user' => $user,
            'errmsg' => $errmsg,
            ]);
    }

    public function actionEditblog()
    {
        $msg = '';
        $user_id = Yii::$app->user->getId();
        $model = new EditblogForm();
        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
            if($model->validate()){
                $data = Yii::$app->request->post('EditblogForm');
                $blog = new Blog();
                $blog->user_id = $user_id;
                $blog->blog_title = $data['blog_title'];
                $blog->blog_body = $data['blog_body'];
                $blog->blog_create = date("Y-m-d H:i:s");
                $blog->blog_update = date("Y-m-d H:i:s");
                $blog->save();
                $msg =  '<div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert">
                               &times;
                            </a>
                            <strong style="padding:10px;font-size:20px;">编辑博客成功！</strong>
                        </div>';
            }
            else{
                $msg =  '<div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">
                               &times;
                            </a>
                            <strong style="padding:10px;font-size:20px;">编辑博客失败！</strong>
                        </div>';
            }
        }
        
        return $this->render('editblog',[
                'model' => $model,
                'msg' => $msg,
            ]);
    }

    public function actionUpdate()
    {
        $msg = '';
        $model = new EditblogForm();
        if(Yii::$app->request->isGet) {
            $get = Yii::$app->request->get();
            $blog_id = $get['blog_id'];

            $blog = Blog::findOne($blog_id)->toArray();
        
            return $this->render('update',[
                    'model' => $model,
                    'blog' => $blog,
                    'msg' => $msg,
                ]);
        }

        if(Yii::$app->request->isPost && $model->load(Yii::$app->request->post())){
            $data = Yii::$app->request->post('EditblogForm');
            $blog_id = $data['blog_id'];
            $blog = Blog::findOne($blog_id)->toArray();
            
            if($model->validate()){
                /*echo '验证成功,接下来保存数据';*/
                $blog = Blog::findOne($blog_id);
                $blog->blog_title = $data['blog_title'];
                $blog->blog_body = $data['blog_body'];
                $blog->blog_update = date("Y-m-d H:i:s");
                $blog->save();
                $msg = '<div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert">
                               &times;
                            </a>
                            <strong style="padding:10px;font-size:20px;">修改博客成功！</strong>
                        </div>';
            }
            else{
                $msg = '<div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert">
                               &times;
                            </a>
                            <strong style="padding:10px;font-size:20px;">修改博客失败！</strong>
                        </div>';
            }


            return $this->render('update',[
                'model' => $model,
                'blog' => $blog,
                'msg' => $msg,
                ]);
        }
    }
}
