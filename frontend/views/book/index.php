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
$apiUrl = Yii::$app->urlManager->createAbsoluteUrl('');
$rootDir = '/frontend/';
$rootPosition = strpos($apiUrl, $rootDir);
$rootLength = strlen($rootDir);
$apiUrl = substr($apiUrl, 0, $rootPosition) . '/api/web/' . Url::to('api/v1/books');

$this->registerJs(<<<JS
    booksConfig = {api_url: '{$apiUrl}'};
JS
    ,
    View::POS_HEAD);
?>
