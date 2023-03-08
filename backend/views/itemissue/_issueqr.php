<?php
echo "Scan QRCode";
//echo odaialali\qrcodereader\QrReader::widget([
//    'id' => 'qrInput',
//    'successCallback' => "function(data){ $('#qrInput').val(data) }"
//]);
?>
<div class="row">
    <div class="col-lg-12">
        <div style="100%" id="reader"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form id="form-qr-res" method="post" action="index.php?r=itemissue/createissueqr">
            <input type="text" class="qrcode-res" name="qrcode_txt" form="form-control" value="xxx">
            <input type="submit" value="ok">
        </form>

    </div>
</div>





<?php
$js=<<<JS
function showProduct(e){
    var id = e.val();
    if(id !=''){
        $("form#form-qr-res").submit();
    }
}
function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: decodedText`, decodedResult);
    // alert(decodedText);
    $(".qrcode-res").val(decodedText);
    if($(".qrcode-res").val() != ''){
         $(".qrcode-res").val(decodedText);
         $("#form-qr-res").submit();
    }
}

// var html5QrcodeScanner = new Html5QrcodeScanner(
// 	"reader", { fps: 10, qrbox: 250 });
// html5QrcodeScanner.render(onScanSuccess);
JS;

$this->registerJs($js,static::POS_END);

?>
