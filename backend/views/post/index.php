<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $actionsWidget = '{view} {update}';
    if (Yii::$app->user->can('deletePost')) {
        $actionsWidget .= '{delete}';
    }
//    $columns = [];
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'userName',

            [
                'attribute'=>'status',
                'visible' => Yii::$app->user->can('deletePost'),
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    [
                        User::STATUS_ACTIVE => 'active',
                        User::STATUS_DELETED => 'inactive'
                    ],
                    ['class'=>'form-control']
                ),
                'value' => function ($data) {
                    return $data->status == 1 ? 'active' : 'inactive';
                }
            ],

            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function ($data) {
//                    return Html::img($data->image->urlPath,
                    return Html::img($data->imageURL,
                    ['width' => '100px']);
                }
            ],

            'title',
            'text',

            // 'begin',
            // 'end',
            // 'cost',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'headerOptions' => ['width' => '60'],
                'template' => $actionsWidget,
            ],
        ],

    ]); ?>
</div>
