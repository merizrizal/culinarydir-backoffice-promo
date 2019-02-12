<?php

namespace backoffice\modules\promo\controllers;

use Yii;
use core\models\Promo;
use core\models\search\PromoSearch;
use backoffice\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * PromoController implements the CRUD actions for Promo model.
 */
class PromoController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(
            $this->getAccess(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]);
    }
    
    public function actionIndexActive()
    {
        return $this->index(true, Yii::t('app', 'Active Promo'));
    }
    
    public function actionIndexNotActive()
    {
        return $this->index(false, Yii::t('app', 'Inactive Promo'));
    }
    
    /**
     * Displays a single Promo model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $isActive)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'isActive' => $isActive
        ]);
    }

    /**
     * Creates a new Promo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($save = null)
    {
        $render = 'create';

        $model = new Promo();

        if ($model->load(($post = Yii::$app->request->post()))) {

            if (!empty($save)) {
                
                Yii::$app->formatter->timeZone = 'Asia/Jakarta';
                
                if (!empty($post['Promo']['date_end'])) {
                    
                    $isActive = !$post['Promo']['not_active'] && ($post['Promo']['date_end'] >= Yii::$app->formatter->asDate(time()));
                } else {
                    
                    $isActive = !$post['Promo']['not_active'];
                }
                
                Yii::$app->formatter->timeZone = 'UTC';

                if ($model->save()) {

                    Yii::$app->session->setFlash('status', 'success');
                    Yii::$app->session->setFlash('message1', Yii::t('app', 'Create Data Is Success'));
                    Yii::$app->session->setFlash('message2', Yii::t('app', 'Create data process is success. Data has been saved'));

                    $render = 'view';
                } else {

                    $model->setIsNewRecord(true);

                    Yii::$app->session->setFlash('status', 'danger');
                    Yii::$app->session->setFlash('message1', Yii::t('app', 'Create Data Is Fail'));
                    Yii::$app->session->setFlash('message2', Yii::t('app', 'Create data process is fail. Data fail to save'));
                }
            }
        }

        return $this->render($render, [
            'model' => $model,
            'isActive' => !empty($isActive) ? $isActive : null
        ]);
    }

    /**
     * Updates an existing Promo model.
     * If update is successful, the browser will be redirected to the 'update' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id, $isActive, $save = null)
    {
        $model = $this->findModel($id);

        if ($model->load(($post = Yii::$app->request->post()))) {

            if (!empty($save)) {
                
                Yii::$app->formatter->timeZone = 'Asia/Jakarta';
                
                if (!empty($post['Promo']['date_end'])) {
                    
                    $isActive = !$post['Promo']['not_active'] && ($post['Promo']['date_end'] >= Yii::$app->formatter->asDate(time()));
                } else {
                    
                    $isActive = !$post['Promo']['not_active'];
                }
                
                Yii::$app->formatter->timeZone = 'UTC';

                if ($model->save()) {

                    Yii::$app->session->setFlash('status', 'success');
                    Yii::$app->session->setFlash('message1', Yii::t('app', 'Update Data Is Success'));
                    Yii::$app->session->setFlash('message2', Yii::t('app', 'Update data process is success. Data has been saved'));
                } else {

                    Yii::$app->session->setFlash('status', 'danger');
                    Yii::$app->session->setFlash('message1', Yii::t('app', 'Update Data Is Fail'));
                    Yii::$app->session->setFlash('message2', Yii::t('app', 'Update data process is fail. Data fail to save'));
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'isActive' => $isActive
        ]);
    }

    /**
     * Deletes an existing Promo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $isActive)
    {
        if (($model = $this->findModel($id)) !== false) {

            $flag = false;
            $error = '';

            try {
                $flag = $model->delete();
            } catch (yii\db\Exception $exc) {
                $error = Yii::$app->params['errMysql'][$exc->errorInfo[1]];
            }
        }

        if ($flag) {

            Yii::$app->session->setFlash('status', 'success');
            Yii::$app->session->setFlash('message1', Yii::t('app', 'Delete Is Success'));
            Yii::$app->session->setFlash('message2', Yii::t('app', 'Delete process is success. Data has been deleted'));
        } else {

            Yii::$app->session->setFlash('status', 'danger');
            Yii::$app->session->setFlash('message1', Yii::t('app', 'Delete Is Fail'));
            Yii::$app->session->setFlash('message2', Yii::t('app', 'Delete process is fail. Data fail to delete' . $error));
        }

        $return = [];

        $return['url'] = Yii::$app->urlManager->createUrl([$this->module->id . '/promo/' . ($isActive ? 'index-active' : 'index-not-active')]);

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $return;
    }

    /**
     * Finds the Promo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Promo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Promo::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    private function index($isActive, $title)
    {
        $searchModel = new PromoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        Yii::$app->formatter->timeZone = 'Asia/Jakarta';
        
        if ($isActive) {
            
            $dataProvider->query
                ->andWhere(['not_active' => false])
                ->andWhere(['OR', ['>=', 'date_end', Yii::$app->formatter->asDate(time())], ['date_end' => null]])
                ->distinct();
        } else {
            
            $dataProvider->query
                ->andWhere(['not_active' => true])
                ->orWhere(['<', 'date_end', Yii::$app->formatter->asDate(time())])
                ->distinct();
        }
        
        Yii::$app->formatter->timeZone = 'UTC';
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'isActive' => $isActive,
            'title' => $title
        ]);
    }
}
