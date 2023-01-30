<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Medical $model */

$this->title = 'แก้ไขเวชภัณฑ์: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'เวชภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="medical-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
