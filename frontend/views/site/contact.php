<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm; 
$this->title = 'Contact';
?>
<div class="section section-title section-contact-title">
    <div class="section-container">
        <?= Html::encode($this->title) ?>
    </div>
</div>

<div class="section section-contact">
    <div class="section-container">
        <div class="section-title">
            Let’s get in touch with us
        </div>
        <div class="section-description">
            We reply as fast as light do
        </div>

            <?php $form = ActiveForm::begin(['options' => ['class' => 'form-wrapper contact-form']]); ?>
            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Full Name'])->label(false) ?>
            <div class="row">
                <div class="col-sm-7">
                    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Email'])->label(false) ?>
                </div>
                <div class="col-sm-5">
                    <div class="form-group required">
                        <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject'])->label(false) ?>
                    </div>
                </div>
            </div>
            <?= $form->field($model, 'body')->textarea(['placeholder' => 'Message', 'cols' => 30, 'rows' => 10])->label(false) ?>
            <div class="buttons">
                <?= Html::submitButton('Send', ['class' => 'btn btn-lg btn-success']) ?>
            </div>
            <?php ActiveForm::end(); ?>
    </div>
</div>
</div>