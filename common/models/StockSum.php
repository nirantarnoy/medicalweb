<?php

namespace common\models;

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
            'product_id' => 'ชื่อเวชภัณฑ์',
            'warehouse_id' => 'คลังจัดเก็บ',
            'lot_no' => 'Lot No',
            'expired_date' => 'วันหมดอายุ',
            'qty' => 'จำนวน',
            'trans_ref_id' => 'เลขที่อ้างอิง',
            'status' => 'สถานะ',
            'created_at' => 'สร้างเมื่อ',
            'updated_at' => 'แก้ไขเมื่อ',
        ];
    }
}
