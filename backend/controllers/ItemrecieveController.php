<?php

namespace backend\controllers;

use backend\models\Itemrecieve;
use backend\models\ItemrecieveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemrecieveController implements the CRUD actions for Itemrecieve model.
 */
class ItemrecieveController extends Controller
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
     * Lists all Itemrecieve models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new ItemrecieveSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Itemrecieve model.
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
     * Creates a new Itemrecieve model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Itemrecieve();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $item_id = \Yii::$app->request->post('line_item_id');
                $line_qty = \Yii::$app->request->post('line_qty');
                $line_unit_id = \Yii::$app->request->post('line_unit_id');
                $line_lotno = \Yii::$app->request->post('line_lot');
                $line_expired = \Yii::$app->request->post('line_expired');
                $line_issue_ref_no =  \Yii::$app->request->post('line_issue_ref_no');

                $tdate = date('Y-m-d');
                $xdate = explode('-',$model->trans_date);
                if(count($xdate)>1){
                    $tdate = $xdate[2].'/'.$xdate[1].'/'.$xdate[0];
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

                            $model_line = new \common\models\PurchrecLine();
                            $model_line->purchrec_id = $model->id;
                            $model_line->item_id = $item_id[$i];
                            $model_line->qty = $line_qty[$i];
                            $model_line->unit_id = $line_unit_id[$i];
                            $model_line->lot_no = $line_lotno[$i];
                            $model_line->exp_date = date('Y-m-d',strtotime($line_exp_date));
                            $model_line->issue_ref_no = $line_issue_ref_no[$i];
                            if ($model_line->save(false)) {
                                $model_trans = new \backend\models\Stocktrans();
                                $model_trans->journal_no = \backend\models\Stocktrans::getLastNo();
//                                $model_trans->trans_date = date('Y-m-d H:i:s');
                                $model_trans->trans_date = date('Y-m-d', strtotime($tdate));
                                $model_trans->activity_type_id = 1;
                                $model_trans->trans_module_type_id = 1; // 1 receive
                                $model_trans->item_id = $item_id[$i];
                                $model_trans->qty = $line_qty[$i];
                                $model_trans->lot_no = $line_lotno[$i];
                                $model_trans->exp_date = date('Y-m-d',strtotime($line_exp_date));
                                $model_trans->issue_ref_no = $line_issue_ref_no[$i];
                                if ($model_trans->save(false)) {
                                    $this->updatestock($item_id[$i], $line_qty[$i], $line_unit_id[$i], $line_lotno[$i], $line_expired[$i], $model_trans->id);
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

    public function updatestock($item_id, $qty, $unit_id, $lot_no, $expired, $trans_ref_id)
    {
        if ($item_id && $qty) {
            $model = \backend\models\Stocksum::find()->where(['product_id' => $item_id, 'lot_no' => $lot_no])->one();
            if ($model) {
                $model->qty = ($model->qty + $qty);
                $model->save(false);
            } else {
                $model_new = new \backend\models\Stocksum();
                $model_new->product_id = $item_id;
                $model_new->qty = $qty;
                $model_new->warehouse_id = 1;
                $model_new->lot_no = $lot_no;
                $model_new->expired_date = date('Y-m-d',strtotime($expired));
                $model_new->trans_ref_id = $trans_ref_id;
                $model_new->save(false);
            }
        }
    }

    /**
     * Updates an existing Itemrecieve model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model_line = \common\models\PurchrecLine::find()->where(['purchrec_id'=>$id])->all();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $item_id = \Yii::$app->request->post('line_item_id');
            $line_qty = \Yii::$app->request->post('line_qty');
            $line_unit_id = \Yii::$app->request->post('line_unit_id');
            $line_lotno = \Yii::$app->request->post('line_lot');
            $line_expired = \Yii::$app->request->post('line_expired');
            $line_issue_ref_no =  \Yii::$app->request->post('line_issue_ref_no');

            $tdate = date('Y-m-d');
            $xdate = explode('-',$model->trans_date);
            if(count($xdate)>1){
                $tdate = $xdate[2].'/'.$xdate[1].'/'.$xdate[0];
            }

            $model->journal_no = $model::getLastNo();
            $model->trans_date = date('Y-m-d', strtotime($tdate));
            $model->status = 1;

            if( $model->save(false)){
                if ($item_id != null) {

                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_line' => $model_line,
        ]);
    }

    /**
     * Deletes an existing Itemrecieve model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Itemrecieve model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Itemrecieve the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Itemrecieve::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionRecieveqr()
    {
        return $this->render('_receiveqr');
    }

    public function actionCreaterecieveqr()
    {
        $product_code = \Yii::$app->request->post('qrcode_txt');
        //echo 'product code is '. \Yii::$app->request->post('qrcode_txt');
        return $this->render('_createreceiveqr', ['product_code' => $product_code]);
    }

    public function actionCreatefromqr()
    {
        $item_id = \Yii::$app->request->post('product_id');
        $recieve_qty = \Yii::$app->request->post('recieve_qty');
        $lot_no = \Yii::$app->request->post('lot_no');
        $lot_expired_date = \Yii::$app->request->post('lot_expired_date');
        $issue_ref_no = \Yii::$app->request->post('issue_ref_no');

        $model = new \backend\models\Itemrecieve();
        $model->journal_no = $model::getLastNo();
        $model->trans_date = date('Y-m-d H:i:s');
        $model->status = 1;
        if ($model->save(false)) {
            if ($item_id != null) {

                    $line_exp_date = date('Y-m-d');
                    $xprdate = explode('-',$lot_expired_date);
                    if(count($xprdate)>1){
                        $line_exp_date = $xprdate[2].'/'.$xprdate[1].'/'.$xprdate[0];
                    }

                    $model_line = new \common\models\PurchrecLine();
                    $model_line->purchrec_id = $model->id;
                    $model_line->item_id = $item_id;
                    $model_line->qty = $recieve_qty;
                    $model_line->unit_id = 1;
                    $model_line->lot_no = $lot_no;
                    $model_line->exp_date = date('Y-m-d',strtotime($line_exp_date));
                    $model_line->issue_ref_no = $issue_ref_no;
                    if ($model_line->save(false)) {
                        $model_trans = new \backend\models\Stocktrans();
                        $model_trans->journal_no = \backend\models\Stocktrans::getLastNo();
                        $model_trans->trans_date = date('Y-m-d H:i:s');
                        $model_trans->activity_type_id = 1;
                        $model_trans->trans_module_type_id = 1; // 1 receive
                        $model_trans->item_id = $item_id;
                        $model_trans->qty = $recieve_qty;
                        $model_trans->lot_no = $lot_no;
                        $model_trans->exp_date = date('Y-m-d',strtotime($line_exp_date));
                        $model_trans->issue_ref_no = $issue_ref_no;
                        if ($model_trans->save(false)) {
                            $this->updatestock($item_id, $recieve_qty, 1, $lot_no, $lot_expired_date, $model_trans->id);
                        }
                    }

            }
            return $this->redirect(['itemrecieve/receivecomplete']);
        }
    }

    public function actionReceivecomplete(){
        return $this->render('_receivecomplete');
    }
}
