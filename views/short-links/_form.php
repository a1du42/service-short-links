<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ShortLinks $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="short-links-form">

  <?php $form = ActiveForm::begin(); ?>

  <?=$form->field($model, 'original_url')->textInput(['maxlength' => true])?>

  <?=$form->field($model, 'short_code')->textInput(['maxlength' => true])?>

  <?= $form->field($model, 'created_at')->hiddenInput(['value' => date('Y-m-d H:i:s')])->label(false) ?>

  <?=$form->field($model, 'expires_at')->textInput(['value' => date('Y-m-d H:i:s')])?>

  <?=$form->field($model, 'link_type')->textInput()?>

  <?=$form->field($model, 'click_count')->textInput()?>

  <div class="form-group">
    <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
  </div>

  <?php ActiveForm::end(); ?>

</div>
