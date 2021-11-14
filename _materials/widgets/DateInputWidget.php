<?php

namespace frontend\widgets;

use yii\helpers\BaseHtml;
use yii\widgets\InputWidget;

/**
 * Class DateInputWidget
 *
 * Example of usage:
 * ```php
 * <?= $form->field($model, 'date')->widget(DateInputWidget::class, [
 *     'monthsCount' => 10, // calendar months cards count
 * ]) ?>
 * ```
 */
class DateInputWidget extends InputWidget
{
    /**
     * @var int
     */
    public $monthsCount = 12;

    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $inputName = $this->model ? BaseHtml::getInputName($this->model, $this->attribute) : $this->name;
        // @see BaseHtml::getInputId
        $inputId = $this->model ? BaseHtml::getInputId($this->model, $this->attribute) : str_replace(['[]', '][', '[', ']', ' ', '.'], ['', '-', '-', '', '-', '-'], $inputName);

        echo $this->getView()->renderFile(
            '@frontend/widgets/views/date-input.php',
            [
                'inputName' => $inputName,
                'inputId' => $inputId,
                'monthsCount' => $this->monthsCount
            ]
        );
    }
}
