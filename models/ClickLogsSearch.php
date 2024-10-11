<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ClickLogs;

/**
 * ClickLogsSearch represents the model behind the search form of `app\models\ClickLogs`.
 */
class ClickLogsSearch extends ClickLogs
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'short_link_id'], 'integer'],
            [['clicked_at', 'user_ip'], 'safe'],
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
        $query = ClickLogs::find();

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
            'clicked_at' => $this->clicked_at,
        ]);

        $query->andFilterWhere(['like', 'user_ip', $this->user_ip]);

        return $dataProvider;
    }
}
