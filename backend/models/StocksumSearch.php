<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Stocksum;

/**
 * StocksumSearch represents the model behind the search form of `backend\models\Stocksum`.
 */
class StocksumSearch extends Stocksum
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'warehouse_id', 'product_id', 'qty', 'updated_at', 'created_at'], 'integer'],
            [['lot_no','expired_date'], 'safe'],
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
        $query = Stocksum::find();

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
            'warehouse_id' => $this->warehouse_id,
            'product_id' => $this->product_id,
            'qty' => $this->qty,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);



//        if($this->globalSearch !=''){
//            $query->orFilterWhere(['like', '', $this->globalSearch])
//                ->orFilterWhere(['like', 'name', $this->globalSearch])
//                ->orFilterWhere(['like', 'description', $this->globalSearch]);
//        }
        return $dataProvider;
    }
}
