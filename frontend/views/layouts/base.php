<?php

use yii\helpers\Html;

$this->title = 'Events';
$items = [
    1 => 'Select Event',
    2 => 'Number of tables',
    3 => 'Select Date',
    4 => 'Extra items',
    5 => 'Submit Order'
];
?>
<div class="section section-title section-events-title">
    <div class="section-container">
        Events
    </div>
</div>

<div class="section section-events">
    <div class="section-container">
        <div class="events-wrapper">
            <?php
            echo Html::ul($items, [
                'item' => function ($item, $index) use ($scenarioStep) {
                    $liClass = '';
                    if($scenarioStep === $index){
                        $liClass = 'active';
                    } else if($index < $scenarioStep){
                        $liClass = 'pass';
                    } else {
                        $liClass = '';
                    }
                    return "<li class='$liClass'>
                            <div>{$index}</div>
                            <span>{$item}</span>
                        </li>";
                }, 'class' => "events-progress-bar step{$scenarioStep}"
            ]) ?>

            <?= $content ?>
        </div>
    </div>
</div>