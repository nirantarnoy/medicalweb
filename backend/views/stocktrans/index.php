<?php

use backend\models\Stocktrans;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\StocktransSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ประวัติรายการเข้า-ออก';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stocktrans-index">
    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //  'filterModel' => $searchModel,
        'emptyCell' => '-',
        'layout' => "{items}\n{summary}\n<div class='text-center'>{pager}</div>",
        'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
        'showOnEmpty' => false,
        //    'bordered' => true,
        //     'striped' => false,
        //    'hover' => true,
        'id' => 'product-grid',
        //'tableOptions' => ['class' => 'table table-hover'],
        'emptyText' => '<div style="color: red;text-align: center;"> <b>ไม่พบรายการไดๆ</b></div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'journal_no',
            [
                'attribute' => 'trans_date',
                'headerOptions' => ['style' => 'text-align: center'],
                'contentOptions' => ['style' => 'text-align: center'],
                'value' => function ($data) {
                    return date('d-m-Y H:i:s', strtotime($data->trans_date));
                }
            ],
            'issue_ref_no',
//            [
//                'attribute' => 'trans_module_type_id',
//                'headerOptions' => ['style' => 'text-align: center'],
//                'contentOptions' => ['style' => 'text-align: center'],
//                'format' => 'html',
//                'value' => function ($data) {
//                    if ($data->trans_module_type_id == 1) {
//                        return '<div class="text-success">'.\backend\helpers\ModuleType::getTypeById($data->trans_module_type_id).'</div>';
//                    }else  if ($data->trans_module_type_id == 2) {
//                        return '<div class="text-danger">'.\backend\helpers\ModuleType::getTypeById($data->trans_module_type_id).'</div>';
//                    }
//
//                }
//            ],

            [
                'attribute' => 'item_id',
                'value' => function ($data) {
                    return \backend\models\Medical::findName($data->item_id);
                }
            ],
            [
                'attribute' => 'lot_no',
                'headerOptions' => ['style' => 'text-align: center'],
                'contentOptions' => ['style' => 'text-align: center'],
                'value' => function ($data) {
                    return $data->lot_no;
                }
            ],
            //'exp_date',
            [
                'attribute' => 'qty',
                'headerOptions' => ['style' => 'text-align: right'],
                'contentOptions' => ['style' => 'text-align: right'],
                'value' => function ($data) {
                    return number_format($data->qty);
                }
            ],
            [
                'attribute' => 'activity_type_id',
                'headerOptions' => ['style' => 'text-align: center'],
                'contentOptions' => ['style' => 'text-align: center'],
                'format' => 'html',
                'value' => function ($data) {
                    if ($data->activity_type_id == 1) {
                        return '<div class="badge badge-success">IN</div>';
                    } else if ($data->activity_type_id == 2) {
                        return '<div class="badge badge-danger">OUT</div>';
                    }
                }
            ],
            //'status',
            // 'created_at',
            [
                'attribute' => 'created_by',
                'value' => function ($data) {
                    return \backend\models\User::findName($data->created_by);
                }
            ],

        ],
        'pager' => ['class' => LinkPager::className()],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
