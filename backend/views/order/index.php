<?php

use common\models\Event;
use common\models\User;
use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var common\models\OrderSearch $searchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => \kartik\grid\ExpandRowColumn::class,
                'format' => 'html',
                'value' => function ($model, $key, $index, $column) {
                    return \kartik\grid\GridView::ROW_COLLAPSED;
                },
                'detail' => function ($model, $key, $index, $column) {
                    /** @var \yii\web\View $this */
    
                    return $this->renderFile('@backend/views/order/_expanded-table-row.php', ['model' => $model]);
                },
                'headerOptions' => ['class' => 'kartik-sheet-style'],
                'expandOneOnly' => true,
                'expandIcon' => '<i class="glyphicon glyphicon-menu-right"></i>',
                'collapseIcon' => '<i class="glyphicon glyphicon-menu-down"></i>'
            ],
            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:10px'],
            ],
            [
                'attribute' => 'eventName',
                'format' => 'html',
                'value' => function ($order) {
                    return Html::a($order->eventName, Url::to(['order/view', 'id' => $order->id]));
                },
                'label' => 'Event'
            ],
            [
                'attribute' => 'customer.fullName',
                'label' => 'Customer',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'customer_id',
                    $searchModel->customerList,
                    [
                        'class' => 'form-control',
                        'prompt' => 'All'
                    ]
                )
            ],
            [
                'attribute' => 'totalPriceLabel',
                'label' => 'Price'
            ],
            [
                'attribute' => 'status',
                'format' => function ($data) use ($searchModel) {
                    return $searchModel->statusList[$data];
                },
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    $searchModel->statusList,
                    [
                        'class' => 'form-control',
                        'prompt' => 'All'
                    ]
                ),
                'header' => 'Status'
            ],

            [
                'attribute' => 'eventDate',
                'filter' => kartik\daterange\DateRangePicker::widget([
                    'model' => $searchModel,
                    'attribute' => 'eventDateRange',
                    'convertFormat' => true,
                    'startAttribute' => 'eventDateStart',
                    'endAttribute' => 'eventDateEnd',
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y-m-d'],
                    ],
                    'options' => [
                        'placeholder' => 'Select range...',
                        'class' => 'form-control'
                    ]
                ]),
                'options' => [
                    'width' => 220,
                ],
            ],
            //'transaction_id',
            ['attribute' => 'created_at', 'filter' => false],
            //'updated_at',
        ],
    ]); ?>


</div>