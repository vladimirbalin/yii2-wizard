<?php

/** @var \yii\web\View $this **/
/** @var string $content **/

use common\widgets\Alert;
use frontend\assets\AppAsset;
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
    <body>
    <?php $this->beginBody() ?>
        <div id="wrapper">
            <?php
                // NavBar::begin([
                //     'brandLabel' => Yii::$app->name,
                //     'brandUrl' => Yii::$app->homeUrl,
                //     'options' => [
                //         'class' => 'navbar-inverse navbar-fixed-top',
                //     ],
                // ]);
                $menuBar = [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'Events', 'url' => '#'],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Blog', 'url' => ['/blog/index']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                ];
                // if (Yii::$app->user->isGuest) {
                //     $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                //     $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                // } else {
                //     $menuItems[] = '<li>'
                //         . Html::beginForm(['/site/logout'], 'post')
                //         . Html::submitButton(
                //             'Logout (' . Yii::$app->user->identity->username . ')',
                //             ['class' => 'btn btn-link logout']
                //         )
                //         . Html::endForm()
                //         . '</li>';
                // }
                // echo Nav::widget([
                //     'options' => ['class' => 'navbar-nav navbar-right'],
                //     'items' => $menuItems,
                // ]);

                // NavBar::end();
            ?>
            <div id="header">
                <div class="header-content">
                    <a href="#mainnavMenu" class="mainnav-button"></a>

                    <ul class="mainnav" id="mainnavMenu">
                        <li><a href="">Home</a></li>
                        <li><a href="">Events</a></li>
                        <li><a href="">Blog</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="">Contact</a></li>
                    </ul>
                    <?php
                        echo Menu::widget([
                            'options' => ['class' => 'mainnav'],
                            'items' => $menuBar,
                        ]);
                    ?>

                    <ul class="user-bar">
                        <li><a href="">Sign In</a></li>
                        <li><a href="">Sign Up</a></li>
                    </ul>
                </div>
            </div>

            <div id="container">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <div id="footer">
            <div class="footer-content">
                <div class="copyright">
                    &copy; 2021
                </div>

                <ul class="mainnav">
                    <li><a href="">Home</a></li>
                    <li><a href="">Events</a></li>
                    <li><a href="">Blog</a></li>
                    <li><a href="">About</a></li>
                    <li><a href="">Contact</a></li>
                </ul>
            </div>
        </div>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>