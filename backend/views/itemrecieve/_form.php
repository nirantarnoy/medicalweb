<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Itemrecieve $model */
/** @var yii\widgets\ActiveForm $form */
?>

    <div class="itemrecieve-form">

        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'journal_no')->textInput(['maxlength' => true, 'readonly' => 'readonly']) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(), [
                    'pluginOptions' => [
                        'format' => 'dd/mm/yyyy',
                        'todayHighlight' => true
                    ]
                ]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'note')->textarea() ?>
            </div>
        </div>
        <br/>
        <h6>รายละเอียดรายการรับเข้า</h6>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped table-bordered" id="table-list">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>รหัสเวชภัณฑ์</th>
                        <th>ชื่อ</th>
                        <th>จำนวน</th>
                        <th>หน่วยนับ</th>
                        <th>เลขใบเบิก</th>
                        <th>LotNo.</th>
                        <th>ExpiredDate</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($model_line): ?>
                        <?php foreach ($model_line as $value): ?>
                            <tr data-var="<?= $value->id ?>">
                                <td></td>
                                <td>
                                    <input type="hidden" class="line-item-id" name="line_item_id[]"
                                           value="<?= $value->item_id ?>">
                                    <input type="hidden" class="line-unit-id" name="line_unit_id[]"
                                           value="<?= $value->unit_id ?>">
                                    <input type="text" class="form-control line-code" name="line_code[]"
                                           ondblclick="showfind($(this))"
                                           value="<?= \backend\models\Medical::findCode($value->item_id) ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-name" name="line_name[]" readonly
                                           value="<?= \backend\models\Medical::findName($value->item_id) ?>">
                                </td>
                                <td>
                                    <input type="number" class="form-control line-qty" name="line_qty[]" min="1"
                                           value="<?= $value->qty ?>" autocomplete="off" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control line-unit" name="line_unit[]"
                                           value="<?= \backend\models\Unit::findUnitName($value->unit_id) ?>">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-issue-ref-no" name="line_issue_ref_no[]" readonly
                                           value="<?= $value->issue_ref_no ?>" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control line-lot" name="line_lot[]"
                                           value="<?= $value->lot_no ?>" autocomplete="off">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-expired" name="line_expired[]"
                                           value="<?= date('d-m-Y',strtotime($value->exp_date)) ?>" autocomplete="off">
                                </td>
                                <td>
                                    <div class="btn btn-danger btn-sm" onclick="removeline($(this))"><i
                                                class="fa fa-trash"></i></div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td></td>
                            <td>
                                <input type="hidden" class="line-item-id" name="line_item_id[]">
                                <input type="hidden" class="line-unit-id" name="line_unit_id[]">
                                <input type="text" class="form-control line-code" name="line_code[]"
                                       ondblclick="showfind($(this))">
                            </td>
                            <td>
                                <input type="text" class="form-control line-name" name="line_name[]" readonly>
                            </td>
                            <td>
                                <input type="number" class="form-control line-qty" name="line_qty[]" min="1" autocomplete="off" required>
                            </td>
                            <td>
                                <input type="text" class="form-control line-unit" name="line_unit[]">
                            </td>
                            <td>
                                <input type="text" class="form-control line-issue-ref-no" name="line_issue_ref_no[]"
                                       value="" required>
                            </td>
                            <td>
                                <input type="text" class="form-control line-lot" name="line_lot[]" autocomplete="off">
                            </td>
                            <td>
                                <input type="text" class="form-control line-expired" name="line_expired[]" autocomplete="off">
                            </td>
                            <td>
                                <div class="btn btn-danger btn-sm" onclick="removeline($(this))"><i
                                            class="fa fa-trash"></i></div>
                            </td>

                        </tr>
                    <?php endif; ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="7">
                            <div class="btn btn-primary"
                                 onclick="addline($(this))">
                                <i class="fa fa-plus-circle"></i>
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


    <div id="findModal"
         class="modal fade"
         role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row"
                         style="width: 100%">
                        <div class="col-lg-11">
                            <div class="input-group">
                                <input type="text"
                                       class="form-control search-item"
                                       placeholder="ค้นหารหัส">
                                <span class="input-group-addon">
                                        <button type="submit"
                                                class="btn btn-primary btn-search-submit">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </span>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <button type="button"
                                    class="close"
                                    data-dismiss="modal">
                                &times;
                            </button>
                        </div>
                    </div>

                </div>
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
                <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->

                <div class="modal-body">

                    <input type="hidden"
                           name="line_qc_product"
                           class="line_qc_product"
                           value="">
                    <table class="table table-bordered table-striped table-find-list"
                           width="100%">
                        <thead>
                        <tr>
                            <th style="text-align: center">
                                เลือก
                            </th>
                            <th>
                                รหัสสินค้า
                            </th>
                            <th>
                                รายละเอียด
                            </th>
                            <th>
                                ราคา
                            </th>

                            <th>
                                จำนวนคงเหลือ
                            </th>
                            <th>
                                LotNo.
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-success btn-product-selected"
                            data-dismiss="modalx"
                            disabled>
                        <i
                                class="fa fa-check"></i>
                        ตกลง
                    </button>
                    <button type="button"
                            class="btn btn-default"
                            data-dismiss="modal">
                        <i
                                class="fa fa-close text-danger"></i>
                        ปิดหน้าต่าง
                    </button>
                </div>
            </div>

        </div>
    </div>
