<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
//            'user_id',
            [
                'attribute' => 'user fullname',
                'format' => 'html',
                'value' => $model->user->fullname
            ],
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' =>  Html::img($model->image->urlPath, ['width' => '100px'])
            ],
            'title',
            'text',
            'begin',
            'end',
            'cost',
            'status',
//            'updated_by',
//            'updated_at',
//            'created_at',
//            'created_by',

            [
                'attribute' => 'updated_by',
                'format' => 'html',
                'value' => $model->userUpdate->username
            ],
            'updated_at',
            [
                'attribute' => 'created_by',
                'format' => 'html',
                'value' => $model->userCreate->username
            ],
            'created_at',
        ],
    ]) ?>

<!--    <div class="post-edit__img">-->
<!--        <img src="--><?//= $model->image->urlPath ?><!--" alt="post-img">-->
<!--    </div>-->

</div>
