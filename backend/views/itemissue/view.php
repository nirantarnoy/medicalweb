<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Itemissue $model */

$this->title = $model->journal_no;
$this->params['breadcrumbs'][] = ['label' => 'จ่ายเวชภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="itemissue-view">


    <p>
        <?= Html::a('แก้ไช', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'journal_no',
            'trans_date',
            'emp_id',
            'description',
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
