<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Medical $model */

$this->title = 'สร้างเวชภัณฑ์';
$this->params['breadcrumbs'][] = ['label' => 'เวชภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="medical-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
