<?php

/** @var yii\web\View $this **/
/** @var yii\bootstrap\ActiveForm $form **/
/** @var \common\models\LoginForm  $model **/

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Sign In';
?>
<div class="section section-title section-signin-title">
    <div class="section-container">
        <?= Html::encode($this->title) ?>
    </div>
</div>
<div class="section section-signin">
    <div class="section-container">
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'form-wrapper login-form']]); ?>
        <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(false) ?>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>


        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
        </div>
        <div class="buttons">
            <?= Html::submitButton('Sign In', ['class' => 'btn btn-lg btn-success', 'name' => 'login-button']) ?>
        </div>
        
        <div class="reg-link">Didn't have an account yet? <a href="<?= Url::to(['site/signup'])?>">Register Here</a></div>
        <?php ActiveForm::end(); ?>
    </div>
</div>