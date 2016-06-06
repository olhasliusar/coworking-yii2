<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',
//        'itemOptions' => ['<li>', '</li>'],
//      'filterModel' => $searchModel,
 /*         'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'image_id',
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
 */
//        'itemView' => '_post',
    ]); ?>

    </div>
</div>
