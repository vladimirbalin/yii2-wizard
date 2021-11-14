<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'username',
                'value' => function($model){
                    return Html::a($model->fullName, Url::to(['user/view', 'id' =>$model->id]));
                },
                'format' => 'raw'
            ],
            'username',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            //'status',
            //'updated_at',
            //'verification_token',
            //'first_name',
            //'last_name',
            //'address',
            'phone',
            'city',
            'created_at:datetime',
        ],
    ]); ?>


</div>
