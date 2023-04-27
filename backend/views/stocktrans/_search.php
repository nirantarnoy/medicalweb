<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\StocktransSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stocktrans-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'globalSearch')->textInput(['placeholder'=>'ค้นหาโดย ชื่อยา เลขที่ หรือ lot no'])->label('ค้นหา') ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(),[
                    'value' => date('d-m-Y'),
                    'pluginOptions' => [
                            'format'=>'dd-mm-yyyy',
                    ]
            ]) ?>
        </div>
<!--        <div class="col-lg-3">-->
<!--            --><?php // $form->field($model, 'trans_module_type_id')->widget(\kartik\select2\Select2::className(),[
//                    'data' => \yii\helpers\ArrayHelper::map(\backend\helpers\ModuleType::asArrayObject(),'id','name'),
//            ]) ?>
<!--        </div>-->
        <div class="col-lg-3">
            <?= $form->field($model, 'activity_type_id')->widget(\kartik\select2\Select2::className(),[
                'data' => \yii\helpers\ArrayHelper::map(\backend\helpers\StockType::asArrayObject(),'id','name'),
            ]) ?>
        </div>
    </div>









    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
