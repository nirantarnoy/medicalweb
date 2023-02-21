<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Itemissue $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="itemissue-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'journal_no')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(), [
                'pluginOptions' => [
                    'format' => 'dd/mm/yyyy',
                    'todayHighlight' => true
                ]
            ]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'emp_id')->textInput(['readonly'=>'readonly']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        </div>
    </div>
    <br/>
    <h6>รายละเอียดรายการรับเข้า</h6>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-bordered" id="table-list">
                <thead>
                <tr>
                    <th>#</th>
                    <th>รหัสเวชภัณฑ์</th>
                    <th>ชื่อ</th>
                    <th>จำนวน</th>
                    <th>หน่วยนับ</th>
                    <th>LotNo.</th>
                    <th>ExpiredDate</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7">
                        <div class="btn btn-primary"
                             onclick="addline($(this))">
                            <i class="fa fa-plus-circle"></i>
                        </div>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
