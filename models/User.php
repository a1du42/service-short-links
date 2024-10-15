<?php

namespace app\models;

use app\components\ConfigComponent;
use yii\web\IdentityInterface;

class User implements IdentityInterface
{
  public $id;
  public $username;
  public $password;

  /**
   * Найти пользователя по ID.
   */
  public static function findIdentity($id)
  {
    return new static([
      'username' => ConfigComponent::getParam('username'),
      'password' => ConfigComponent::getParam('password')
    ]);
  }

  /**
   * Найти пользователя по токену (не используется для базовой аутентификации).
   */
  public static function findIdentityByAccessToken($token, $type = null)
  {
    return null;
  }

  /**
   * @param $username
   * @return User
   */
  public static function findByUsername($username): User
  {
    return new static([
      'username' => ConfigComponent::getParam('username'),
      'password' => ConfigComponent::getParam('password')
    ]);
  }

  /**
   * Проверка пароля.
   */
  public function validatePassword($password): bool
  {
    return $this->password === $password;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getAuthKey()
  {
    return null;
  }

  public function validateAuthKey($authKey)
  {
    return false;
  }

  public function __construct($config = [])
  {
    foreach ($config as $key => $value) {
      $this->$key = $value;
    }
  }
}
