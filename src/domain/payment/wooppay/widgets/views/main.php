<?php

/* @var $this yii\web\View */
/* @var $model WooppayWithdrawalForm*/

use yii2bundle\money\domain\payment\wooppay\forms\WooppayWithdrawalForm;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<br/>

<?php $form = ActiveForm::begin([
    'fieldConfig' => [
        'template' => "{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
    ],
]); ?>

<?= $form->field($model, 'phone')->textInput(['placeholder' => $model->getAttributeLabel('phone')]) ?>

<?= $form->field($model, 'amount')->textInput(['placeholder' => $model->getAttributeLabel('amount')]) ?>

    <div class="form-group">
        <?=Html::submitButton(Yii::t('action', 'send'), ['class' => 'btn btn-primary btn-flat', 'name' => 'login-button']) ?>
    </div>

<?php ActiveForm::end(); ?>