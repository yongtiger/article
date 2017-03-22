<?php

namespace frontend\models;
use creocoder\taggable\TaggableQueryBehavior;   ///[yii2-brainblog_v0.4.1_f0.3.3_tag]creocoder/yii2-taggable

/**
 * This is the ActiveQuery class for [[Post]].
 *
 * @see Post
 */
class PostQuery extends \yii\db\ActiveQuery
{
    ///[yii2-brainblog_v0.4.1_f0.3.3_tag]creocoder/yii2-taggable
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::className(),
        ];
    }
    ///[http://www.brainbook.cc]

    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Post[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Post|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}