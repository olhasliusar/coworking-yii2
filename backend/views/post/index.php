<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,


        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_fullname',
                'format' => 'html',
                'value' => function ($data) {
                    return  $data->user->fullname;
                }
            ],

            [
                'attribute' => 'image_id',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img($data->image->urlPath,
                    ['width' => '100px']);
                }
            ],

//            [
//                'attribute' => 'status',
//                'format' => 'html',
//                'value' => function ($data) {
//                    return $data->status == 1 ? 'active' : 'deleted';
//                }
//            ],

//          'user_id',

            'title',
            'text',

            // 'begin',
            // 'end',
            // 'cost',
            // 'status',
            // 'updated_by',
            // 'updated_at',
            // 'created_at',
            // 'created_by',

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Actions',
                'headerOptions' => ['width' => '60'],
                'template' => '{view} {update} {delete}{link}',
            ],
        ],

    ]); ?>
</div>
