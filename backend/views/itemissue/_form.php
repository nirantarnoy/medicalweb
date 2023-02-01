<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Itemissue $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="itemissue-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'journal_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trans_date')->textInput() ?>

    <?= $form->field($model, 'emp_id')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
