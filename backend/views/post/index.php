<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Full Name',
                'value' => function ($model) {
                    return $model->author->getFullName();
                }
            ],
            [
                'attribute' => 'title',
                'format' => 'raw',

                'value' => function ($model) {
                    return Html::a($model->title, Url::to(['view', 'id' => $model->id]));
                }
            ],
            [
                'attribute' => 'body',
                'value' => function ($model) {
                    return StringHelper::truncate($model->body, 200);
                }
            ],
            'created_at',

            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ]); ?>


</div>