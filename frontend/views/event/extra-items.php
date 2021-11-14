<?php

/** @var yii\web\View $this */
/** @var frontend\models\EventOrderForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var frontend\models\EventOrderForm $model */
$this->beginContent('@frontend/views/layouts/base.php', ['scenarioStep' => $model->scenarioStep]);
$form = ActiveForm::begin(['action' => ['event/extra-items']]);
?>

<ul class="extra-items-list">
    <?php foreach ($model->extraItemForms as $item) : ?>
        <li>
            <div class="inner">
                <div class="img"><?= Html::img($item->wizardListUrl) ?></div>
                <span><?= $item->title ?></span><span class="price">$<?= $item->price ?></span>

                <div class="buttons"><a href="#" data-toggle="modal" data-target="#extraItemsDetail<?= $item->id ?>">Detail</a></div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

<?= $form->field($model, 'eventId')->hiddenInput()->label(false) ?>

<?= $form->field($model, 'tableId')->hiddenInput()->label(false) ?>

<?= $form->field($model, 'eventDate')->hiddenInput()->label(false) ?>

<div class="buttons">
    <?= Html::submitButton('Next', ['class' => 'btn btn-lg btn-success']) ?>

</div>

<?php foreach ($model->extraItemForms as $index => $extraItemForm) : ?>
    <div class="modal fade modal-presentation" tabindex="-1" role="dialog" id="extraItemsDetail<?= $extraItemForm->id ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <a href="#" class="close-modal" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="presentation-wrapper">
                        <div class="img">
                            <?= Html::img($extraItemForm->wizardModalDesktop, ['class' => "desktop-image"]) ?>
                            <?= Html::img($extraItemForm->wizardModalMobile, ['class' => "mobile-image"]) ?>
                        </div>

                        <div class="description-wrapper">
                            <div class="description-container">
                                <div class="header">
                                    <div class="title">
                                        <?= $extraItemForm->title ?>
                                    </div>

                                    <div class="controls">
                                        <div class="price">
                                            $<?= $extraItemForm->price ?>
                                        </div>

                                        <div class="form-group">

                                            <?= $form->field($extraItemForm, "[$index]id")->textInput(['readonly' => true])->label(false) ?>
                                            <?php $plusBtn = '<a href="#" class="control-button plus"></a>';
                                                    $minusBtn = '<a href="#" class="control-button minus"></a>' ?>
                                            <?= $form->field($extraItemForm, "[$index]quantity", [
                                                'template' => "{label}\n{input}\n$plusBtn\n$minusBtn{hint}\n{error}"
                                            ])->textInput(['readonly' => true])->label(false) ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="description">
                                    <div class="title">Description</div>

                                    <div class="content">
                                        <p>
                                            <?= $item->description ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php endforeach; ?>
<?php ActiveForm::end() ?>
<?php $this->endContent() ?>