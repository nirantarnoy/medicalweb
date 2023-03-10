<?php
$product_id = 0;
$product_name = '';
$product_cat = '';
$stock_qty = 0;
$unit_name = '';
$pack_size = 0;

if ($product_code != '') {
    $model = \backend\models\Medical::find()->where(['code' => trim($product_code)])->one();
    if ($model) {
        $product_id = $model->id;
        $product_name = $model->name;
        $pack_size = $model->pack_size;
        $unit_name = \backend\models\Unit::findUnitName($model->unit_id);
        $product_cat = \backend\models\MedicalCat::findName($model->medical_cat_id);
        $stock_qty = getSumQty($model->id);
    }
}

function getSumQty($product_id){
    $sum_qty = 0;
    if($product_id){
        $model = \backend\models\Stocksum::find()->where(['product_id'=>$product_id])->sum('qty');
        if($model){
            $sum_qty = $model;
        }
    }
    return $sum_qty;
}
?>
    <div class="row">
        <div class="col-lg-3">
            <a href="index.php?r=itemissue/issueqr" target="_self" class="btn btn-primary"><i class="fa fa-camera"></i>
                สแกน
                QR Code</a>
        </div>
    </div>
    <br/>
<form id="save-issue" method="post" action="<?=\yii\helpers\Url::to(['itemissue/createfromqr'],true)?>">
    <div class="row">
        <div class="col-lg-3">
            <label for="">รหัสยา</label>
            <input type="hidden" name="product_id" class="product-id" value="<?= $product_id ?>">
            <input type="text" class="form-control" value="<?= $product_code; ?>" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">ชื่อ</label>
            <input type="text" class="form-control" value="<?= $product_name; ?>" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">ประภทยา</label>
            <input type="text" class="form-control" value="<?= $product_cat; ?>" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">Pack Size</label>
            <input type="text" class="form-control" value="<?= $pack_size; ?>" readonly>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-3">
            <label for="">จำนวนคงเหลือ</label>
            <input type="text" class="form-control" value="<?= number_format($stock_qty,0); ?>" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">เลือก LotNo</label>
            <input type="hidden" class="lot-qty" name="lot_qty" value="">
            <select class="form-control" id="select-lot-no" name="select_lot_no" onchange="getlotqty($(this))" required>
                <option value="-1">--เลือก LotNo--</option>
            </select>
        </div>
        <div class="col-lg-3">
            <label for="">จำนวน</label>
            <input type="number" id="lot-issue-qty" name="issue_qty" class="form-control" value="0" min="1" onchange="checklotqty($(this))">
            <div class="alert-qty alert alert-danger" style="display: none;top: 5px;">จำนวนเบิกมากกว่าจำนวนคงเหลือ</div>
        </div>
        <div class="col-lg-3">
            <label for="">หน่วยนับ</label>
            <input type="text" class="form-control" value="<?= $unit_name; ?>" readonly>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-3">
            <input type="submit" class="btn btn-success btn-save" value="บันทึกเบิกยา">
        </div>
    </div>
</form>


<?php
$url_to_get_line_lot = \yii\helpers\Url::to(['medical/get-line-lot'], true);
$url_to_get_line_lot_qty = \yii\helpers\Url::to(['medical/get-lot-qty'], true);
$js = <<<JS
$(function(){
    var product_id = $(".product-id").val();
    if(product_id != ''){
      //  alert(product_id);
        $.ajax({
                      'type': 'post',
                      'dataType': 'html',
                      'async': false,
                      'url': '$url_to_get_line_lot',
                      'data': {'product_id': product_id},
                      'success': function(data){
                            if(data != ''){
                                $("#select-lot-no").html(data);
                            }
                      },
                      'error': function(err){
                                 //alert(data);//return;
                      }
                    });
    }
    
});
function getlotqty(e){
    var lot_id = e.val();
    if(lot_id > 0){
         $.ajax({
                      'type': 'post',
                      'dataType': 'html',
                      'async': false,
                      'url': '$url_to_get_line_lot_qty',
                      'data': {'lot_id': lot_id},
                      'success': function(data){
                            if(data != ''){
                                $(".lot-qty").val(data);
                                $("#lot-issue-qty").val(data);
                            }
                      },
                      'error': function(err){
                                 //alert(data);//return;
                      }
                    });
    }
}
function checklotqty(e){
    var issue_qty  = e.val();
    var lot_qty = $(".lot-qty").val();
    if(issue_qty > lot_qty){
        $(".alert-qty").show();
        $("")
        e.val(lot_qty);
        $(".btn-save").prop("disabled","disabled");
        return false;
    }else{
        $(".btn-save").prop("disabled","");
         $(".alert-qty").hide();
    }
}
JS;
$this->registerJs($js, static::POS_END);
?>