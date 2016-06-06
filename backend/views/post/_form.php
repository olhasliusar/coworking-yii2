<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $image common\models\Image */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?
        echo '<label class="control-label">Begin</label>';
        echo DateTimePicker::widget([
        'model' => $model,
        'attribute'=>'beginTime',
        'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
        'value' => '01-Feb-2016 12:35 AM',
        'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'dd-M-yyyy HH:ii P'
        ]
        ]);
    ?>

    <?
        echo '<label class="control-label">End</label>';
        echo DateTimePicker::widget([
            'model' => $model,
            'attribute'=>'endTime',
            'type' => DateTimePicker::TYPE_COMPONENT_PREPEND,
            'value' => '01-Feb-2016 12:35 AM',
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'dd-M-yyyy HH:ii P'
            ]
        ]);
    ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($image, 'imageFile')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
