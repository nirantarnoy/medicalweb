<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Itemrecieve $model */

$this->title = 'Update Itemrecieve: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Itemrecieves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="itemrecieve-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
