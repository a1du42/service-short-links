<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "click_logs".
 *
 * @property int $id
 * @property int $short_link_id
 * @property string|null $clicked_at
 * @property string|null $user_ip
 *
 * @property ShortLinks $shortLink
 */
class ClickLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'click_logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['short_link_id'], 'required'],
            [['short_link_id'], 'integer'],
            [['clicked_at'], 'safe'],
            [['user_ip'], 'string', 'max' => 45],
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
            'clicked_at' => 'Clicked At',
            'user_ip' => 'User Ip',
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
