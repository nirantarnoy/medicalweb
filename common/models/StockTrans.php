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
            'journal_no' => 'เลขที่',
            'trans_date' => 'วันที่ทำรายการ',
            'trans_module_type_id' => 'กิจกรรม',
            'activity_type_id' => 'ประเภทสต๊อก',
            'item_id' => 'รหัสเวชภัณฑ์',
            'lot_no' => 'Lot No',
            'exp_date' => 'หมดอายุ',
            'qty' => 'จำนวน',
            'status' => 'สถานะ',
            'created_at' => 'สร้างเมื่อ',
            'created_by' => 'สร้างโดย',
        ];
    }
}
