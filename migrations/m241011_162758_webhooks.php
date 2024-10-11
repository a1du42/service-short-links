<?php

use yii\db\Migration;

/**
 * Class m241011_162758_webhooks
 */
class m241011_162758_webhooks extends Migration
{
  /**
   * {@inheritdoc}
   */
  public function safeUp(): void
  {
    $this->createTable('{{%webhooks}}', [
      'id'            => $this->primaryKey(),
      'short_link_id' => $this->integer()->notNull(),
      'webhook_url'   => $this->string()->notNull(), // URL для отправки webhook
      'created_at'    => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
    ]);

    // Создание индекса для быстрого поиска по short_link_id
    $this->createIndex(
      '{{%idx-webhooks-short_link_id}}',
      '{{%webhooks}}',
      'short_link_id'
    );

    // Связь с таблицей short_links
    $this->addForeignKey(
      '{{%fk-webhooks-short_link_id}}',
      '{{%webhooks}}',
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
    echo "m241011_162758_webhooks cannot be reverted.\n";

    $this->dropForeignKey('{{%fk-webhooks-short_link_id}}', '{{%webhooks}}');
    $this->dropIndex('{{%idx-webhooks-short_link_id}}', '{{%webhooks}}');
    $this->dropTable('{{%webhooks}}');

    return false;
  }

}
