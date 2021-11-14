<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "text_block".
 *
 * @property string $shortcut
 * @property string|null $text
 */
class TextBlock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'text_block';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['shortcut'], 'required'],
            [['text'], 'string'],
            [['shortcut'], 'string', 'max' => 255],
            [['shortcut'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'shortcut' => 'Shortcut',
            'text' => 'Text',
        ];
    }

    /**
     * @param string $shortcut
     * @return string
     */
    public static function getTextByShortcut($shortcut)
    {
        /**
         * @var TextBlock $model
         */
        $model = self::find()->andWhere(['shortcut' => $shortcut])->one();
        if (!$model) {
            Yii::error("Text for shortcut {$shortcut} wasn't found");
            return '';
        }
        return $model->text;
    }
}
