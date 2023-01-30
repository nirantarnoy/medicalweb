<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MedicalCat $model */

$this->title = 'Create Medical Cat';
$this->params['breadcrumbs'][] = ['label' => 'Medical Cats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-cat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
