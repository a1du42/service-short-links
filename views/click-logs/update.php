<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ClickLogs $model */

$this->title = 'Update Click Logs: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Click Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="click-logs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
