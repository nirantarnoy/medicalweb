<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Stocktrans;

/**
 * StocktransSearch represents the model behind the search form of `backend\models\Stocktrans`.
 */
class StocktransSearch extends Stocktrans
{
    public $globalSearch;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'trans_module_type_id', 'activity_type_id', 'item_id', 'status', 'created_at', 'created_by'], 'integer'],
            [['journal_no', 'trans_date', 'lot_no', 'exp_date'], 'safe'],
            [['qty'], 'number'],
            [['globalSearch'], 'string']
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
        $query = Stocktrans::find()->innerJoin('medical', 'stock_trans.item_id = medical.id');

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
               'stock_trans.id' => $this->id,
      //         'trans_date' => $this->trans_date,
//            'trans_module_type_id' => $this->trans_module_type_id,
////            'activity_type_id' => $this->activity_type_id,
//            'item_id' => $this->item_id,
//            'exp_date' => $this->exp_date,
//            'qty' => $this->qty,
//            'status' => $this->status,
//            'created_at' => $this->created_at,
//            'created_by' => $this->created_by,
        ]);

//        if ($this->trans_module_type_id > 0) {
//            $query->andFilterWhere(['trans_module_type_id' => $this->trans_module_type_id]);
//        }



        if ($this->globalSearch != '' || $this->globalSearch != null) {

            $query->andFilterWhere(['like', 'journal_no', $this->globalSearch])
                ->orFilterWhere(['like', 'lot_no', $this->globalSearch])
                ->orFilterWhere(['like', 'item_id', $this->globalSearch])
                ->orFilterWhere(['like', 'medical.name', $this->globalSearch]);

        }

        if ($this->activity_type_id > 0) {
            $query->andFilterWhere(['activity_type_id' => $this->activity_type_id]);
        }

        if($this->trans_date != '' || $this->trans_date != null){
            $tdate = '';
            $xdate = explode('-', $this->trans_date);
            if (count($xdate) > 1) {
                $tdate = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0];
            }
            if($tdate !=''){
                $query->andFilterWhere(['date(trans_date)' => date('Y-m-d',strtotime($tdate))]);
            }
        }

        return $dataProvider;
    }
}
