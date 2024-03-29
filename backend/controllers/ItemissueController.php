<?php

namespace backend\controllers;

use backend\models\Itemissue;
use backend\models\ItemissueSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemissueController implements the CRUD actions for Itemissue model.
 */
class ItemissueController extends Controller
{
    public $enableCsrfValidation = false;

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Itemissue models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new ItemissueSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Itemissue model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Itemissue model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Itemissue();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $item_id = \Yii::$app->request->post('line_item_id');
                $line_qty = \Yii::$app->request->post('line_qty');
                $line_unit_id = \Yii::$app->request->post('line_unit_id');
                $line_lot_id = \Yii::$app->request->post('line_lot');
                $line_expired = \Yii::$app->request->post('line_expired');


                $tdate = date('Y-m-d');
                $xdate = explode('-', $model->trans_date);
                if (count($xdate) > 1) {
                    $tdate = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0];
                }

                $model->journal_no = $model::getLastNo();
                $model->trans_date = date('Y-m-d', strtotime($tdate));
                $model->status = 1;

                if ($model->save(false)) {
                    if ($item_id != null) {
                        for ($i = 0; $i <= count($item_id) - 1; $i++) {

                            $line_exp_date = date('Y-m-d');
                            $xprdate = explode('-',$line_expired[$i]);
                            if(count($xprdate)>1){
                                $line_exp_date = $xprdate[2].'/'.$xprdate[1].'/'.$xprdate[0];
                            }

                            $line_lot_no = $this->findlotnofromid($line_lot_id[$i]);
                            $model_line = new \common\models\JournalIssueLine();
                            $model_line->issue_id = $model->id;
                            $model_line->item_id = $item_id[$i];
                            $model_line->qty = $line_qty[$i];
//                            $model_line->unit_id = $line_unit_id[$i];
                            $model_line->lot_no = $line_lot_no;
                            $model_line->exp_date = date('Y-m-d');
                            if ($model_line->save(false)) {
                                $model_trans = new \backend\models\Stocktrans();
                                $model_trans->journal_no = \backend\models\Stocktrans::getLastNo();
                                $model_trans->trans_date = date('Y-m-d', strtotime($tdate));
                                $model_trans->activity_type_id = 2;
                                $model_trans->trans_module_type_id = 2; // 1 receive
                                $model_trans->item_id = $item_id[$i];
                                $model_trans->qty = $line_qty[$i];
                                $model_trans->lot_no = $line_lot_no;
                                $model_trans->exp_date = date('Y-m-d',strtotime($line_exp_date));
                                if ($model_trans->save(false)) {
                                    $this->updatestock($item_id[$i], $line_qty[$i], $line_lot_no, $model_trans->id);
                                }
                            }
                        }
                    }

                    return $this->redirect(['view', 'id' => $model->id]);
                }

            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function updatestock($item_id, $qty, $lot_no, $trans_ref_id)
    {
        if ($item_id && $qty) {
            $model = \backend\models\Stocksum::find()->where(['product_id' => $item_id, 'lot_no' => $lot_no])->one();
            if ($model) {
                $model->qty = ($model->qty - $qty);
                $model->save(false);
            }
        }
    }

    public function findlotnofromid($lot_line_id)
    {
        $name = '';
        if ($lot_line_id) {
            $model = \backend\models\Stocksum::find()->select('lot_no')->where(['id' => $lot_line_id])->one();
            if ($model) {
                $name = $model->lot_no;
            }
        }
        return $name;
    }

    public function findlotnoExpirefromid($lot_line_id)
    {
        $name = '';
        if ($lot_line_id) {
            $model = \backend\models\Stocksum::find()->select('expired_date')->where(['id' => $lot_line_id])->one();
            if ($model) {
                $name = $model->expired_date;
            }
        }
        return $name;
    }

    /**
     * Updates an existing Itemissue model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model_line = \common\models\JournalIssueLine::find()->where(['issue_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $item_id = \Yii::$app->request->post('line_item_id');
            $line_qty = \Yii::$app->request->post('line_qty');
            $line_unit_id = \Yii::$app->request->post('line_unit_id');
            $line_lotno = \Yii::$app->request->post('line_lot');
            $line_expired = \Yii::$app->request->post('line_expired');

            $removelist = \Yii::$app->request->post('remove_list');
//            print_r($removelist);return;

            $tdate = date('Y-m-d');
            $xdate = explode('-', $model->trans_date);
            if (count($xdate) > 1) {
                $tdate = $xdate[2] . '/' . $xdate[1] . '/' . $xdate[0];
            }

            $model->trans_date = date('Y-m-d', strtotime($tdate));
            $model->status = 1;
            if ($model->save(false)) {
                if ($item_id != null) {
                    for ($i = 0; $i <= count($item_id) - 1; $i++) {
                        $line_exp_date = date('Y-m-d');
                        $xprdate = explode('-',$line_expired[$i]);
                        if(count($xprdate)>1){
                            $line_exp_date = $xprdate[2].'/'.$xprdate[1].'/'.$xprdate[0];
                        }
                        $model_line_chk = \common\models\JournalIssueLine::find()->where(['issue_id' => $model->id, 'item_id' => $item_id[$i]])->one();
                        if ($model_line_chk) {
                            $model_line_chk->item_id = $item_id[$i];
                            $model_line_chk->qty = $line_qty[$i];
                            $model_line_chk->lot_no = $line_lotno[$i];
                            $model_line_chk->exp_date =date('Y-m-d',strtotime($line_exp_date));
                            $model_line_chk->status = 1;
                            if ($model_line_chk->save(false)) {
                                $model_trans = new \backend\models\Stocktrans();
                                $model_trans->journal_no = \backend\models\Stocktrans::getLastNo();
                                $model_trans->trans_date = date('Y-m-d', strtotime($tdate));
                                $model_trans->activity_type_id = 1;
                                $model_trans->trans_module_type_id = 2; // 1 receive
                                $model_trans->item_id = $item_id[$i];
                                $model_trans->qty = $line_qty[$i];
                                $model_trans->lot_no = $line_lotno[$i];
                                $model_trans->exp_date = date('Y-m-d',strtotime($line_exp_date));
                                if ($model_trans->save(false)) {
//                                    $this->updatestock($item_id[$i], $line_qty[$i], $line_unit_id[$i], $line_lotno[$i], $line_expired[$i], $model_trans->id);
                                }
                            }
                        } else {
                            $model_line = new \common\models\JournalIssueLine();
                            $model_line->issue_id = $model->id;
                            $model_line->item_id = $item_id[$i];
                            $model_line->qty = $line_qty[$i];
//                            $model_line->unit_id = $line_unit_id[$i];
                            $model_line->lot_no = $line_lotno[$i];
                            $model_line->exp_date = date('Y-m-d',strtotime($line_exp_date));
                            if ($model_line->save(false)) {
                                $model_trans = new \backend\models\Stocktrans();
                                $model_trans->journal_no = \backend\models\Stocktrans::getLastNo();
                                $model_trans->trans_date = date('Y-m-d', strtotime($tdate));
                                $model_trans->activity_type_id = 1;
                                $model_trans->trans_module_type_id = 2; // 1 receive
                                $model_trans->item_id = $item_id[$i];
                                $model_trans->qty = $line_qty[$i];
                                $model_trans->lot_no = $line_lotno[$i];
                                $model_trans->exp_date = date('Y-m-d',strtotime($line_exp_date));
                                if ($model_trans->save(false)) {
//                                    $this->updatestock($item_id[$i], $line_qty[$i], $line_unit_id[$i], $line_lotno[$i], $line_expired[$i], $model_trans->id);
                                }
                            }
                        }
                    }
                }
            }
            $delete_rec = explode(",", $removelist);
            if (count($delete_rec)) {
                \common\models\JournalIssueLine::deleteAll(['id' => $delete_rec]);
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }


    public function actionNotifymessagestockalert()
    {
        //$message = "This is test send request from camel paperless";
        $line_api = 'https://notify-api.line.me/api/notify';

        $line_token = 'xSrX0gLB4Rii37Lww8lYAMFNrbDU2AT2KqtDFN72xD2';


        $message = '' . "\n";
        $message .= 'แจ้งเตือนเวชภัณฑ์ต่ำกว่า minimum stock:' . "\n";
        $message .= "วันที่: " . date('d-m-Y') . "\n";
        $message .= "เวลา: " . date('H:i:s') . "\n";
        $message .= 'เวชภัณฑ์รหัส: ' . '00001' . "\n";
        $message .= "ชื่อ: " . 'ทดสอบ' . "\n";
        $message .= "จำนวนขั้นต่ำ: " . number_format(10, 0) . "\n";
        $message .= "จำนวนคงเหลือ: " . number_format(9, 0) . "\n";


        $queryData = array('message' => $message);
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Authorization: Bearer " . $line_token . "\r\n"
                    . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData
            )
        );
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($line_api, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }

    /**
     * Deletes an existing Itemissue model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model_line = \common\models\JournalIssueLine::find()->where(['issue_id' => $id])->all();
        if ($model_line) {
            if (\common\models\JournalIssueLine::deleteAll(['issue_id' => $id])) {
                $this->findModel($id)->delete();
            }
        } else {
            $this->findModel($id)->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Itemissue model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Itemissue the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itemissue::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionIssueqr()
    {
        return $this->render('_issueqr');
    }

    public function actionCreateissueqr()
    {
        $product_code = \Yii::$app->request->post('qrcode_txt');
        //echo 'product code is '. \Yii::$app->request->post('qrcode_txt');
        return $this->render('_createissueqr', ['product_code' => $product_code]);
    }

    public function actionCreatefromqr()
    {
        $item_id = \Yii::$app->request->post('product_id');
        $line_qty = \Yii::$app->request->post('issue_qty');
        $line_lot_id = \Yii::$app->request->post('select_lot_no');


        $tdate = date('Y-m-d');
        $model = new \backend\models\Itemissue();
        $model->journal_no = $model::getLastNo();
        $model->trans_date = date('Y-m-d', strtotime($tdate));
        $model->status = 1;

        if ($model->save(false)) {
            if ($item_id != null) {

                $line_lot_no = $this->findlotnofromid($line_lot_id);
                $line_lot_exp_date = $this->findlotnoExpirefromid($line_lot_id);
                $model_line = new \common\models\JournalIssueLine();
                $model_line->issue_id = $model->id;
                $model_line->item_id = $item_id;
                $model_line->qty = $line_qty;
//                            $model_line->unit_id = $line_unit_id[$i];
                $model_line->lot_no = $line_lot_no;
                $model_line->exp_date = date('Y-m-d',strtotime($line_lot_exp_date));
                if ($model_line->save(false)) {
                    $model_trans = new \backend\models\Stocktrans();
                    $model_trans->journal_no = \backend\models\Stocktrans::getLastNo();
                    $model_trans->trans_date = date('Y-m-d H:i:s');
                    $model_trans->activity_type_id = 2;
                    $model_trans->trans_module_type_id = 2; // 1 receive
                    $model_trans->item_id = $item_id;
                    $model_trans->qty = $line_qty;
                    $model_trans->lot_no = $line_lot_no;
                    $model_trans->exp_date = date('Y-m-d',strtotime($line_lot_exp_date));
                    if ($model_trans->save(false)) {
                        $this->updatestock($item_id, $line_qty, $line_lot_no, $model_trans->id);
                    }
                }

            }

            return $this->redirect(['itemissue/issuecomplete']);
        }
    }

    public function actionIssuecomplete(){
        return $this->render('_issuecomplete');
    }

}