<?php
$url_to_Dropoffdata = \yii\helpers\Url::to(['dropoffplace/getdropoffdata'], true);
$url_to_find_item = \yii\helpers\Url::to(['medical/find-item'], true);
$js = <<<JS
 var removelist = [];
  var selecteditem = [];

$(function(){
    // $('.start-date').datepicker({dateformat: 'dd-mm-yy'});
    // $('.expire-date').datepicker({dateFormat: 'dd-mm-yy'});
    
    $(".btn-search-submit").click(function (){
        var txt = $(".search-item").val();
        showfindwithsearch(txt);
    });
    
    // var TinyDatePicker = DateRangePicker.TinyDatePicker;
    //   TinyDatePicker('.line-expired', {
    //     mode: 'dp-below',
    //   })
    //   .on('statechange', function(ev) {
    //      
    //   })   
    
    $('.line-expired').datepicker({'format': 'dd-mm-yyyy'});
});

function showfind(e){
   
      $.ajax({
              'type':'post',
              'dataType': 'html',
              'async': false,
              'url': "$url_to_find_item",
              'data': {'txt':''},
              'success': function(data) {
                  // alert(data);
                   $(".table-find-list tbody").html(data);
                   $("#findModal").modal("show");
                 }
              });
      
  }
function showfindwithsearch(txt){
   
      $.ajax({
              'type':'post',
              'dataType': 'html',
              'async': false,
              'url': "$url_to_find_item",
              'data': {'txt': txt},
              'success': function(data) {
                  // alert(data);
                   $(".table-find-list tbody").html(data);
                   $("#findModal").modal("show");
                 }
              });
      
}  
  function addselecteditem(e) {
        var id = e.attr('data-var');
        var code = e.closest('tr').find('.line-find-code').val();
        var name = e.closest('tr').find('.line-find-name').val();
        var price = e.closest('tr').find('.line-find-price').val();
        var unit_id = e.closest('tr').find('.line-unit-id').val();
        var unit_name = e.closest('tr').find('.line-unit-name').val();
        var lot_no = e.closest('tr').find('.line-lot-no').val();
        
       // alert(lot_no);
        
        if (id) {
          // alert(id);
            if (e.hasClass('btn-outline-success')) {
                //alert('has');
                var obj = {};
                obj['id'] = id;
                obj['code'] = code;
                obj['name'] = name;
                obj['price'] = price;
                obj['unit_id'] = unit_id;
                obj['unit_name'] = unit_name;
                obj['lot_no'] = lot_no;
                selecteditem.push(obj);
                
                e.removeClass('btn-outline-success');
                e.addClass('btn-success');
                disableselectitem();
                console.log(selecteditem);
            } else {
                //selecteditem.pop(id);
                $.each(selecteditem, function (i, el) {
                    if (this.id == id) {
                        selecteditem.splice(i, 1);
                    }
                });
                e.removeClass('btn-success');
                e.addClass('btn-outline-success');
                disableselectitem();
                console.log(selecteditem);
            }
        }
    }
     function disableselectitem() {
        if (selecteditem.length > 0) {
            $(".btn-product-selected").prop("disabled", "");
            $(".btn-product-selected").removeClass('btn-outline-success');
            $(".btn-product-selected").addClass('btn-success');
        } else {
            $(".btn-product-selected").prop("disabled", "disabled");
            $(".btn-product-selected").removeClass('btn-success');
            $(".btn-product-selected").addClass('btn-outline-success');
        }
    }
    $(".btn-product-selected").click(function () {
        var linenum = 0;
        if (selecteditem.length > 0) {
            for (var i = 0; i <= selecteditem.length - 1; i++) {
                var line_prod_id = selecteditem[i]['id'];
                var line_prod_code = selecteditem[i]['code'];
                var line_prod_name = selecteditem[i]['name'];
                var line_prod_price = selecteditem[i]['price'];
                var line_unit_id = selecteditem[i]['unit_id'];
                var line_unit_name = selecteditem[i]['unit_name'];
                var line_lot_no = selecteditem[i]['lot_no'];
                
                 if(check_dup(line_prod_id) == 1){
                        alert("รายการสินค้า " +line_prod_code+ " มีในรายการแล้ว");
                        return false;
                 }
                
               // alert(line_lot_no);
                var tr = $("#table-list tbody tr:last");
                
                if (tr.closest("tr").find(".line-code").val() == "") {
                    tr.closest("tr").find(".line-item-id").val(line_prod_id);
                    tr.closest("tr").find(".line-code").val(line_prod_code);
                    tr.closest("tr").find(".line-name").val(line_prod_name);
                    tr.closest("tr").find(".line-unit").val(line_unit_name);
                    tr.closest("tr").find(".line-unit-id").val(line_unit_id);
                    tr.closest("tr").find(".line-lot").val(line_lot_no);
                   

                    //cal_num();
                    console.log(line_prod_code);
                } else {
                   // alert("dd");
                    console.log(line_prod_code);
                    //tr.closest("tr").find(".line_code").css({'border-color': ''});

                    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
                    clone.find(".line-item-id").val(line_prod_id);
                    clone.find(".line-code").val(line_prod_code);
                    clone.find(".line-name").val(line_prod_name);
                    clone.find(".line-lot-no").val('');
                   
                    clone.attr("data-var", "");
                    clone.find('.rec-id').val("");
                    clone.find('.line-expired').datepicker({'format': 'dd-mm-yyyy'});
//                    clone.find(".line-price").on("keypress", function (event) {
//                        $(this).val($(this).val().replace(/[^0-9\.]/g, ""));
//                        if ((event.which != 46 || $(this).val().indexOf(".") != -1) && (event.which < 48 || event.which > 57)) {
//                            event.preventDefault();
//                        }
//                    });

                    tr.after(clone);
                    //cal_num();
                }
            }
        
        }
        $("#table-list tbody tr").each(function () {
            linenum += 1;
            $(this).closest("tr").find("td:eq(0)").text(linenum);
            // $(this).closest("tr").find(".line-prod-code").val(line_prod_code);
        });
        selecteditem.length = 0;

        $("#table-find-list tbody tr").each(function () {
            $(this).closest("tr").find(".btn-line-select").removeClass('btn-success');
            $(this).closest("tr").find(".btn-line-select").addClass('btn-outline-success');
        });
        $(".btn-product-selected").removeClass('btn-success');
        $(".btn-product-selected").addClass('btn-outline-success');
        $("#findModal").modal('hide');
    });
    function cal_linenum() {
        var xline = 0;
        $("#table-list tbody tr").each(function () {
            xline += 1;
            $(this).closest("tr").find("td:eq(0)").text(xline);
        });
    }
    function removeline(e) {
        if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
            if (e.parent().parent().attr("data-var") != '') {
                removelist.push(e.parent().parent().attr("data-var"));
                $(".remove-list").val(removelist);
            }
            // alert(removelist);

            if ($("#table-list tbody tr").length == 1) {
                $("#table-list tbody tr").each(function () {
                    $(this).find(":text").val("");
                   // $(this).find(".line-prod-photo").attr('src', '');
                    $(this).find(".line-price").val(0);
                   // cal_num();
                });
            } else {
                e.parent().parent().remove();
            }
            cal_linenum();
            
        }
    }
  function check_dup(prod_id){
      var _has = 0;
      $("#table-list tbody tr").each(function(){
          var p_id = $(this).closest('tr').find('.line-item-id').val();
         // alert(p_id + " = " + prod_id);
          if(p_id == prod_id){
              _has = 1;
          }
      });
      return _has;
    }
    
    
    
