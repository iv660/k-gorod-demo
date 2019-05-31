<?php

/* @var $this yii\web\View */
use yii\helpers\Url;

$this->title = Yii::t('app', 'My Yii Application Backend');
?>
<div class="site-index">
    <?php require(Yii::getAlias('@common/views/site/_description.php')); ?>

    <div class="jumbotron">
        <p><a class="btn btn-lg btn-success" href="<?= Url::to(['/book']) ?>">К панели управления</a></p>
    </div>

    </div>
</div>
