<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * This is the model class for table "iblog_user".
 *
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $join_date
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $birthdate
 * @property string $city
 * @property string $state
 * @property string $picture
 */
class EditmsgForm extends \yii\db\ActiveRecord
{
    public $first_name;
    public $last_name;
    public $gender;
    public $birthdate;
    public $phone;
    public $email;
    public $city;
    public $state;
    public $picture;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iblog_user';
    }
   
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'gender', 'birthdate', 'city', 'state', 'phone', 'email'], 'required'],
            ['birthdate','match','pattern'=>'/^\d{4}-\d{2}-\d{2}$/','message'=>'{attribute}日期形式必须形如YYYY-MM-DD（如1997-7-11）'],
            ['phone','match','pattern' => '/^(13[0-9]|15[012356789]|17[678]|18[0-9]|14[57])[0-9]{8}$/', 'message' => '{attribute}请输入正确的手机号码'],
            [['first_name', 'last_name', 'city'], 'string', 'max' => 32],
            [['state'], 'string', 'max' => 10],
            [['email'], 'email'],
            [['picture'], 'file', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'username' => 'Username',
            'password' => 'Password',
            'join_date' => 'Join Date',
            'first_name' => '姓',
            'last_name' => '名',
            'gender' => '性别',
            'birthdate' => '出生年月日',
            'phone' => '电话',
            'email' => '邮箱',
            'city' => '城市',
            'state' => '省份',
            'picture' => '照片',
        ];
    }
}
