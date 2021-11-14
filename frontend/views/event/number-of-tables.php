<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/** @var frontend\models\EventOrderForm $model */
/** @var common\models\Table[] $tables */

$js = <<<JS
    function fillTableId(tableId) {
        $("#eventorderform-tableid").val(tableId);
    }
JS;
$this->registerJs($js, View::POS_HEAD);
$this->beginContent('@frontend/views/layouts/base.php', ['scenarioStep' => $model->scenarioStep]); ?>

<ul class="tables-count-list">

    <?php foreach ($tables as $table) : ?>
        <li onclick="fillTableId(<?= $table->id ?>)">
            <div class="inner">
                <div class="num"><?= $table->title ?></div>
                <span><?= $table->subtitle ?></span>
                <?php if ($table->is_custom) : ?>
                    <a href="<?= Url::to(['site/contact']) ?>">Contact Us</a>
                <?php endif; ?>

            </div>
        </li>
    <?php endforeach; ?>
</ul>
<?php $form = ActiveForm::begin(['action' => ['event/number-of-tables']]); ?>
<?= $form->field($model, 'eventId')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'tableId')->hiddenInput()->label(false) ?>

<div class="buttons">
    <?= Html::submitButton('Next', ['class' => 'btn btn-lg btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
<?php $this->endContent(); ?>