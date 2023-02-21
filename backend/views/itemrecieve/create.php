<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\Itemrecieve $model */

$this->title = 'สร้างรับเข้าเวชภัณฑ์';
$this->params['breadcrumbs'][] = ['label' => 'รับเข้าเวชภัณฑ์', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="itemrecieve-create">


    <?= $this->render('_form', [
        'model' => $model,
        'model_line' => null,
    ]) ?>

</div>
