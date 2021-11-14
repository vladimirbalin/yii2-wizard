<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="row">
    <div class="col">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
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
        
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success center-block']) ?>
        </div>
    </div>
   
</div>
<?php ActiveForm::end(); ?>