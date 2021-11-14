<?php

/** @var yii\web\View $this */
/** @var frontend\models\EventOrderForm $model */
/** @var common\models\Event[] $events */

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

$js = <<<JS
    function fillOrderId(eventId) {
        $("#eventorderform-eventid").val(eventId);
    }
JS;
$this->registerJs($js, View::POS_HEAD);
$this->beginContent('@frontend/views/layouts/base.php', ['scenarioStep' => $model->scenarioStep]); ?>

<ul class="event-category-list">
    <?php foreach ($events as $key => $event) : ?>
        <li onclick='fillOrderId(<?= $event->id ?>)'>
            <div class="img">
                <?= Html::img($event->imageUrl) ?>
            </div>
            <span><?= Html::encode($event->name) ?></span>
        </li>
    <?php endforeach; ?>
</ul>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model, 'eventId')->hiddenInput()->label(false) ?>
<div class="buttons">
    <?= Html::submitButton('Next', ['class' => 'btn btn-lg btn-success']) ?>
</div>
<?php ActiveForm::end();
 $this->endContent(); ?>

</div>
</div>
</div>