<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stock_sum".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $warehouse_id
 * @property string|null $lot_no
 * @property string|null $expired_date
 * @property float|null $qty
 * @property int|null $trans_ref_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class StockSum extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stock_sum';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'warehouse_id', 'trans_ref_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['expired_date'], 'safe'],
            [['qty'], 'number'],
            [['lot_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'warehouse_id' => 'Warehouse ID',
            'lot_no' => 'Lot No',
            'expired_date' => 'Expired Date',
            'qty' => 'Qty',
            'trans_ref_id' => 'Trans Ref ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
