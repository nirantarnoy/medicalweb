<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Medical $model */
/** @var yii\widgets\ActiveForm $form */
?>

    <div class="medical-form">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'medical_cat_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\MedicalCat::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--หมวดหมู่เวชภัณฑ์--'
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'pack_size')->textInput() ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'unit_id')->Widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Unit::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => [
                        'placeholder' => '--หน่วยนับ--'
                    ]
                ]) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'price')->textInput() ?>
            </div>
        </div>


        <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>


        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'min_stock')->textInput() ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'max_stock')->textInput() ?>
            </div>
            <div class="col-lg-4">
                <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
            </div>
        </div>

        <br>
        <?php if ($model->photo == null): ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-lg-4">
                    <img src="<?= \Yii::$app->getUrlManager()->baseUrl . "/uploads/photo/" . $model->photo ?>"
                         style="width: 40%" alt="">
                </div>
            </div>
            <div style="height: 10px;"></div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="btn btn-danger btn-delete-photo" data-var="<?= $model->id ?>">ลบรูปภาพ</div>
                </div>
            </div>
        <?php endif; ?>

        <br/>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
    <form id="form-delete-photo" action="<?= \yii\helpers\Url::to(['medical/deletephoto'], true) ?>" method="post">
        <input type="hidden" class="delete-photo-id" name="delete_id" value="">
    </form>
<?php
//$url_to_delete_photo = \yii\helpers\Url::to(['product/deletephoto'], true);
$js = <<<JS
  $(function(){
     $(".btn-delete-photo").click(function (){
        var prodid = $(this).attr('data-var');
      //  alert(prodid);
      swal({
                title: "ต้องการทำรายการนี้ใช่หรือไม่",
                text: "",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                showLoaderOnConfirm: true
               }, function () {
                  $(".delete-photo-id").val(prodid);
                  $("#form-delete-photo").submit();
         });
     });
  });
JS;
$this->registerJs($js, static::POS_END);
?>