function addline(e){
    var tr = $("#table-list tbody tr:last");
                if(tr.find(".line-code").val() == ""){
                    tr.find(".line-code").focus();
                    return false;
                }
                    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
                    clone.find("td:eq(0)").text("");
                    clone.find(".line-code").val("");
                    clone.find(".line-name").val("");
                    clone.find(".line-qty").val("0");
                    clone.find(".line-unit").val("");
                    clone.find(".line-lot").val("");
                    clone.find(".line-expired").val("");
                    
                  
                    clone.attr("data-var", "");
                    clone.find('.rec-id').val("");
                    
                    tr.after(clone);
     
}
function removeline(e) {
        if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
            if (e.parent().parent().attr("data-var") != '') {
                removelist.push(e.parent().parent().attr("data-var"));
                $(".remove-list").val(removelist);
            }
            // alert(removelist);
            // alert(e.parent().parent().attr("data-var"));

            if ($("#table-list tbody tr").length == 1) {
                $("#table-list tbody tr").each(function () {
                    $(this).find(":text").val("");
                   // $(this).find(".line-prod-photo").attr('src', '');
                    $(this).find(".line-price").val(0);
                    // cal_num();
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_linenum();
            // cal_all();
        }
    }
    
    function getDropoffinfo(e){
    // alert(e.val());
    if(e.val() != ''){
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'url': '$url_to_Dropoffdata',
            'data': {'drop_off_id': e.val()},
            // alert(data)
            'success': function(data){
                if(data != null){
                    // alert(data[0]['oil_rate']);
                    var oil_rate = data[0]['oil_rate'];
                    var hp = data[0]['hp'];
                    e.closest('tr').find('.oil-rate').val(oil_rate);
                    e.closest('tr').find('.hp').val(hp);
                }
            },
            'error': function(data){
                 alert(data);//return;
            }
        });
    }
}


JS;

$this->registerJs($js, static::POS_END);

?>