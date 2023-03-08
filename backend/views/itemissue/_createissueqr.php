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
        $product_name = $model->name;
        $pack_size = $model->pack_size;
        $unit_name = \backend\models\Unit::findUnitName($model->unit_id);
    }
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
<form id="save-issue" method="post" action="#">
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
            <input type="text" class="form-control" value="<?= $product_code; ?>" readonly>
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
            <input type="text" class="form-control" value="<?= $product_code; ?>" readonly>
        </div>
        <div class="col-lg-3">
            <label for="">เลือก LotNo</label>
            <select class="form-control" id="select-lot-no" name="select_lot_no" required>
                <option value="-1">--เลือก LotNo--</option>
            </select>
        </div>
        <div class="col-lg-3">
            <label for="">จำนวน</label>
            <input type="number" class="form-control" value="0" min="1">
        </div>
        <div class="col-lg-3">
            <label for="">หน่วยนับ</label>
            <input type="text" class="form-control" value="<?= $unit_name; ?>" readonly>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-3">
            <input type="submit" class="btn btn-success" value="บันทึกเบิกยา">
        </div>
    </div>
</form>


<?php
$url_to_get_line_lot = \yii\helpers\Url::to(['medical/get-line-lot'], true);
$js = <<<JS
$(function(){
    var product_id = $(".product-id").val();
    if(product_id != ''){
        alert(product_id);
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
JS;
$this->registerJs($js, static::POS_END);
?>