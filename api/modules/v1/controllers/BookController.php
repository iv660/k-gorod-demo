<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

/**
 * Book Controller API
 *
 * @author Ilya Vikharev <iv660@yandex.ru>
 */
class BookController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\Book';    
}


