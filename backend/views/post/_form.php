<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\datetime\DateTimePicker;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $image common\models\Image */
/* @var $form yii\widgets\ActiveForm */
?>

<!--<script>-->
<!--    $(function () {-->
<!--        $(document).on('click', '.remove-user-profile', function () {-->
<!--            var id = $(this).attr('data-userid');-->
<!--            $(this).attr('disabled', true);-->
<!--            $.ajax({-->
<!--                url: "--><?php //echo Url::to(['user/delete-profile-image']); ?><!--//",
//                type: "POST",
//                data: {'user_id': id},
//                success: function () {
//                    $('.profile-container').html('<img class="master-image" src="../frontend/web/images/face.png">');
//                }
//            });
//            return false;
//        });
//    });
//</script>-->

<!--<script>-->
<!--    $(function () {-->
<!--        $(document).on('click', '.remove-order-image', function () {-->
<!--            var id = $(this).attr('data-id');-->
<!--            $(this).attr('disabled', true);-->
<!--            $.ajax({-->
<!--                url: "--><?php //echo Url::to(['delete-order-image']);?><!--",
//                type: "POST",
//                data: {'image_id': id},
//                success: function (response) {
//                    $('#old-order-images').html(response);
//                }
//            });
//            return false;
//        });
//    })
//</script>
-->

<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!! BACKEND/ASSETS/APPASET.PHP
public $jsOptions = ['position' => \yii\web\View::POS_HEAD];-->

<script>
    $(function () {
        $(document).on('click', '.btn-img-del', function () {
            var id = $(this).data('id'); //post 'id'
            console.log(id);
            $(this).attr('disabled', true);
            $.ajax({
                type: "POST",
                url: "<?php echo Url::to(['image-del']); ?>",
//                url: "<?php //echo Url::to(['post/image-del']); ?>//", NAME OF ACTION
                data: {'id': id},
                success: function () {
                    $.pjax.reload({container: '#img-pjax', "timeout" : 1000});
                }
            });
            return false;
        });

    });
</script>

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

    <?php \yii\widgets\Pjax::begin([
        'options' => [
            'class' => 'pjax-wrapper'
        ],
        'id' => 'img-pjax',
        'timeout' => 10000
    ]);
    ?>

    <?= Html::img($model->imageURL, ['width' => '200px']) ?>

<!--    --><?//= Html::a('X', ['post/imagedel'],  ['class' => 'btn btn-primary btn-img-del']) ?>
    <div class="btn btn-primary btn-img-del" data-id="<?= $model->id; ?>">X</div>

    <?php Pjax::end(); ?>

    <?= $form->field($image, 'imageFile')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

