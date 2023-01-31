<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Itemrecieve $model */

$this->title = 'Create Itemrecieve';
$this->params['breadcrumbs'][] = ['label' => 'Itemrecieves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemrecieve-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
