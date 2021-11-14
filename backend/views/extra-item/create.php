<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ExtraItem */

$this->title = 'Create Extra Item';
$this->params['breadcrumbs'][] = ['label' => 'Extra Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extra-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
