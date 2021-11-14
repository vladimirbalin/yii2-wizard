<?php

namespace common\models;

use mohorev\file\UploadBehavior;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string $name
 * @property string $image
 * @property string $imageUrl
 * 
 * @method getUploadUrl($attribute) - Returns file url for the attribute. @see mohorev\file\UploadBehavior
 */
class Event extends \yii\db\ActiveRecord
{
    const SCENARIO_IMG_INSERT = 'img-insert';
    const SCENARIO_IMG_UPDATE = 'img-update';
     /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] =
            [
                'class' => UploadBehavior::class,
                'attribute' => 'image',
                'scenarios' => [self::SCENARIO_IMG_INSERT, self::SCENARIO_IMG_UPDATE],
                'path' => '@frontend/web/upload/event/{id}',
                'url' => '@frontendUrl/upload/event/{id}',
            ];
        return $behaviors;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [
                'image', 'image', 'extensions' => 'jpg, jpeg, png', 
                'on' => [self::SCENARIO_IMG_INSERT, self::SCENARIO_IMG_UPDATE],
                'minWidth' => 240,
                'maxWidth' => 240,
                'minHeight' => 282,
                'maxHeight' => 282,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'image' => 'Image',
        ];
    }

    public function getImageUrl()
    {
        return $this->getUploadUrl('image');
    }
}
