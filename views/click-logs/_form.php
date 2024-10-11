<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ClickLogs $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="click-logs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'short_link_id')->textInput() ?>

    <?= $form->field($model, 'clicked_at')->textInput() ?>

    <?= $form->field($model, 'user_ip')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
