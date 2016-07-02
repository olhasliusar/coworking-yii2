<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            [
                'attribute'=>'role',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'role',
                    [
                        '' => 'all',
                        User::ROLE_USER => 'user',
                        User::ROLE_MODER => 'moder',
                        User::ROLE_ADMIN => 'admin'
                    ],
                    ['class'=>'form-control']
                ),
                'value' => function ($data) {
                    if($data->role == 1){
                        return 'user';
                    } elseif ($data->role == 5){
                        return 'moder';
                    } else {
                        return 'admin';
                    }
                }
            ],
            'fullname',
//            'auth_key',
//            'password_hash',
            // 'password_reset_token',
             'email:email',
            // 'status',
            // 'updated_by',
            // 'updated_at',
            // 'created_at',
            // 'created_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
