<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal; // @todo Remove Modal
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
//                'buttons' => [
//                    'update' => function ($url, $model, $key) {
//                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
//                            'class' => 'book-update-link',
//                            'title' => Yii::t('app', 'Update'),
//                            'data-toggle' => 'modal',
//                            'data-target' => '#book-modal',
//                            'data-id' => $key,
//                            'data-pjax' => 0,
//                        ]);
//                    },
//                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    
    <?php
    // @todo Remove modal JS
    $this->registerJs(
            "$('.book-update-link').click(function() {
                $.get(
                    $(this).attr('href'),         
                    {
                        id: $(this).closest('tr').data('key')
                    },
                    function (data) {
                        $('.modal-body').html(data);
                        $('#book-modal').modal();
                    }  
                );
            });
"
        ); ?>
    
    <?php 
    // @todo Remove modal window
    Modal::begin([
        'id' => 'book-modal',
        'header' => '<h4 clsas="modal-title">' . Yii::t('app', 'Update Book') . '</h4>',
//        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">' . Yii::t('app', 'Close') . '</a>',
    ]); ?>
    
    <?php Modal::end(); ?>

</div>
