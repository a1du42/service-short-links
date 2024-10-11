<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Webhooks $model */

$this->title = 'Update Webhooks: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Webhooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="webhooks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
