<?php

/**
 * @var \common\models\User $model
 */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Profile Page';
?>
<div class="section section-profile">
    <div class="section-container">
        <div class="profile-block">
            <?= Html::a('Edit Profile', ['profile/edit'], ['class' => "btn btn btn-view pull-right"]) ?>
            <div class="block-title">User Detail</div>

            <ul class="user-details">
                <li><span>Name:</span> <?= $model->getFullName() ?></li>
                <li><span>Address:</span> <?= $model->getFullAddress() ?></li>
                <li><span>Phone:</span> <?= $model->phone ?></li>
                <li><span>Email:</span> <?= $model->email ?></li>
            </ul>
        </div>

        <div class="profile-block">
            <div class="block-title">Purchase History</div>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn', 'header' => 'No.'],
                    'eventName:raw:Item',
                    [
                        'header' => 'Date',
                        'attribute' => 'created_at',
                        'format' => ['date', 'php:M j, Y'],
                    ],
                    'totalPriceLabel:raw:Price',
                    [
                        'attribute' => 'Status', 'label' => '',
                        'content' => function ($data) {
                            switch ($data->status) {
                                case 0:
                                    return '<div class="purchase-status pending">Payment Pending</div>';
                                    break;
                                case 1:
                                    return '<div class="purchase-status pending">Payment Verification Pending</div>';
                                    break;
                                case 2:
                                    return '<div class="purchase-status proccessing">Processing Order</div>';
                                    break;
                                case 3:
                                    return '<div class="purchase-status complete">Complete</div>';
                                    break;
                            }
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'buttons' =>
                        [
                            'view' => function ($url, $model, $key) {
                                return Html::a('View', Url::to(['profile/order-details', 'id' => $model->id ]), ['class' => 'btn-view']); //use Url::to() in order to change $url
                            },

                        ],
                        'template' => '{view}',
                    ],
                ],
                'tableOptions' => ['class' => 'table table-striped table-history'],
                'layout' => '{items}'
            ]); ?>
        </div>
    </div>
</div>