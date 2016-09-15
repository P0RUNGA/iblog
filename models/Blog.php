<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "iblog_blog".
 *
 * @property integer $blog_id
 * @property integer $user_id
 * @property string $blog_title
 * @property string $blog_body
 * @property string $blog_create
 * @property string $blog_update
 */
class Blog extends \yii\db\ActiveRecord
{
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
            [['user_id'], 'integer'],
            [['blog_create', 'blog_update'], 'safe'],
            [['blog_title'], 'string', 'max' => 64],
            [['blog_body'], 'string', 'max' => 1500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'blog_id' => 'Blog ID',
            'user_id' => 'User ID',
            'blog_title' => 'Blog Title',
            'blog_body' => 'Blog Body',
            'blog_create' => 'Blog Create',
            'blog_update' => 'Blog Update',
        ];
    }
}