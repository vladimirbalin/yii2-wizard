<?php

/**
 * @var \common\models\User $model
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Edit Profile';
?>

<div class="section section-profile">
    <div class="section-container">
        <div class="profile-edit-wrapper">
            <div class="block-title">
                <?= $this->title ?>
            </div>
            <?php $form = ActiveForm::begin(['id' => 'form-profile-edit', 'options' => ['class' => 'form-wrapper']]) ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'first_name')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'last_name')->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'city')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'address')->textInput() ?>
                </div>
            </div>
            <?= $form->field($model, 'phone')->textInput() ?>
            <div class="buttons">
                <?= Html::submitButton('Save', ['class' => 'btn btn-lg btn-success', 'name' => 'profile-edit-button']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>