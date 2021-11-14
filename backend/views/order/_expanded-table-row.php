
<?php //echo "<pre>";
//print_r($model);
//echo "</pre>";
//exit; ?>
<h2><?= $model->eventName ?></h2>
<p>Total price: <?= $model->totalPriceLabel ?></p>
<p><?= $model->table->title ?> for <?= $model->table->priceLabel ?></p>
<?php foreach($model->orderItemExtraItems as $item): ?>
    <p>- <?= $item->title ?></p>
<?php endforeach; ?>
<span>---- for:</span>
<p><?= Yii::$app->formatter->asCurrency($model->totalExtraItemsPrice) ?></p>