<?php

namespace app\components;

use app\models\User;
use yii\filters\auth\HttpBasicAuth;

class ControllerComponent
{

  /**
   * @return array[]
   */
  public static function getBehaviorAuthenticator(): array
  {
    return [
      'authenticator' => [
        'class' => HttpBasicAuth::class,
        'auth' => function ($username, $password) {
          $user = User::findByUsername($username);
          if ($user && $user->validatePassword($password)) {
            return $user; // Вернем объект, реализующий IdentityInterface
          }
          return null;
        },
      ],

    ];
  }
}