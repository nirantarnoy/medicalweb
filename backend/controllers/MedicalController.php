<?php

namespace backend\controllers;

use backend\models\Company;
use backend\models\Medical;
use backend\models\MedicalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;

/**
 * MedicalController implements the CRUD actions for Medical model.
 */
class MedicalController extends Controller
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
     * Lists all Medical models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");

        $searchModel = new MedicalSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Medical model.
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
     * Creates a new Medical model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Medical();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $photo = UploadedFile::getInstance($model, 'photo');
                if (!empty($photo)) {
                    $photo_name = time() . "." . $photo->getExtension();
                    $photo->saveAs(Yii::getAlias('@backend') . '/web/uploads/photo/' . $photo_name);
                    $model->photo = $photo_name;
                }
                $model->code = \backend\models\Medical::getLastNo($model->medical_cat_id);
                if($model->save(false)){
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

    /**
     * Updates an existing Medical model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load($this->request->post())) {
            $photo = UploadedFile::getInstance($model, 'photo');
            if (!empty($photo)) {
                $photo_name = time() . "." . $photo->getExtension();
                $photo->saveAs(\Yii::getAlias('@backend') . '/web/uploads/photo/' . $photo_name);
                $model->photo = $photo_name;
            }
            if($model->save(false)){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Medical model.
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
     * Finds the Medical model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Medical the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Medical::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDeletephoto()
    {
        $id = \Yii::$app->request->post('delete_id');
        if ($id) {
            $photo = $this->getPhotoName($id);
            if ($photo != '') {
                if (unlink('../web/uploads/photo/' . $photo)) {
                    Medical::updateAll(['photo' => ''], ['id' => $id]);
                }
            }

        }
        return $this->redirect(['medical/update', 'id' => $id]);
    }

    public function getPhotoName($id)
    {
        $photo_name = '';
        if ($id) {
            $model = Medical::find()->where(['id' => $id])->one();
            if ($model) {
                $photo_name = $model->photo;
            }
        }
        return $photo_name;
    }

    public function actionGetItem()
    {
        $txt = \Yii::$app->request->post('txt');

        $html = '';
        $model = null;
        if ($txt == '' || $txt == null) {
            $model = \common\models\QueryMedicalStock::find()->all();
        } else {
            $model = \common\models\QueryMedicalStock::find()->where(['OR', ['LIKE', 'code', $txt], ['LIKE', 'name', $txt]])->andFilterwhere(['>','qty',0])->all();
        }

        if ($model) {
            foreach ($model as $value) {
                //$unit_name = \backend\models\Unit::findUnitName($value->unit_id);
                $html .= '<tr>';
                $html .= '<td style="text-align: center">
                        <div class="btn btn-outline-success btn-sm" onclick="addselecteditem($(this))" data-var="' . $value->id . '">เลือก</div>
                        <input type="hidden" class="line-find-code" value="' . $value->code . '">
                        <input type="hidden" class="line-find-name" value="' . $value->name . '">
                        <input type="hidden" class="line-unit-id" value="' . $value->unit_id . '">
                        <input type="hidden" class="line-unit-name" value="' . $value->unit_name . '">
                        <input type="hidden" class="line-lot-no" value="' . $value->lot_no . '">
                        <input type="hidden" class="line-find-price" value="0">
                        <input type="hidden" class="line-onhand" value="0">
                       </td>';
                $html .= '<td>' . $value->code . '</td>';
                $html .= '<td>' . $value->name . '</td>';
                $html .= '<td style="text-align: center;">' . number_format($value->price) . '</td>';
                $html .= '<td  style="text-align: center;">' . number_format($value->qty) . '</td>';
                $html .= '<td>' . $value->lot_no . '</td>';
                $html .= '</tr>';
            }
        }
        echo $html;
    }

    public function actionGetLineLot(){
        $html = '';
        $product_id = \Yii::$app->request->post('product_id');
        if($product_id){
            $model = \backend\models\Stocksum::find()->where(['product_id'=>$product_id])->andFilterWhere(['>','qty',0])->orderBy("expired_date")->all();
            if($model){
                $html.='<option id="-1">--เลือก Lot No--</option>';
                foreach ($model as $value){
                    $html.='<option value="'.$value->id.'">'.$value->lot_no .' '.'['.date('d/m/Y',strtotime($value->expired_date)).']'.'</option>';
                }
            }else{
                $html.='<option id="-1">--ไม่พบข้อมูล--</option>';
            }
        }

        echo $html;
    }

    public function actionGetLotQty(){
        $line_qty = 0;
        $lot_line_id = \Yii::$app->request->post('lot_id');
        if($lot_line_id){
            $model = \backend\models\Stocksum::find()->where(['id'=>$lot_line_id])->andFilterWhere(['>','qty', 0])->one();
            if($model){
                $line_qty = $model->qty;
            }
        }
        return $line_qty;
    }
    public function actionGetLotExpdate(){
        $exp_date = '';
        $lot_line_id = \Yii::$app->request->post('lot_id');
        if($lot_line_id){
            $model = \backend\models\Stocksum::find()->where(['id'=>$lot_line_id])->andFilterwhere(['>','qty',0])->one();
            if($model){
                $exp_date = date('d-m-Y',strtotime($model->expired_date));
            }
        }
        return $exp_date;
    }
    public function actionGetSumQty(){
        $sum_qty = 0;
        $product_id = \Yii::$app->request->post('product_id');
        if($product_id){
            $model = \backend\models\Stocksum::find()->where(['product_id'=>$product_id])->sum('qty');
            if($model){
                $sum_qty = $model;
            }
        }
        return $sum_qty;
    }
}
