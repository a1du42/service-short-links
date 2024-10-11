<?php

use yii\db\Migration;

/**
 * Class m241011_145532_create_log_links
 */
class m241011_145532_create_log_links extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp(): void
  {
    $this->createTable('{{%click_logs}}', [
      'id'            => $this->primaryKey(),
      'short_link_id' => $this->integer()->notNull(),
      'clicked_at'    => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
      'user_ip'       => $this->string(45),
    ]);

    // Создание индекса для быстрого поиска по short_link_id
    $this->createIndex(
      '{{%idx-click_logs-short_link_id}}',
      '{{%click_logs}}',
      'short_link_id'
    );

    // Связь с таблицей short_links
    $this->addForeignKey(
      '{{%fk-click_logs-short_link_id}}',
      '{{%click_logs}}',
      'short_link_id',
      '{{%short_links}}',
      'id',
      'CASCADE'
    );

  }

  /**
   * {@inheritdoc}
   */
  public function safeDown()
  {
    echo "m241011_145532_create_log_links cannot be reverted.\n";

    $this->dropForeignKey('{{%fk-click_logs-short_link_id}}', '{{%click_logs}}');
    $this->dropIndex('{{%idx-click_logs-short_link_id}}', '{{%click_logs}}');
    $this->dropTable('{{%click_logs}}');

    return false;
  }
}
