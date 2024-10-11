<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "webhooks".
 *
 * @property int $id
 * @property int $short_link_id
 * @property string $webhook_url
 * @property string|null $created_at
 *
 * @property ShortLinks $shortLink
 */
class Webhooks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'webhooks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short_link_id', 'webhook_url'], 'required'],
            [['short_link_id'], 'integer'],
            [['created_at'], 'safe'],
            [['webhook_url'], 'string', 'max' => 255],
            [['short_link_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShortLinks::class, 'targetAttribute' => ['short_link_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'short_link_id' => 'Short Link ID',
            'webhook_url' => 'Webhook Url',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[ShortLink]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getShortLink()
    {
        return $this->hasOne(ShortLinks::class, ['id' => 'short_link_id']);
    }
}
