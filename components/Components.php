<?php

namespace app\components;

use Yii;

class Components
{
  /**
   * @param $param
   * @param $default
   * @return mixed|null
   */
  public static function getParam($param, $default = null): mixed
  {
    return Yii::$app->params[$param] ?? $default;
  }
}