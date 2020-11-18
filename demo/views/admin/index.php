<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Панель администратора</h1>
    </div>

    <div class="body-content">
    <?= Html::a('Управление категориями', ['/category'], ['class' => 'profile-link']) ?>
    <br>
    <?= Html::a('Управление заявками', ['/request'], ['class' => 'profile-link']) ?>

    </div>
</div>
