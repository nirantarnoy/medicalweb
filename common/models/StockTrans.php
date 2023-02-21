<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stock_trans".
 *
 * @property int $id
 * @property string|null $journal_no
 * @property string|null $trans_date
 * @property int|null $trans_module_type_id
 * @property int|null $activity_type_id
 * @property int|null $item_id
 * @property string|null $lot_no
 * @property string|null $exp_date
 * @property float|null $qty
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 */
class StockTrans extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_trans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date', 'exp_date'], 'safe'],
            [['trans_module_type_id', 'activity_type_id', 'item_id', 'status', 'created_at', 'created_by'], 'integer'],
            [['qty'], 'number'],
            [['journal_no', 'lot_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_no' => 'Journal No',
            'trans_date' => 'Trans Date',
            'trans_module_type_id' => 'Trans Module Type ID',
            'activity_type_id' => 'Activity Type ID',
            'item_id' => 'Item ID',
            'lot_no' => 'Lot No',
            'exp_date' => 'Exp Date',
            'qty' => 'Qty',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
