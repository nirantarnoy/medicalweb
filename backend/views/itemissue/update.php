<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Itemissue $model */

$this->title = 'แก้ไขจ่ายเวชภัณฑ์: ' . $model->journal_no;
$this->params['breadcrumbs'][] = ['label' => 'จ่ายเวชภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'แก้ไช';
?>
<div class="itemissue-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
