<?php
?>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;border: none;">
                <tr>
                    <td style="text-align: center;"><h3>แบบบันทึกควบคุมการเบิกจ่ายวัสดุน้ำยาทางห้องปฏิบัติการ</h3></td>
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
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">จำนวนอย่างต่ำ</td>
                                <td></td>
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
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">ขนาดบรรจุ</td>
                                <td></td>
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
                                <td style="width: 30%">เลขคุณลักษณะ</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width: 30%">หน่วยนับ</td>
                                <td></td>
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
    </div><br/>
    <div class="row">
        <div class="col-lg-12">
            <table style="border: 1px solid black;width: 100%">
                <tr>
                    <td rowspan="2" style="border: 1px solid black;width: 10%;text-align: center">วันที่</td>
                    <td colspan="5" style="border: 1px solid black;text-align: center;padding: 10px;">รายการรับ</td>
                    <td colspan="4" style="border: 1px solid black;text-align: center;padding: 10px;">รายการจ่าย</td>
                    <td rowspan="2" style="border: 1px solid black;width: 10%;text-align: center">จำนวนคงเหลือ</td>
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
                $trans_date = getTransdate();
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
                                <?php for ($x = 0; $x <= count($rc_data) - 1; $x++): ?>
                                    <tr>
                                        <td style="border: 1px solid black;text-align: center;padding:10px;"><?= date('d/m/Y', strtotime($trans_date[$i]['trans_date'])) ?></td>
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

                        <?php if (count($is_data) >= count($rc_data)): ?>
                            <?php if ($is_data != null): ?>
                                <?php for ($x = 0; $x <= count($is_data) - 1; $x++): ?>
                                    <tr>
                                        <td style="border: 1px solid black;text-align: center;padding:10px;"><?= date('d/m/Y', strtotime($trans_date[$i]['trans_date'])) ?></td>
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

    <br/>
    <div class="row">
        <div class="col-lg-12">
            <div class="btn-group">
                <div class="btn btn-primary">พิมพ์</div>
                <div class="btn btn-warning">Export</div>
            </div>

        </div>
    </div>

<?php
function getTransdate()
{
    $data = [];

    $model = \backend\models\Stocktrans::find()->select('date(trans_date) as trans_date')->where(['item_id' => 1])->groupBy(['date(trans_date)'])->orderBy('trans_date')->all();
    if ($model) {
        foreach ($model as $value) {
            array_push($data, ['trans_date' => $value->trans_date]);
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