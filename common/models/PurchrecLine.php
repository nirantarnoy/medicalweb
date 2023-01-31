<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "purchrec_line".
 *
 * @property int $id
 * @property int|null $purchrec_id
 * @property int|null $item_id
 * @property string|null $lot_no
 * @property string|null $exp_date
 * @property float|null $qty
 * @property int|null $unit_id
 * @property int|null $status
 * @property int|null $created_at
 */
class PurchrecLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchrec_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchrec_id', 'item_id', 'unit_id', 'status', 'created_at'], 'integer'],
            [['exp_date'], 'safe'],
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
            'purchrec_id' => 'Purchrec ID',
            'item_id' => 'Item ID',
            'lot_no' => 'Lot No',
            'exp_date' => 'Exp Date',
            'qty' => 'Qty',
            'unit_id' => 'Unit ID',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }
}
