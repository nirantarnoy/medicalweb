<?php

?>
<form action="<?= \yii\helpers\Url::to(['stocktrans/transheet'], true) ?>" method="post">
    <div class="row">
        <div class="col-lg-3">
            <label for="">เลือกรหัสเวชภัณฑ์</label>
            <?php
            echo \kartik\select2\Select2::widget([
                'name' => 'select_product',
                'data' => \yii\helpers\ArrayHelper::map(\backend\models\Medical::find()->all(), 'id', 'name'),
                'value' => $model != null ? $model->id : -1,
                'options' => [
                    'class' => 'form-control',
                    'placeholder' => '--เลือกรหัส--'
                ],
                'pluginOptions' => [
                    'allowClear' => true,
                ]
            ]);
            ?>
        </div>
        <div class="col-lg-3">
            <label for="" style="color: white;">ค้นหา</label><br>
            <button class="btn btn-info">ค้นหา</button>
        </div>

    </div>
</form>
<br/>
<div id="div1">
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;border: none;">
                <tr>
                    <td style="text-align: center;"><h3>แบบบันทึกควบคุมการเบิกจ่ายวัสดุน้ำยาทางห้องปฏิบัติการ</h3>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%" cellspacing="1" cellpadding="5px;">
                <tr>
                    <td style="width: 25%">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 30%">ประเภท</td>
                                <td><b>เวชภัณฑ์ทางพยาธิ</b></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">ที่เก็บ</td>
                                <td><b>คลังพยาธิวิทยา</b></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">จำนวนอย่างสูง</td>
                                <td><b><?= number_format($model != null ? $model->max_stock : 0, 0) ?></b></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">จำนวนอย่างต่ำ</td>
                                <td><b><?= number_format($model != null ? $model->min_stock : 0, 0) ?></b></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 25%">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 30%;color: white;">line1</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;color: white;">line2</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">ชื่อรายการ</td>
                                <td><b><?= $model != null ? $model->name : '' ?></b></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">ขนาดบรรจุ</td>
                                <td><b><?= number_format($model != null ? $model->pack_size : 0, 0) ?></b></td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 25%">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 30%;color: white;">line1</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;color: white;">line1</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">line1</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">line1</td>
                                <td>
                                    <b><?= $model != null ? \backend\models\Unit::findUnitName($model->unit_id) : '' ?></b>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 25%">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 30%">ส่วนราชการ</td>
                                <td><b>รพ.ค่ายพิชัยดาบหัก</b></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">หน่วยงาน</td>
                                <td><b>แผนกพยาธิวิทยา</b></td>
                            </tr>
                            <tr>
                                <td style="width: 30%;color: white;">จำนวนอย่างสูง</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">แผ่นที่</td>
                                <td></td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <table style="border: 1px solid black;width: 100%">
                <tr>
                    <td rowspan="2" style="border: 1px solid black;width: 10%;text-align: center"><b>วันที่</b></td>
                    <td colspan="5" style="border: 1px solid black;text-align: center;padding: 10px;">
                        <b>รายการรับ</b></td>
                    <td colspan="4" style="border: 1px solid black;text-align: center;padding: 10px;">
                        <b>รายการจ่าย</b></td>
                    <td rowspan="2" style="border: 1px solid black;width: 10%;text-align: center">
                        <b>จำนวนคงเหลือ</b></td>
                </tr>
                <tr>
                    <td style="border: 1px solid black;text-align: center;padding: 10px;">เลขที่ใบเบิก</td>
                    <td style="border: 1px solid black;text-align: center;padding: 10px;">Lot No.</td>
                    <td style="border: 1px solid black;text-align: center;padding: 10px;">Exp. Date</td>
                    <td style="border: 1px solid black;text-align: center;padding: 10px;">จำนวน</td>
                    <td style="border: 1px solid black;text-align: center;padding: 10px;">ผู้รับ</td>
                    <td style="border: 1px solid black;text-align: center;padding: 10px;">Lot No.</td>
                    <td style="border: 1px solid black;text-align: center;padding: 10px;">Exp. Date</td>
                    <td style="border: 1px solid black;text-align: center;padding: 10px;">จำนวน</td>
                    <td style="border: 1px solid black;text-align: center;padding: 10px;">ผู้จ่าย</td>

                </tr>
                <?php
                $trans_date = getTransdate($model);
                ?>
                <?php if ($trans_date != null): ?>
                    <?php for ($i = 0; $i <= count($trans_date) - 1; $i++): ?>
                        <?php
                        $rc_data = [];
                        $rc_data = getRCitem($trans_date[$i]['trans_date'], 1, 1); //1 = RC module 2 = IS module
                        $is_data = getISitem($trans_date[$i]['trans_date'], 1, 2); //1 = RC module 2 = IS module
