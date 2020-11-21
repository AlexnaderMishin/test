<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Кабинет пользователя <?= Yii::$app->user->identity->username   ?></h1>
    </div>

    <div class="body-content">
    <?= Html::a('Управление заявками', ['my-requests'], ['class' => 'profile-link']) ?>

    </div>
</div>
