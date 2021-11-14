<?php
/** @var yii\web\View $this */
/** @var frontend\models\EventOrderForm $model */

use frontend\widgets\DateInputWidget;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$this->beginContent('@frontend/views/layouts/base.php', ['scenarioStep' => $model->scenarioStep]);
?>
<?php $form = ActiveForm::begin(['action' => ['event/select-date']]) ?>
<?= $form->field($model, 'eventDate')->widget(DateInputWidget::class, [
    'monthsCount' => 10, // calendar months cards count
])->label(false) ?>
<div class="buttons">
    <?= Html::submitButton('Next', ['class' => 'btn btn-lg btn-success']) ?>
</div>

<?= $form->field($model, 'eventId')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'tableId')->hiddenInput()->label(false) ?>

<?php $form = ActiveForm::end() ?>

<?php $this->endContent(); ?>