//                    echo count($is_data); return;
                        ?>

                        <?php if (count($rc_data) >= count($is_data)): ?>
                            <?php if ($rc_data != null): ?>
                                <?php
                                $prev_date = '';
                                $show_date = '';
                                ?>
                                <?php for ($x = 0; $x <= count($rc_data) - 1; $x++): ?>
                                    <?php
                                    if ($prev_date == $trans_date[$i]['trans_date']) {
                                        $show_date = '';
                                    } else {
                                        $show_date = date('d/m/Y', strtotime($trans_date[$i]['trans_date']));
                                    }
                                    ?>
                                    <tr>
                                        <td style="border: 1px solid black;text-align: center;padding:10px;"><?= $show_date ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($rc_data[$x]['issue_ref_no']) ? $rc_data[$x]['issue_ref_no'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($rc_data[$x]['lot_no']) ? $rc_data[$x]['lot_no'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($rc_data[$x]['exp_date']) ? $rc_data[$x]['exp_date'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($rc_data[$x]['qty']) ? $rc_data[$x]['qty'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center">Admin</td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($is_data[$x]['lot_no']) ? $is_data[$x]['lot_no'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($is_data[$x]['exp_date']) ? $is_data[$x]['exp_date'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($is_data[$x]['qty']) ? $is_data[$x]['qty'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center">Admin</td>
                                        <td style="border: 1px solid black;text-align: center"></td>
                                    </tr>
                                    <?php
                                    $prev_date = $trans_date[$i]['trans_date'];
                                    ?>
                                <?php endfor; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (count($is_data) >= count($rc_data)): ?>
                            <?php if ($is_data != null): ?>
                                <?php
                                $prev_date = '';
                                $show_date = '';
                                ?>
                                <?php for ($x = 0; $x <= count($is_data) - 1; $x++): ?>
                                    <?php
                                    if ($prev_date == $trans_date[$i]['trans_date']) {
                                        $show_date = '';
                                    } else {
                                        $show_date = date('d/m/Y', strtotime($trans_date[$i]['trans_date']));
                                    }
                                    ?>
                                    <tr>
                                        <td style="border: 1px solid black;text-align: center;padding:10px;"><?= $show_date ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($rc_data[$x]['issue_ref_no']) ? $rc_data[$x]['issue_ref_no'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($rc_data[$x]['lot_no']) ? $rc_data[$x]['lot_no'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($rc_data[$x]['exp_date']) ? $rc_data[$x]['exp_date'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($rc_data[$x]['qty']) ? $rc_data[$x]['qty'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center">Admin</td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($is_data[$x]['lot_no']) ? $is_data[$x]['lot_no'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($is_data[$x]['exp_date']) ? $is_data[$x]['exp_date'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center"><?= !empty($is_data[$x]['qty']) ? $is_data[$x]['qty'] : '' ?></td>
                                        <td style="border: 1px solid black;text-align: center">Admin</td>
                                        <td style="border: 1px solid black;text-align: center"></td>
                                    </tr>
                                <?php endfor; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                    <?php endfor; ?>
                <?php endif; ?>


            </table>
        </div>
    </div>
</div>


<br/>
<div class="row">
    <div class="col-lg-12">
        <div class="btn-group">
            <button id="btn-print" class="btn btn-primary" onclick="printContent('div1')">พิมพ์</button>
            <div id="btn-export-excel" class="btn btn-warning">Export</div>
        </div>

    </div>
</div>

<?php
function getTransdate($model)
{
    $data = [];

    if ($model) {
        $model = \backend\models\Stocktrans::find()->select('date(trans_date) as trans_date')->where(['item_id' => $model->id])->groupBy(['date(trans_date)'])->orderBy('trans_date')->all();
        if ($model) {
            foreach ($model as $value) {
                array_push($data, ['trans_date' => $value->trans_date]);
            }
        }
    }

    return $data;
}

function getRCitem($trans_date, $item_id, $module_type)
{
    $data = [];
    if ($trans_date != null && $item_id != null && $module_type != null) {
        $model = \backend\models\Stocktrans::find()->where(['date(trans_date)' => date('Y-m-d', strtotime($trans_date)), 'item_id' => $item_id, 'trans_module_type_id' => $module_type])->all();
        if ($model) {
            foreach ($model as $value) {
                array_push($data, [
                    'issue_ref_no' => $value->issue_ref_no,
                    'lot_no' => $value->lot_no,
                    'exp_date' => $value->exp_date,
                    'qty' => $value->qty, 'created_by' => 1
                ]);
            }
        }
    }

    return $data;
}

function getISitem($trans_date, $item_id, $module_type)
{
    $data = [];
    if ($trans_date != null && $item_id != null && $module_type != null) {
        $model = \backend\models\Stocktrans::find()->where(['date(trans_date)' => date('Y-m-d', strtotime($trans_date)), 'item_id' => $item_id, 'trans_module_type_id' => $module_type])->all();
        if ($model) {
            foreach ($model as $value) {
                array_push($data, [
                    'issue_ref_no' => $value->issue_ref_no,
                    'lot_no' => $value->lot_no,
                    'exp_date' => $value->exp_date,
                    'qty' => $value->qty, 'created_by' => 1
                ]);
            }
        }
    }

    return $data;
}

?>

<?php
$this->registerJsFile(\Yii::$app->request->baseUrl . '/js/jquery.table2excel.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$js = <<<JS
 $(function(){
    
    $("#btn-export-excel").click(function(){
          $("#table-data").table2excel({
            // exclude CSS class
            exclude: ".noExl",
            name: "Excel Document Name"
          });
    });
   
 });
function printContent(el)
      {
         var restorepage = document.body.innerHTML;
         var printcontent = document.getElementById(el).innerHTML;
         document.body.innerHTML = printcontent;
         window.print();
         document.body.innerHTML = restorepage;
     }
JS;
$this->registerJs($js, static::POS_END);
?>
