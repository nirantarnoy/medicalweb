<?php

use yii\helpers\Url;
use miloschuman\highcharts\Highcharts;

$this->title = 'ภาพรวมระบบ';
$dash_date = null;
$f_date = null;
$t_date = null;
if ($f_date != null && $t_date != null) {
    $dash_date = date('d/m/Y', strtotime($f_date)) . ' - ' . date('d/m/Y', strtotime($t_date));
}


?>
<br/>
<!--<input type="text" class="form-control qr-read" value="" onchange="showqr($(this))">-->
<!--<p class="show-qr-code"></p>-->
<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= number_format(0) ?></h3>
                        <p>จำนวนกลุ่มทั้งหมด</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?= Url::to(['product/index'], true) ?>" class="small-box-footer">รายละเอียด <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= number_format(0) ?></h3>
                        <!--                        <sup style="font-size: 20px">%</sup>-->
                        <p>จำนวนเวชภัณฑ์ทั้งหมด</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?= Url::to(['deliveryroute/index'], true) ?>" class="small-box-footer">รายละเอียด <i
                                class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>

    </div>
    <form id="form-dashboard" action="<?= Url::to(['site/index'], true) ?>" method="post">
        <div class="row">
            <div class="col-lg-4">
                <div class="label">เลือกดูตามช่วงวันที่</div>
                <?php
                echo \kartik\daterange\DateRangePicker::widget([
                    'name' => 'dashboard_date',
                    'value' => $dash_date,
                    'pluginOptions' => [
                        'format' => 'DD/MM/YYYY',
                        'locale' => [
                            'format' => 'DD/MM/YYYY'
                        ],
                    ],
                    'presetDropdown' => true,
                    'options' => [
                        'class' => 'form-control',
                        'onchange' => '$("#form-dashboard").submit();'
                    ]
                ]);
                ?>
            </div>
        </div>
    </form>
    <br>

</div>
<br/>
<!--<div class="row">-->
<!--    <div class="col-lg-12">-->
<!--        <form action="--><? //=Url::to(['site/getcominfo'],true)?><!--">-->
<!--            <button class="btn btn-success">Get Mac</button>-->
<!--        </form>-->
<!--    </div>-->
<!--</div>-->
<!--<button onclick="takeshot()">-->
<!--    Take Screenshot-->
<!--</button>-->
<!--<div id="div1">-->
<!--    niran tarlek-->
<!--    <table class="table">-->
<!--        <tr>-->
<!--            <td>dfdfd</td>-->
<!--            <td>fdfd</td>-->
<!--            <td>fdfdfd</td>-->
<!--        </tr>-->
<!--    </table>-->
<!--</div>-->
<?php
$this->registerJsFile(\Yii::$app->request->baseUrl . '/js/jquery.html2canvas.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$url_to_save_screenshort = \yii\helpers\Url::to(['site/createscreenshort'], true);
$js = <<<JS
$(function(){
    //aleret();
   
});
function takeshot() {
    const input = document.getElementById('div1');
    const area = input.getBoundingClientRect()
      html2canvas(input,{
          useCORS: true,
          scrollX: 0,
          scrollY: 0,
          width: area.width,
          height: area.height
      }).then((canvas) => {
            console.log("done ... ");
            var img = canvas.toDataURL("image/png");//here set the image extension and now image data is in var img that will send by our ajax call to our api or server site page
              $.ajax({
                    type: 'POST',
                    url: "$url_to_save_screenshort",//path to send this image data to the server site api or file where we will get this data and convert it into a file by base64
                    data:{
                      "img":img
                    },
                    success:function(data){
                        
                    alert(data);
                    //$("#dis").html(data);
                    }
              });
        });
        
     }
     
     function showqr(e){
       var res = e.val().split(',');
       $(".show-qr-code").html(res[0]);
     }
JS;

$this->registerJs($js, static::POS_END);
?>
