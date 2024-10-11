<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ClickLogs $model */

$this->title = 'Create Click Logs';
$this->params['breadcrumbs'][] = ['label' => 'Click Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="click-logs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
