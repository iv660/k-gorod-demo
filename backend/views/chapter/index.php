<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Chapters');
?>
<div class="chapter-index">

    <h2><?= Html::encode($this->title) ?></h2>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => [
            'data-link' => Url::to(['chapter/update']),
        ],
        'columns' => [
            'name:ntext',
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
    
    <?php 
    Modal::begin([
        'id' => 'chapter-modal',
        'header' => '<h4 clsas="modal-title">' . Yii::t('app', 'Update Chapter') . '</h4>',
//        'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">' . Yii::t('app', 'Close') . '</a>',
    ]); ?>
    
    <?php Modal::end(); ?>
    
    <?php
    $this->registerJs(
            "$('#p0').on('click', 'tr', function() {
                var link = $(this).data('link');
                if (link) {
                    $.ajax(
                        link,
                        {
                            data: {
                                id: $(this).data('key')
                            },
                            success: function (data) {
                                $('.modal-body').html(data);
                                $('#chapter-modal').modal();
                                
                            },  
                        }
                    );
                }
            });
            
            $('#chapter-modal').on('submit', '.chapter-form form', function() {
                var link = $(this).attr('action');
                if (link) {
                    $.ajax(
                        link,
                        {
                            data: $(this).serialize(),
                            success: function (data) {
                                var oData;
                                var isJsonOk = true;
                                
                                try {
                                    oData = JSON.parse(data);
                                } catch (err) {
                                    isJsonOk = false;
                                }
                                
                                if (!isJsonOk || oData.result != 'OK') {
                                    // Display data
                                    $('.modal-body').html(data);
                                } else {
                                    // Close modal window
                                    $('.modal-body').html('');
                                    $('#chapter-modal').modal('toggle');
                                    $.pjax.reload('#p0');
                                }    
                            },
                            method: 'post',
                        }
                    );
                }

                return false;
            });
"
        ); ?>
</div>
