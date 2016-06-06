<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

    <article class="post">
        <div class="container">
            <img src="<?= $model->image->urlPath ?>" alt="post-img">
            <div class="descriptions">
                <h2><?= Html::encode($model->title) ?></h2>
                <p><?= Html::encode($model->text) ?></p>
                <p class="date date-begin">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    Begin: <?= date('d-m-Y G:i:s', ($model->begin)) ?>
                </p>
                <p class="date date-end">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    End: <?= date('d-m-Y G:i:s', ($model->end)) ?>
                </p>
                <p class="cost">Cost: <?= Html::encode($model->cost) ?></p>
            </div>

        </div>
    </article>
