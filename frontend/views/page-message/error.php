<?php

/**
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
?>
<div class="section section-title section-error-title">
    <div class="section-container">
        <?= Html::encode($this->title) ?>
    </div>
</div>

<div class="section section-error">
    <div class="section-container">
        <h2>
            <?= Html::encode($this->description) ?>
        </h2>
    </div>
</div>