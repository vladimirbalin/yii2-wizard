<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/** @var \frontend\models\SignupForm $model **/

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Sign Up';
?>
<div class="section section-title section-signup-title">
    <div class="section-container">
        <?= Html::encode($this->title) ?>
    </div>
</div>

<div class="section section-signup">
    <div class="section-container">

        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['class' => 'form-wrapper register-form']]); ?>

            <?= $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(false) ?>
            <?= $form->field($model, 'email')->textInput(['placeholder' => $model->getAttributeLabel('email')])->label(false) ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false) ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'first_name')->textInput(['placeholder' => $model->getAttributeLabel('first_name')])->label(false) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'last_name')->textInput(['placeholder' => $model->getAttributeLabel('last_name')])->label(false) ?>
                </div>
            </div>
            <?= $form->field($model, 'address')->textInput(['placeholder' => $model->getAttributeLabel('address')])->label(false) ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'city')->textInput(['placeholder' => $model->getAttributeLabel('city')])->label(false) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'phone')->textInput(['placeholder' => $model->getAttributeLabel('phone')])->label(false) ?>
                </div>
            </div>
            <div class="buttons">
                <?= Html::submitButton('Sign Up', ['class' => 'btn btn-lg btn-success', 'name' => 'signup-button']) ?>
            </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>