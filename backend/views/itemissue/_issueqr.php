<?php
echo "Scan QRCode";
//echo odaialali\qrcodereader\QrReader::widget([
//    'id' => 'qrInput',
//    'successCallback' => "function(data){ $('#qrInput').val(data) }"
//]);
?>
<div style="width: 500px" id="reader"></div>


<?php
$js=<<<JS
function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: decodedText`, decodedResult);
}

var html5QrcodeScanner = new Html5QrcodeScanner(
	"reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess);
JS;

$this->registerJs($js,static::POS_END);

?>
