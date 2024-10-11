<?php

namespace app\controllers;

use app\components\Components;
use app\models\ClickLogs;
use app\models\ShortLinks;
use app\models\Webhooks;
use GuzzleHttp\Exception\GuzzleException;
use http\Client;
use Yii;
use yii\web\Controller;

class ProcessController extends Controller
{

  /**
   * @return string
   */
  public function actionIndex(): string
  {
    return 'Сервис сокращенных ссылок';
  }

  /**
   * @param $key
   * @return mixed
   */
  public function actionRedirect($key): mixed
  {
    $shortCode = ShortLinks::findOne(['short_code' => $key]);

    if ($shortCode?->id) {
      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP из заголовка HTTP_X_FORWARDED_FOR (используется при прокси)
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
        $ip = $_SERVER['REMOTE_ADDR'];
      }

      $clickLogs = new ClickLogs();

      $clickLogs->short_link_id = $shortCode->id;
      $clickLogs->clicked_at    = date('Y-m-d H:i:s');
      $clickLogs->user_ip       = $ip;

      try {
        $clickLogs->save();
      } catch (\Exception $exception) {
        Yii::error($exception->getMessage());
        Yii::error($exception->getTraceAsString());
      }

      $shortCode->click_count = $shortCode->click_count + 1;

      try {
        $shortCode->save();
      } catch (\Exception $exception) {
        Yii::error($exception->getMessage());
        Yii::error($exception->getTraceAsString());
      }

      $webhook = Webhooks::findOne(['short_link_id' => $shortCode->id]);

      if ($webhook?->id) {
        $client = new \GuzzleHttp\Client([
          'verify' => false,
        ]);
        try {
          $client->get($webhook->webhook_url);
        } catch (\Exception|GuzzleException $exception) {
          Yii::error($exception->getMessage());
          Yii::error($exception->getTraceAsString());
          var_dump($exception->getMessage());
        }
      }

      return $this->redirect($shortCode->original_url);
    }

    return $this->redirect(Components::getParamRedirectUrl());
  }

  /**
   * @return string
   */
  public function actionError(): string
  {
    return 'Ошибка';
  }
}
