<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TableSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tables';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="table-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'title',
            'format' => 'raw',
            'value' => function($model){
                return Html::a($model->title, Url::to(['view', 'id' => $model->id]));
            }
        ],
            'subtitle',
            'price:currency',
            'is_custom:boolean',

            ['class' => 'yii\grid\ActionColumn',
        
            'buttons'=> ['delete' => false],
            'template' => '{view} {update}',],
        ],
    ]); ?>


</div>
