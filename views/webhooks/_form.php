<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Webhooks $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="webhooks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'short_link_id')->textInput() ?>

    <?= $form->field($model, 'webhook_url')->textInput(['maxlength' => true]) ?>

  <?= $form->field($model, 'created_at')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
