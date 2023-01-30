<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MedicalCat $model */

$this->title = 'Update Medical Cat: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Medical Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medical-cat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
