<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Itemissue;

/**
 * ItemissueSearch represents the model behind the search form of `backend\models\Itemissue`.
 */
class ItemissueSearch extends Itemissue
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'emp_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['journal_no', 'trans_date', 'description'], 'safe'],
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
        $query = Itemissue::find();

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
            'trans_date' => $this->trans_date,
            'emp_id' => $this->emp_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'journal_no', $this->journal_no])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
