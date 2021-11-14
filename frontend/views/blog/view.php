<?php

/** @var yii\web\View $this **/

use yii\helpers\Html;

/** @var @app|common|models|Post $model **/
$this->title = 'Post';
?>

<div class="blog-view">
    <h1></h1>
    <h5></h5>
    <p></p>
</div>

<div class="section section-content">
    <div class="section-container">
        <div class="section-title">
            <?= Html::encode($model->title) ?>
        </div>
        <div class="section-text">
            <h5><?= $model->fullTitle ?></h5>
            <?= Html::encode($model->body) ?>
        </div>
    </div>
</div>