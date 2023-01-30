<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Medical $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="medical-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>


    <?= $form->field($model, 'medical_cat_id')->Widget(\kartik\select2\Select2::className(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\MedicalCat::find()->all(), 'id', function ($data) {
            return $data->name;
        }),
        'options' => [
            'placeholder' => '--หมวดหมู่เวชภัณฑ์--'
        ]
    ]) ?>

    <?= $form->field($model, 'pack_size')->textInput() ?>

    <?= $form->field($model, 'unit_id')->Widget(\kartik\select2\Select2::className(), [
        'data' => \yii\helpers\ArrayHelper::map(\backend\models\Unit::find()->all(), 'id', function ($data) {
            return $data->name;
        }),
        'options' => [
            'placeholder' => '--หน่วยนับ--'
        ]
    ]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'min_stock')->textInput() ?>

    <?= $form->field($model, 'max_stock')->textInput() ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
