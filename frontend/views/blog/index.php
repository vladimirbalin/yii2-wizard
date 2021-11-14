<?php

/** @var  yii\web\View $this **/
/** @var  @app|common|models\Post $model **/

use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

$this->title = 'Blog';
?>


<div class="section section-title section-blog-title">
    <div class="section-container">
        <?php echo "<h1>" . Html::encode($this->title) . "</h1>"; ?>
    </div>
</div>

<div class="section section-content">
    <div class="section-container">
        <div class="section-title">
            Latest posts
        </div>
        <div class="section-text">
            <?php 
            $lastKey = array_key_last($model);
            foreach ($model as $key => $post) : ?>
                <div class="media">
                    <div class="media-body">
                        <a href="<?= Url::to(["blog/view", 'id' => $post->id]) ?>">
                            <h4 class="media-heading"><?= Html::encode($post->title) ?></h4>
                        </a>
                        <h6><?= $post->fullTitle ?></h6>
                        <?= Html::encode(StringHelper::truncate($post->body, 500)) ?>
                    </div>
                </div>
                <?php if ($key !== $lastKey) : ?>
                    <hr>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>