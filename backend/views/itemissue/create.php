<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Itemissue $model */

$this->title = 'สร้างจ่ายเวชภัณฑ์';
$this->params['breadcrumbs'][] = ['label' => 'จ่ายเวชภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemissue-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
