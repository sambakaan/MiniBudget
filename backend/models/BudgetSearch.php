<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Budget;

/**
 * BudgetSearch represents the model behind the search form of `backend\models\Budget`.
 */
class BudgetSearch extends Budget
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'somme', 'user_id'], 'integer'],
            [['date_ajout'], 'safe'],
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
        $query = Budget::find();

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
            'somme' => $this->somme,
            'user_id' => $this->user_id,
            'date_ajout' => $this->date_ajout,
        ]);

        return $dataProvider;
    }
}
