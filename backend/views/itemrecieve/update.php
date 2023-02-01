<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Itemrecieve $model */

$this->title = 'แก้ไขรับเข้าเวชภัณฑ์: ' . $model->journal_no;
$this->params['breadcrumbs'][] = ['label' => 'รับเข้าเวชภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไข';
?>
<div class="itemrecieve-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
