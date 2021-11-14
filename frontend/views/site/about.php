<?php

/* @var $this yii\web\View */

use common\models\TextBlock;
use yii\helpers\Html;

$this->title = 'About';
?>
<div class="section section-title section-about-title">
    <div class="section-container">
        About
    </div>
</div>

<div class="section section-content">
    <div class="section-container">
        <div class="section-title">
            Who we are
        </div>

        <div class="section-text">
            <img src="images/about/about1.jpg" alt="" />
            <p>
                <?php echo TextBlock::getTextByShortcut('about1') ?>
            </p>
            <img src="images/about/about2.jpg" alt="" />
            <p>
                <?php echo TextBlock::getTextByShortcut('about2') ?>
            </p>
            <img src="images/about/about3.jpg" alt="" />
            <p>
                <?php echo TextBlock::getTextByShortcut('about3') ?>
            </p>
        </div>
    </div>
</div>