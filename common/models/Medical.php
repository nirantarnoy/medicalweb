<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "medical".
 *
 * @property int $id
 * @property string|null $code
 * @property string|null $name
 * @property string|null $description
 * @property int|null $medical_cat_id
 * @property int|null $pack_size
 * @property int|null $unit_id
 * @property float|null $price
 * @property float|null $min_stock
 * @property float|null $max_stock
 * @property string|null $photo
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Medical extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medical';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medical_cat_id',  'unit_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['price', 'min_stock', 'max_stock'], 'number'],
            [['code', 'name', 'description', 'photo','pack_size_desc'], 'string', 'max' => 255],
            [['pack_size',],'safe']
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
            'description' => 'Description',
            'medical_cat_id' => 'Medical Cat ID',
            'pack_size' => 'ขนาดบรรจุ',
            'pack_size_desc' => 'เลขคุณลักษณะ',
            'unit_id' => 'Unit ID',
            'price' => 'Price',
            'min_stock' => 'Min Stock',
            'max_stock' => 'Max Stock',
            'photo' => 'Photo',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
