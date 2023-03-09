<?php
//echo odaialali\qrcodereader\QrReader::widget([
//    'id' => 'qrInput',
//    'successCallback' => "function(data){ $('#qrInput').val(data) }"
//]);
?>
<div class="row">
    <div class="col-lg-4"></div>
    <div class="col-lg-4" style="text-align: center;"><h5>Scan QRCode จ่ายยา</h5></div>
    <div class="col-lg-4"></div>
</div>
<br />
<div class="row">
    <div class="col-lg-12">
        <div style="100%" id="reader"></div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form id="form-qr-res" action="index.php?r=itemissue/createissueqr" method="post" enctype="multipart/form-data">
            <input type="hidden" class="qrcode-res" name="qrcode_txt" value="xxx">

        </form>

    </div>
</div>

<?php
$js=<<<JS
function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: decodedText`, decodedResult);
    // alert(decodedText);
    $(".qrcode-res").val(decodedText);
    if($(".qrcode-res").val() != ''){
         $("#form-qr-res").submit();
    }
}

var html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);
JS;

$this->registerJs($js,static::POS_END);

?>
