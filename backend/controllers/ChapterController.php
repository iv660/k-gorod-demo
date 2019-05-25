<?php

namespace backend\controllers;

class ChapterController extends \yii\web\Controller
{
    public function actionItem()
    {
        return $this->render('item');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
