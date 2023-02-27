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
                        <tr>
                            <td style="border: 1px solid black;text-align: center;padding:10px;"><?= date('d/m/Y',strtotime($trans_date[$i]['trans_date'])) ?></td>
                            <td style="border: 1px solid black;text-align: center">IS-23-00001</td>
                            <td style="border: 1px solid black;text-align: center">ABC001</td>
                            <td style="border: 1px solid black;text-align: center">31/05/2566</td>
                            <td style="border: 1px solid black;text-align: center">20</td>
                            <td style="border: 1px solid black;text-align: center">Admin</td>
                            <td style="border: 1px solid black;text-align: center"></td>
                            <td style="border: 1px solid black;text-align: center"></td>
                            <td style="border: 1px solid black;text-align: center"></td>
                            <td style="border: 1px solid black;text-align: center"></td>
                            <td style="border: 1px solid black;text-align: center"></td>
                        </tr>
                    <?php endfor; ?>
                <?php endif; ?>


            </table>
        </div>
    </div>

<br />
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

    $model = \backend\models\Stocktrans::find()->select('date(trans_date) as trans_date')->groupBy(['date(trans_date)'])->orderBy('trans_date')->all();
    if ($model) {
        foreach ($model as $value) {
            array_push($data, ['trans_date' => $value->trans_date]);
        }
    }
    return $data;
}

?>