<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TextBlock */

$this->title = 'Update Text Block: ' . $model->shortcut;
$this->params['breadcrumbs'][] = ['label' => 'Text Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->shortcut, 'url' => ['view', 'id' => $model->shortcut]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="text-block-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
