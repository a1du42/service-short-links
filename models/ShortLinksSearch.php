<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ShortLinks;

/**
 * ShortLinksSearch represents the model behind the search form of `app\models\ShortLinks`.
 */
class ShortLinksSearch extends ShortLinks
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'link_type', 'click_count'], 'integer'],
            [['original_url', 'short_code', 'created_at', 'expires_at'], 'safe'],
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
        $query = ShortLinks::find();

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
            'created_at' => $this->created_at,
            'expires_at' => $this->expires_at,
            'link_type' => $this->link_type,
            'click_count' => $this->click_count,
        ]);

        $query->andFilterWhere(['like', 'original_url', $this->original_url])
            ->andFilterWhere(['like', 'short_code', $this->short_code]);

        return $dataProvider;
    }
}
