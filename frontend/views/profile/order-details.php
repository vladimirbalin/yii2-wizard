<?php
/* @var $this yii\web\View */

/** @var frontend\models\EventOrderForm $model */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="section section-profile">
    <div class="section-container">
        <div class="submit-order-wrapper">
            <div class="block-title">
                Your History Order Detail
            </div>

            <ul class="order-details">
                <li>
                    <div class="inner">
                        <div class="order-item">
                            <div class="order-item-inner"><span>Transaction ID:</span> <?= $model->transactionId ?></div>
                        </div>
                    </div>
                </li>
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
                                    <?php foreach ($model->orderItemExtraItems as $item) : ?>
                                        <li>
                                            <div class="order-item">
                                                <div class="order-item-inner">
                                                    <?= "$item->title (" . Yii::$app->formatter->asCurrency($item->price) . " x $item->quantity)" ?>
                                                </div>
                                            </div>
                                            <div class="order-item-price">
                                                <?= Yii::$app->formatter->asCurrency($item->price * $item->quantity) ?>
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
            <div class="list-controls">
                <?= Html::a('Back to Profile', ['profile/']) ?>
                            </div>
            <div class="buttons">
                <?php if($model->transaction_id === null): ?>
                    <a href="" class="btn btn-lg btn-success" data-toggle="modal" data-target="#historyDetailMessage">Submit Transaction ID</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $form = ActiveForm::begin() ?>

<div class="modal fade" tabindex="-1" role="dialog" id="historyDetailMessage">
    <div class="modal-dialog">
        <div class="modal-content">
            <a href="#" class="close-modal" data-dismiss="modal" aria-label="Close"></a>
            <div class="modal-header">
                <h4 class="modal-title">Enter Transaction ID</h4>
            </div>
            <div class="modal-body">
                <div class="transaction-id-form">
                    <div class="form-group">
                        <?= $form->field($model, 'transaction_id')->textInput(['placeholder' => 'Transaction ID'])->label(false) ?>
                    </div>

                    <div class="buttons">
                        <?= Html::submitButton('Submit Order', ['class' => 'btn btn-md btn-success']) ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<?php ActiveForm::end() ?>