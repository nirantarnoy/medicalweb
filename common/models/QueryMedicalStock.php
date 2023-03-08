<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "query_medical_stock".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property int|null $pack_size
 * @property int|null $unit_id
 * @property float|null $price
 * @property float|null $min_stock
 * @property float|null $max_stock
 * @property int|null $warehouse_id
 * @property string|null $lot_no
 * @property string|null $expired_date
 * @property float|null $qty
 * @property string|null $unit_name
 */
class QueryMedicalStock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'query_medical_stock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'pack_size', 'unit_id', 'warehouse_id'], 'integer'],
            [['price', 'min_stock', 'max_stock', 'qty'], 'number'],
            [['expired_date'], 'safe'],
            [['code', 'name', 'lot_no', 'unit_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'pack_size' => 'Pack Size',
            'unit_id' => 'Unit ID',
            'price' => 'Price',
            'min_stock' => 'Min Stock',
            'max_stock' => 'Max Stock',
            'warehouse_id' => 'Warehouse ID',
            'lot_no' => 'Lot No',
            'expired_date' => 'Expired Date',
            'qty' => 'Qty',
            'unit_name' => 'Unit Name',
        ];
    }
}
