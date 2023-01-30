<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MedicalCat $model */

$this->title = 'แก้ไขหมวดหมู่เวชภัณฑ์: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'หมวดหมู่เวชภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไช';
?>
<div class="medical-cat-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
