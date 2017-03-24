<?php ///[Yii2 article]

/**
 * Yii2 article
 *
 * @link        http://www.brainbook.cc
 * @see         https://github.com/yongtiger/yii2-article
 * @author      Tiger Yong <tigeryang.brainbook@outlook.com>
 * @copyright   Copyright (c) 2017 BrainBook.CC
 * @license     http://opensource.org/licenses/MIT
 */

namespace yongtiger\article\models;

use Yii;
use yii\db\ActiveRecord;
///[yii2-brainblog_v0.10.0_f0.9.3_post_comment]TimestampBehavior、BlameableBehavior
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property integer $post_id
 * @property string $text
 * @property integer $user_id
 * @property integer $top
 * @property integer $vote
 * @property integer $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Comment $parent
 * @property Comment[] $comments
 * @property Post $post
 * @property User $user
 */
class Comment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_comment}}';
    }

    ///[yii2-brainblog_v0.10.0_f0.9.3_post_comment]TimestampBehavior、BlameableBehavior
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
            ],
        ];
    }
    ///[http://www.brainbook.cc]

    /**
     * @inheritdoc
     */
    public function rules()
    {
        ///[yii2-brainblog_v0.10.0_f0.9.3_post_comment]TimestampBehavior、BlameableBehavior
        return [
            ///[['parent_id', 'post_id', 'user_id', 'top', 'hot', 'status'], 'integer'],
            [['parent_id', 'post_id', 'top', 'hot', 'status'], 'integer'],
            ///[['text', 'created_at', 'updated_at'], 'required'],
            [['text'], 'required'],
            [['text'], 'string'],
            //[['created_at', 'updated_at'], 'safe'],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['parent_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            //[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Yii::$app->getUser()->identityClass, 'targetAttribute' => ['user_id' => 'id']],
        ];
        ///[http://www.brainbook.cc]
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'post_id' => 'Post ID',
            'text' => 'Text',
            'user_id' => 'User ID',
            'top' => 'Top',
            'hot' => 'Hot',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Yii::$app->getUser()->identityClass, ['id' => 'user_id']);
    }
}
///[http://www.brainbook.cc]