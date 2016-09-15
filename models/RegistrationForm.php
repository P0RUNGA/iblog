<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RegistrationForm extends Model
{
    public $username;
    public $password1;
    public $password2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password1', 'password2'], 'required'],
            [['username'], 'string', 'max' => 20],
            [['password1'], 'string', 'max' => 16],
            [['password2'], 'string', 'max' => 16],
            ['password2', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'password1' => '密码',
            'password2' => '密码2',
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if($this->password1 != $this->password2){
            $this->addError($attribute, '两次输入的密码不一致');
        }
    }
}
