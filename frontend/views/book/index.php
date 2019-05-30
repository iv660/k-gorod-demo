<?php

use frontend\assets\BooksJsxAsset;
use yii\web\View;
use yii\helpers\URL;

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
// Build API URL
$apiUrl = Yii::$app->params['booksApiEndpoint'] ?? Url::to('@web/../../api/web/api/v1/books', true);

$this->registerJs(<<<JS
    booksConfig = {api_url: '{$apiUrl}'};
JS
    ,
    View::POS_HEAD);
?>
