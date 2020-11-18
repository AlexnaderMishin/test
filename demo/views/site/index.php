<?php

use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Количество решённых заявок: <?= $count ?></h1>

      
    </div>

    <div class="body-content">

        <div class="row">
        <?php
            foreach ($request as  $model) {
                echo '<div class="col-lg-3">
                <h2>'.$model->name.'</h2>

                <p>'.$model->description.'</p>
                <p>'.Html::img('@web/upload/'.$model->photoBefore, ['alt' => 'My logo']).'</p>
                <p>'.$model->timestamp.'</p>
            </div>';
            }
        ?>
            <!-- <div class="col-lg-3">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div> -->
           
          
        </div>

    </div>
</div>
