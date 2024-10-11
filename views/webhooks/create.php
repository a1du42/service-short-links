<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Webhooks $model */

$this->title = 'Create Webhooks';
$this->params['breadcrumbs'][] = ['label' => 'Webhooks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="webhooks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
