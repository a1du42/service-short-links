<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "short_links".
 *
 * @property int $id
 * @property string $original_url
 * @property string $short_code
 * @property string|null $created_at
 * @property string|null $expires_at
 * @property int $link_type
 * @property int|null $click_count
 *
 * @property ClickLogs[] $clickLogs
 * @property Webhooks[] $webhooks
 */
class ShortLinks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'short_links';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['original_url', 'short_code'], 'required'],
            [['created_at', 'expires_at'], 'safe'],
            [['link_type', 'click_count'], 'integer'],
            [['original_url'], 'string', 'max' => 255],
            [['short_code'], 'string', 'max' => 10],
            [['short_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'original_url' => 'Original Url',
            'short_code' => 'Short Code',
            'created_at' => 'Created At',
            'expires_at' => 'Expires At',
            'link_type' => 'Link Type',
            'click_count' => 'Click Count',
        ];
    }

    /**
     * Gets query for [[ClickLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClickLogs()
    {
        return $this->hasMany(ClickLogs::class, ['short_link_id' => 'id']);
    }

    /**
     * Gets query for [[Webhooks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWebhooks()
    {
        return $this->hasMany(Webhooks::class, ['short_link_id' => 'id']);
    }
}
