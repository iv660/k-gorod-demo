<?php

use frontend\assets\BooksJsxAsset;
use yii\web\View;

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
<?php 
$this->registerJs(<<<JS
    booksConfig = {api_url: 'https://php7.docwriter.ru/k-gorod/api/web/api/v1/books'};
JS
    ,
    View::POS_HEAD);
?>
