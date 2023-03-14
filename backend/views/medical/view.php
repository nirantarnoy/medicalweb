<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Medical $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'เวชภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="medical-view">


    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'code',
            'name',
            'description',
            [
                'attribute' => 'medical_cat_id',
                'value' => function ($model) {
                    return \backend\models\MedicalCat::findName($model->medical_cat_id);
                }
            ],
            'pack_size_desc',
//            'unit_id',
            [
                'attribute' => 'unit_id',
                'value' => function ($model) {
                    return \backend\models\Unit::findUnitName($model->unit_id);
                }
            ],
            'price',
            'min_stock',
            'max_stock',
            'photo',
//            'status',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->status == 1) {
                        return '<div class="badge badge-success" >ใช้งาน</div>';
                    } else {
                        return '<div class="badge badge-secondary" >ไม่ใช้งาน</div>';
                    }
                }
            ],
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
        ],
    ]) ?>

</div>
