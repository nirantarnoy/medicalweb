<?php

namespace backend\models;

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
class Medical extends \common\models\Medical
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
            [['code'], 'unique'],
            [['medical_cat_id','pack_size','price', 'min_stock', 'max_stock'],'required'],
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
            'code' => 'รหัส',
            'name' => 'ชื่อ',
            'description' => 'รายละเอียด',
            'medical_cat_id' => 'หมวดหมู่เวชภัณฑ์',
            'pack_size' => 'ขนาดบรรจุ',
            'pack_size_desc' => 'เลขคุณลักษณะ',
            'unit_id' => 'หน่วยนับ',
            'price' => 'ราคา',
            'min_stock' => 'Min Stock',
            'max_stock' => 'Max Stock',
            'photo' => 'รูปภาพ',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    public function findCode($id)
    {
        $model = Medical::find()->where(['id' => $id])->one();
        return $model != null ? $model->code : '';
    }

    public function findName($id)
    {
        $model = Medical::find()->where(['id' => $id])->one();
        return $model != null ? $model->name : '';
    }
    public function findUnitName($id)
    {
        $unit_name = '';
        $model = Medical::find()->select('unit_id')->where(['id' => $id])->one();
        if($model){
            $unit_name = \backend\models\Unit::findUnitName($model->unit_id);
        }
        return $unit_name;
    }

    public function getMinstock($id)
    {
        $model = Medical::find()->where(['id' => $id])->one();
        return $model != null ? $model->min_stock : 0;
    }

    public static function getLastNo($group_id)
    {
        //   $model = Orders::find()->MAX('order_no');
        $model = \common\models\Medical::find()->where(['medical_cat_id' => $group_id])->MAX('code');

        $pre = \backend\models\MedicalCat::findCode($group_id);
        if($pre != ''){
            if ($model != null) {
                $arr_data = explode('-',$model);
                $right_data = '';
                if(count($arr_data) > 1){
                    $right_data = $arr_data[1];
                }
                if ($right_data != ''){
                    $prefix = $pre.'-';
                    $cnum = strlen($right_data);
                    $len = $cnum;
                    $clen = strlen($right_data + 1);
                    $loop = $len - $clen;
                    for ($i = 1; $i <= $loop; $i++) {
                        $prefix .= "0";
                    }
                    $prefix .= $right_data + 1;
                    return $prefix;
                }

            } else {
                //   $prefix = $pre . '-' . substr(date("Y"), 2, 2); // omnoi
//            $prefix = $pre;
                $prefix = $pre;
                return $prefix . '-0001';
            }
        }

    }

}
