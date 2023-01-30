<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MedicalCat $model */

$this->title = 'สร้างหมวดหมู่เวชภัณฑ์';
$this->params['breadcrumbs'][] = ['label' => 'หมวดหมู่เวชภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-cat-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
