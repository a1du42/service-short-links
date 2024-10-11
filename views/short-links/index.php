<?php

use app\models\ShortLinks;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\components\Components;
use app\models\Webhooks;

/** @var yii\web\View $this */
/** @var app\models\ShortLinksSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title                   = 'Short Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="short-links-index">

  <h1><?=Html::encode($this->title)?></h1>

  <p>
    <?=Html::a('Create Short Links', ['create'], ['class' => 'btn btn-success'])?>
  </p>

  <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel'  => $searchModel,
    'columns'      => [
      ['class' => 'yii\grid\SerialColumn'],
      'id',
      'original_url',
      [
        'attribute' => 'short_code',
        'value'     => function ($model) {
          return Components::getParamBaseUrl() . $model->short_code;
        }
      ],
      'created_at',
      'expires_at',
      //'link_type',
      [
        'attribute' => 'click_count',
        'format'    => 'raw',
        'value'     => function ($model) {
          $url = Components::getParamBaseUrl() . 'click-logs/?ClickLogsSearch[short_link_id]=' . $model->id;
          return Html::a($model->click_count, $url, ['target' => '_blank']);
        }
      ],
      [
        'attribute' => 'Webhooks',
        'format'    => 'raw', // Для вывода HTML
        'value'     => function ($model) {
          $url = Components::getParamBaseUrl() . 'webhooks/?WebhooksSearch[short_link_id]=' . $model->id;
          return Html::a((string)count(Webhooks::findAll(['short_link_id'=> $model->id])), $url, ['target' => '_blank']);
        }
      ],
      [
        'class'      => ActionColumn::className(),
        'urlCreator' => function ($action, ShortLinks $model, $key, $index, $column) {
          return Url::toRoute([$action, 'id' => $model->id]);
        }
      ],
    ],
  ]);?>


</div>
