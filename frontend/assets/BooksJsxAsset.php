<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class BooksJsxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/books.jsx',
    ];
    public $jsOptions = [
        'type' => 'text/babel',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
