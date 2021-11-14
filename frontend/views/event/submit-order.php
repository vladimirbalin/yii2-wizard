<?php
/* @var $this yii\web\View */

/** @var frontend\models\EventOrderForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->beginContent('@frontend/views/layouts/base.php', ['scenarioStep' => $model->scenarioStep]);
?>
    <?php $form = ActiveForm::begin(['action' => ['event/submit-order']]) ?>

<div class="submit-order-wrapper">
    <div class="block-title">
        Your Order Detail
    </div>

    <ul class="order-details">
        <li>
            <div class="inner">
                <div class="order-item">
                    <div class="order-item-inner"><span>Events Name:</span> <?= $model->eventName ?></div>
                </div>
            </div>
        </li>
        <li>
            <div class="inner">
                <div class="order-item">
                    <div class="order-item-inner"><span>Number of Tables:</span> <?= $model->table->fullName ?></div>
                </div>
                <div class="order-item-price">
                    <?= $model->table->priceLabel ?>
                </div>
            </div>
        </li>
        <li>
            <div class="inner">
                <div class="order-item">
                    <div class="order-item-inner"><span>Date:</span> <?= date('M j, Y', strtotime($model->eventDate)) ?></div>
                </div>
            </div>
        </li>
        <?php if ($model->itemsCount) : ?>
            <li>
                <div class="inner <?= $model->itemsCount ? 'extended' : '' ?>">
                    <div class="order-item">
                        <div class="order-item-inner"><span>Extra Items:</span>
                            <?= $model->list
                            ?></div>
                    </div>
                    <div class="order-item-price">
                        <?= Yii::$app->formatter->asCurrency($model->totalExtraItemsPrice) ?>
                    </div>
                </div>

                <div class="extend">
                    <ul>
                        <?php if ($model->itemsCount) : ?>
                            <?php foreach ($model->chosenExtraItemsList as $item) : ?>
                                <li>
                                    <div class="order-item">
                                        <div class="order-item-inner">
                                            <?= $item->extendedInfo ?>
                                        </div>
                                    </div>
                                    <div class="order-item-price">
                                        <?= Yii::$app->formatter->asCurrency($item->fullPrice) ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
        <?php endif; ?>
        <li class="total">
            <div class="inner">
                <div class="order-item">
                    <div class="order-item-inner">
                        Total
                    </div>
                </div>
                <div class="order-item-price">
                    <?= $model->totalPriceLabel ?>
                </div>
            </div>
        </li>
    </ul>

    <?= $form->field($model, 'eventId')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'tableId')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'eventDate')->hiddenInput()->label(false) ?>
    <?php foreach ($model->extraItemForms as $index => $extraItemForm) : ?>
        <?= $form->field($extraItemForm, "[$index]id")->hiddenInput()->label(false) ?>
        <?= $form->field($extraItemForm, "[$index]quantity")->hiddenInput()->label(false) ?>
    <?php endforeach; ?>
    <div class="buttons">
        <?= Html::submitButton('Submit Order', ['class' => 'btn btn-lg btn-success']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
<?php $this->endContent();?>