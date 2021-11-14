<?php

/** @var \yii\web\View $this **/
/** @var string $content **/

use common\widgets\Alert;
use frontend\assets\AppAsset;
use frontend\controllers\BlogController;
use frontend\controllers\EventController;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="<?= Yii::$app->charset ?>" />
        <?php $this->registerCsrfMetaTags() ?>
        <link rel="apple-touch-icon" sizes="180x180" href="../themes/main/images/favicons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../themes/main/images/favicons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../themes/main/images/favicons/favicon-16x16.png">
        <link rel="manifest" href="../themes/main/images/favicons/site.webmanifest">
        <link rel="mask-icon" href="../themes/main/images/favicons/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="<?= $this->context->bodyClass ?? ''?>">
    <?php $this->beginBody() ?>
        <div id="wrapper">
            <?php
                $menuBar = [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'Events', 'url' => ['/event/select-event'], 'active' => get_class($this->context) === EventController::class],
                    ['label' => 'Blog', 'url' => ['/blog/index'], 'active' => get_class($this->context) === BlogController::class],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                ];
                if (Yii::$app->user->isGuest) {
                    $userBar = [
                        ['label' => 'Sign In', 'url' => ['/site/login']],
                        ['label' => 'Sign Up', 'url' => ['/site/signup']],
                    ];
                    $userBarClass = 'user-bar';
                } else {
                    $logoutBtn = Html::beginForm(['/site/logout'], 'post') . Html::a('Logout <i class="fa fa-sign-out"></i>', '#', ['onclick' => 'this.parentNode.submit()']) . Html::endForm();
                    $userBar = [
                        ['label' => 'My Account', 'url' => ['/profile']],
                        ['label' => $logoutBtn, 'encode' => false],
                    ];
                    $userBarClass = 'user-bar profile';
                }
            ?>
            <div id="header">
                <div class="header-content">
                    <a href="#mainnavMenu" class="mainnav-button"></a>
                    <?php
                        echo Menu::widget([
                            'options' => ['class' => 'mainnav', 'id' => 'mainnavMenu'],
                            'items' => $menuBar,
                        ]);
                        echo Menu::widget([
                            'options' => ['class' => $userBarClass],
                            'items' => $userBar,
                        ]);
                    ?>
                </div>
            </div>

            <div id="container">
                <!-- <?php echo Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?php echo Alert::widget() ?>-->
                <?php echo $content ?> 
            </div>
        </div>

        <div id="footer">
            <div class="footer-content">
                <div class="copyright">
                    &copy; 2021
                </div>

                <?php echo Menu::widget([
                            'options' => ['class' => 'mainnav', 'id' => 'mainnavMenu'],
                            'items' => $menuBar,
                            'activeCssClass' => false
                        ]); 
                ?>
            </div>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>