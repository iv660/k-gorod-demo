<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Chapter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chapter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'page_from')->textInput() ?>

    <?= $form->field($model, 'page_to')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
    <?php
    if (Yii::$app->request->isAjax) {
        /* $this->registerJs(
                "$('.chapter-form form').submit(function() {
                    var link = $(this).attr('action');
                    if (link) {
                        $.ajax(
                            link,
                            {
                                data: $(this).serialize(),
                                success: function (data) {
                                    var oData = JSON.parse(data);
                                    alert(oData.result); 
                                    if (!oData && oData.result != 'OK') {
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
            ); */
    }
    ?>
    
    

</div>
