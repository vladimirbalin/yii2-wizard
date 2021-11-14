<?php

use kartik\number\NumberControl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ExtraItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="extra-item-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price')->widget(NumberControl::class, [
                'maskedInputOptions' => [
                    'prefix' => '$ ',
                    'allowMinus' => false,
                    'rightAlign' => false
                ]
            ]); ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'image')->widget(\kartik\file\FileInput::class, [
                'options' => [
                    'accept' => 'image/*',
                    'multiple' => false
                ],
                'pluginOptions' => [
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false,
                    'showClose' => false,
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'Select Photo',
                    'initialPreview' => $model->image ? $model->imageUrl : false,
                    'initialPreviewAsData' => true,
                    'initialPreviewConfig' => $model->image ? [['caption' => $model->image]] : [],
                    'layoutTemplates' => ['actionDelete' => '', 'actionDrag' => '']
                ]
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success center-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>