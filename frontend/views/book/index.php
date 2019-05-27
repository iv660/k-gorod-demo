<?php

use frontend\assets\BooksJsxAsset;

/* @var $this yii\web\View */

BooksJsxAsset::register($this);

$this->title = Yii::t('app', 'Books Directory');
?>

<div class="book-index">
    <div class="body-content">
        <h1><?= $this->title ?></h1>

        <div id="books-container"><?= Yii::t('app', 'Loading...') ?></div>
    </div>
</div>

