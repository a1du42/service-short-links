<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Webhooks;

/**
 * WebhooksSearch represents the model behind the search form of `app\models\Webhooks`.
 */
class WebhooksSearch extends Webhooks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'short_link_id'], 'integer'],
            [['webhook_url', 'created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Webhooks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'short_link_id' => $this->short_link_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'webhook_url', $this->webhook_url]);

        return $dataProvider;
    }
}
