<?php
$model_data = \backend\models\Stocksum::find()->all();
?>
<html>
<head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print</title>
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        /*body {*/
        /*    font-family: sarabun;*/
        /*    !*font-family: garuda;*!*/
        /*    font-size: 18px;*/
        /*}*/
        #div1 {
            font-family: sarabun;
            /*font-family: garuda;*/
            font-size: 18px;
        }

        table.table-header {
            border: 0px;
            border-spacing: 1px;
        }

        table.table-footer {
            border: 0px;
            border-spacing: 0px;
        }

        table.table-header td, th {
            border: 0px solid #dddddd;
            text-align: left;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        table.table-title {
            border: 0px;
            border-spacing: 0px;
        }

        table.table-title td, th {
            border: 0px solid #dddddd;
            text-align: left;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            /*background-color: #dddddd;*/
        }

        table.table-detail {
            border-collapse: collapse;
            width: 100%;
        }

        table.table-detail td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 2px;
        }

    </style>
</head>
<body>
<div id="div1">
    <table style="width: 100%;border: 0px;">
        <tr>
            <td style="text-align: center;border: none;"><h4>รายงานแสดงสินค้าจำนวนต่ำกว่ากำหนด</h4></td>
        </tr>
        <tr>
            <td style="text-align: center;border: none;"><h4>คลังยาที่ 1</h4></td>
        </tr>
    </table>
    <br/>

    <table style="width: 100%" id="table-data">
        <tr>
            <td style="text-align: center;padding: 0px;border: 1px solid grey">ลำดับ</td>
            <td style="text-align: left;padding-left: 3px;border: 1px solid grey">รหัสยา</td>
            <td style="text-align: left;padding-left: 3px;border: 1px solid grey">ชื่อยา</td>
            <td style="text-align: center;padding: 0px;border: 1px solid grey">LotNo.</td>
            <td style="text-align: center;padding: 0px;border: 1px solid grey">วันหมดอายุ</td>
            <td style="text-align: right;padding-right: 3px;border: 1px solid grey">จำนวนขั้นต่ำ</td>
            <td style="text-align: right;padding-right: 3px;border: 1px solid grey">จำนวนคงเหลือ</td>
            <td style="text-align: center;padding: 0px;border: 1px solid grey">หมายเหตุ</td>

        </tr>
        <?php if($model_data!=null):?>
        <?php $i=0;?>
        <?php foreach ($model_data as $value):?>
                <?php $i+=1;?>
            <?php
                $line_min_qty = \backend\models\Medical::getMinstock($value->product_id);
                if($value->qty >= $line_min_qty)continue;
                ?>
            <tr>
                <td style="text-align: center;"><?=$i?></td>
                <td>
                    <?=\backend\models\Medical::findCode($value->product_id)?>
                </td>
                <td>
                    <?=\backend\models\Medical::findName($value->product_id)?>
                </td>
                <td>
                    <?=$value->lot_no?>
                </td>
                <td style="text-align: center;">
                    <?=$value->expired_date?>
                </td>
                <td style="text-align: right;">
                    <?=$line_min_qty?>
                </td>
                <td style="text-align: right;">
                    <?=number_format($value->qty)?>
                </td>
                <td></td>
            </tr>
        <?php endforeach;?>
        <?php endif;?>

    </table>
    <br/>

</div>
<br/>

<table width="100%" class="table-title">
    <td>
        <button class="btn btn-info" onclick="printContent('div1')">พิมพ์</button>
    </td>
    <td style="text-align: right">
        <button id="btn-export-excel-top" class="btn btn-secondary">Export Excel</button>
        <!--            <button id="btn-print" class="btn btn-warning" onclick="printContent('div1')">Print</button>-->
    </td>
</table>
</body>
</html>

<?php
function getOrderQty($order_id)
{
    $qty = 0;
    if ($order_id) {
        $model_qty = \backend\models\Orderline::find()->where(['order_id' => $order_id])->sum('qty');
        if ($model_qty) {
            $qty = $model_qty;
        }
    }
    return $qty;
}

function getOrderQty2($order_id,$product_id)
{
    $data = 0;
    if ($order_id) {
        $model_qty = \backend\models\Orderline::find()->where(['order_id' => $order_id,'product_id'=>$product_id])->sum('qty');
        if ($model_qty) {
            $data = $model_qty;
//           foreach($model_qty as $value){
//            //   $name = \backend\models\Product::findCode($value->product_id);
//               array_push($data,['product_name'=>$name,'qty'=>$value->qty]);
//           }
        }
    }
    return $data;
}

?>


<?php
//$js = <<<JS
//function printContent(el)
//      {
//         var restorepage = document.body.innerHTML;
//         var printcontent = document.getElementById(el).innerHTML;
//         document.body.innerHTML = printcontent;
//         window.print();
//         document.body.innerHTML = restorepage;
//     }
//JS;
//$this->registerJs($js, static::POS_END);
?>


<?php
$this->registerJsFile(\Yii::$app->request->baseUrl . '/js/jquery.table2excel.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$js = <<<JS
 $("#btn-export-excel").click(function(){
  $("#table-data-2").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Excel Document Name"
  });
});
$("#btn-export-excel-top").click(function(){
  $("#table-data").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Excel Document Name"
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

