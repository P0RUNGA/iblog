<?php 

namespace app\models;

class EditblogForm extends \yii\db\ActiveRecord
{
	public $blog_id;
	public $blog_title;
	public $blog_body;
	public $blog_create;
	public $blog_update;

	/**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'iblog_blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['blog_title', 'blog_body'], 'required'],
            [['blog_title'], 'string', 'max' => 64],
            [['blog_body'], 'string', 'max' => 2000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'blog_title' => '博客标题',
            'blog_body' => '博客内容',
        ];
    }
}
 ?>
