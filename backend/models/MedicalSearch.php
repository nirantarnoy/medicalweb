<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Medical;

/**
 * MedicalSearch represents the model behind the search form of `backend\models\Medical`.
 */
class MedicalSearch extends Medical
{

    /**
     * {@inheritdoc}
     */
    public $globalSearch;
    public function rules()
    {
        return [
            [['id', 'medical_cat_id', 'pack_size', 'unit_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['code', 'name', 'description', 'photo'], 'safe'],
            [['price', 'min_stock', 'max_stock'], 'number'],
            [['globalSearch'], 'string'],
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
        $query = Medical::find();

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
//        $query->andFilterWhere([
//            'id' => $this->id,
//            'medical_cat_id' => $this->medical_cat_id,
//            'pack_size' => $this->pack_size,
//            'unit_id' => $this->unit_id,
//            'price' => $this->price,
//            'min_stock' => $this->min_stock,
//            'max_stock' => $this->max_stock,
//            'status' => $this->status,
//            'created_at' => $this->created_at,
//            'created_by' => $this->created_by,
//            'updated_at' => $this->updated_at,
//            'updated_by' => $this->updated_by,
//        ]);

        $query->orFilterWhere(['like', 'code', $this->globalSearch])
            ->orFilterWhere(['like', 'name', $this->globalSearch])
            ->orFilterWhere(['like', 'description', $this->globalSearch])
            ->orFilterWhere(['like', 'photo', $this->globalSearch]);

        return $dataProvider;
    }
}
