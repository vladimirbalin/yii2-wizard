<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="section section-title section-error-title">
            <div class="section-container">
                <?= nl2br(Html::encode($name)) ?>
            </div>
        </div>

        <div class="section section-error">
            <div class="section-container">
                <h2><?= nl2br(Html::encode($message)) ?></h2>
            </div>
        </div>
