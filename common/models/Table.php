<?php

namespace common\models;

use Symfony\Component\Console\Helper\FormatterHelper;
use Yii;

/**
 * This is the model class for table "table".
 *
 * @property int $id
 * @property string $title
 * @property string|null $subtitle
 * @property float $price
 * @property int $is_custom
 */
class Table extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'table';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'price'], 'required'],
            [['price'], 'number'],
            [['is_custom'], 'integer'],
            [['title', 'subtitle'], 'string', 'max' => 255],
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
            'subtitle' => 'Subtitle',
            'price' => 'Price',
            'is_custom' => 'Is Custom',
        ];
    }

    public function getPriceLabel(){
        return Yii::$app->formatter->asCurrency($this->price);
    }
    public function getFullName()
    {
        return "$this->title $this->subtitle";
    }
}
