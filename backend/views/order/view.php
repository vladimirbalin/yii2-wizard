<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\Order */

/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">
    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-md-6">
        <h2><?= $model->eventName ?></h2>
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'customer.FullName:text:Customer',
                'totalPrice:currency:Price',
                [
                    'attribute' => 'status',
                    'value' => function ($model) use ($form) {
                        return $form->field($model, 'status')->dropDownList($model->statusList, ['prompt' => 'All'])->label(false);
                    },
                    'format' => 'raw'
                ],
                [
                    'attribute' => 'event_date',
                    'format' => ['date', 'php:M j, Y']
                ],
                'transaction_id',
                [
                    'attribute' => 'created_at',
                    'format' => 'datetime'
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => 'datetime'
                ],

                ['attribute' => 'Table',
                    'value' => function($model){
            return $model->table->fullName . " " .$model->table->priceLabel;
                    }],
            ],
        ]) ?>
    </div>
    <div class="col-md-6">
        <h2><?= $model->customer->fullName ?></h2>
        <?= DetailView::widget([
            'model' => $model->customer,
            'attributes' => [
                'id',
                'first_name',
                'last_name',
                'phone',
                'email',
                'city',
                'address',
                [
                    'attribute' => 'created_at',
                    'format' => 'datetime'
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => 'datetime'
                ],
            ],
        ]) ?>
    </div>
</div>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <h2>Order Items</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            'price:currency',
            'quantity',
            [
                'attribute'=>'extraItem.wizardListUrl',
                'format' => ['image', ['height' => 50]],
            ]
        ]
    ]) ?>
</div>