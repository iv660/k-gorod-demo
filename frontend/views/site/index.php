<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Demo Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Демонстрационное приложение</h1>

        <p class="lead">Демонстрационное приложение готово к работе.</p>

    </div>

    <?php require(Yii::getAlias('@common/views/site/_description.php')); ?>
    
    <div class="jumbotron">
        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['/book']) ?>">В каталог книг</a></p>
    </div>
</div>

