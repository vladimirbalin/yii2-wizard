<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property int $author_id
 * @property string $title
 * @property string $body
 * @property string $created_at
 * @property int $readTimeLabel
 *
 * @property User $author
 */
class Post extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
                'value' => new Expression('NOW()'),
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id'], 'default', 'value' => Yii::$app->user->id],
            [['author_id', 'title', 'body'], 'required'],
            [['author_id'], 'integer'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'author_id' => 'Author ID',
            'title' => 'Title',
            'body' => 'Body',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Author]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::class, ['id' => 'author_id']);
    }

    public function getReadTimeLabel()
    {
        $countWords = yii\helpers\StringHelper::countWords($this->body);
        $readTime = $countWords / 265;
        $roundedReadTime = round($readTime);
        if($roundedReadTime <= 1){
            return 'about a minute read';
        }
        return $roundedReadTime . ' min. read';
    }

    public function getFullTitle()
    {
        $createdAtTimestamp = strtotime($this->created_at);
        $readableDate = date('j.m.Y', $createdAtTimestamp);

        $firstName = $this->author->first_name; 
        $lastName = $this->author->last_name; 
        if($firstName && $lastName){
            return  "$firstName $lastName · $readableDate · {$this->readTimeLabel}";
        }
        return  "{$this->author->username} · $readableDate · {$this->readTimeLabel}";
    }

}
