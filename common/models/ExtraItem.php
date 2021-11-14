<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "extra_item".
 *
 * @property int $id
 * @property string $title
 * @property float $price
 * @property string $image
 * @property string $description
 * 
 * @method getUploadUrl($attribute) - Returns file url for the attribute. @see mohorev\file\UploadBehavior
 * @method  getThumbUploadUrl($attribute, $profile = 'thumb') - Returns thumb url @see mohorev\file\UploadBehavior
 * 
 */
class ExtraItem extends \yii\db\ActiveRecord
{
    const SCENARIO_IMG_UPDATE = 'scenario-update';
    const SCENARIO_IMG_INSERT = 'scenario-insert';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] =   [
            'class' => \mohorev\file\UploadImageBehavior::class,
            'attribute' => 'image',
            'scenarios' => [self::SCENARIO_IMG_INSERT, self::SCENARIO_IMG_UPDATE],
            'path' => '@frontend/web/upload/extra-item/{id}',
            'url' => '@frontendUrl/upload/extra-item/{id}',
            'thumbs' => [
                'wizard-list' => ['width' => 240, 'height' => 282, 'mode' => \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND],
                'wizard-modal-desktop' => ['width' => 483, 'height' => 789, 'mode' => \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND],
                'wizard-modal-mobile' => ['width' => 600, 'height' => 483, 'mode' => \Imagine\Image\ManipulatorInterface::THUMBNAIL_OUTBOUND]
            ],
        ];
        return $behaviors;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'extra_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'price', 'description'], 'required'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [
                'image', 'image', 'extensions' => 'jpg, jpeg, png',
                'on' => [self::SCENARIO_IMG_INSERT, self::SCENARIO_IMG_UPDATE],
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
            'title' => 'Title',
            'price' => 'Price',
            'image' => 'Image',
            'description' => 'Description',
        ];
    }
    public function getImageUrl()
    {
        return $this->getUploadUrl('image');
    }

    public function getWizardListUrl($thumbName = 'wizard-list')
    {
        return $this->getThumbUploadUrl('image', $thumbName);
    }
    public function getWizardModalDesktop($thumbName = 'wizard-modal-desktop')
    {
        return $this->getThumbUploadUrl('image', $thumbName);
    }
    public function getWizardModalMobile($thumbName = 'wizard-modal-mobile')
    {
        return $this->getThumbUploadUrl('image', $thumbName);
    }
}
