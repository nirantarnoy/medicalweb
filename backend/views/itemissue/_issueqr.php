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
        <form id="form-qr-res" action="index.php?r=itemissue/createissueqr" method="post" enctype="multipart/form-data">
            <input type="hidden" class="qrcode-res" name="qrcode_txt" form="form-control" value="xxx">
            <input type="hidden" class="xxx" name="xxx" value="">
            <input type="submit" value="ok">
        </form>

    </div>
</div>





<?php
$js=<<<JS
function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: decodedText`, decodedResult);
    // alert(decodedText);
    $(".xxx").val(decodedText);
    if($(".xxx").val() != ''){
         $("#form-qr-res").submit();
    }
}

var html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);
JS;

$this->registerJs($js,static::POS_END);

?>
