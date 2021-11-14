<?php

namespace frontend\models;

use common\models\ExtraItem;
use Yii;

/**
 * Class ExtraItemForm
 */
class ExtraItemForm extends ExtraItem
{
    public $quantity = 0;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'quantity'], 'required'],
            ['id', 'integer'],
            ['quantity', 'integer', 'min' => 0]
        ];
    }

    public function getTitleWithCount()
    {
        return "$this->quantity $this->title";
    }
    public function getExtendedInfo()
    {
        return "$this->title (" . Yii::$app->formatter->asCurrency($this->price) . " x $this->quantity)";
    }
    public function getFullPrice()
    {
        return $this->price * $this->quantity;
    }
}
