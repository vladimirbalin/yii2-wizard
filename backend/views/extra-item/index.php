<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ExtraItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Extra Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extra-item-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Extra Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [ 
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->title, Url::to(['view', 'id' => $model->id]));
                }
            ],
            'price:currency',
            [
                'attribute' => 'imageUrl',
                'format' => ['image', ['height' => 100]],
            ],
            'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
