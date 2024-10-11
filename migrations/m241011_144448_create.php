<?php

use yii\db\Migration;

/**
 * Class m241011_144448_create
 */
class m241011_144448_create extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp(): void
  {
    $this->createTable('{{%short_links}}', [
      'id'           => $this->primaryKey(),
      'original_url' => $this->string()->notNull(),
      'short_code'   => $this->string(10)->notNull()->unique(),
      'created_at'   => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
      'expires_at'   => $this->timestamp()->null(),  // Срок жизни ссылки
      'link_type'    => $this->integer(1)->notNull()->defaultValue(0), // Тип ссылки: permanent, temporary, one-time
      'click_count'  => $this->integer()->defaultValue(0),
    ]);
  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    echo "m241011_144448_create cannot be reverted.\n";
    $this->dropTable('{{%short_links}}');
    return false;
  }
}
