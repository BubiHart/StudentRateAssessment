<?php
namespace backend\controllers;

use backend\models\Speciality;
use backend\models\search\SpecialitySearch;
use Yii;
use yii\db\StaleObjectException;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class SpecialityController extends Controller{

    public function actionIndex(){

        $searchModel = new SpecialitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param null $page
     * @return string|\yii\web\Response
     */
    public function actionCreate($page = null){

        $model = new Speciality();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->save();
            Yii::$app->session->setFlash('success', 'Запис було успішно додано');
            $url = Url::to(['index', 'page' => $page]);
            return $this->redirect($url);
        }

        return $this->render('create', [
            'model' => $model,]);
    }

    public function actionUpdate($id, $page = null){
        try {
            $model = $this->findModel($id);
        } catch (NotFoundHttpException $e) {
            Yii::error($e);
            Yii::$app->session->setFlash('error', 'Виникла неочікувана помилка');
            $url = Url::to(['index', 'page' => $page]);
            return $this->redirect($url);
        }

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->save();
            Yii::$app->session->setFlash('success', 'Запис було успішно змінено');
            $url = Url::to(['index', 'page' => $page]);
            return $this->redirect($url);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id, $page = null){

        try {
            $model = $this->findModel($id);
        } catch (NotFoundHttpException $e) {
            Yii::error($e);
            Yii::$app->session->setFlash('error', 'Виникла неочікувана помилка');
            $url = Url::to(['index', 'page' => $page]);
            return $this->redirect($url);
        }

        try {
            $model->delete();
        } catch (StaleObjectException $e){
            Yii::$app->session->setFlash('error', 'Виникла неочікувана помилка');
            $url = Url::to(['index', 'page' => $page]);
            return $this->redirect($url);
        }

        Yii::$app->session->setFlash('success', 'Запис було успішно видалено');
        $url = Url::to(['index', 'page' => $page]);
        return $this->redirect($url);
    }

    protected function findModel($id){
        if (($model = Speciality::find()->where(['_id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Сторінка не була знайдена');
    }

    public function actionChangeStatus()
    {

        if (Yii::$app->request->isAjax) {
            $speciality = Yii::$app->request->post('id');
            $newStatus = Yii::$app->request->post('value');
            Yii::debug($speciality);
            Yii::debug($newStatus);

            if (!$variable = Speciality::find()->where(['_id' => $speciality])->one()) {
                throw new ServerErrorHttpException('Не знайдено такої спеціальності');
            }
            $variable->isActive = $newStatus;
            if (!$variable->validate()) {
                Yii::trace(print_r($variable->getErrors(), TRUE));
                throw new ServerErrorHttpException('Помилка зміни');
            }
            $variable->save();
            return true;
        } else {
            $this->redirect(['site/index']);
        }
    }
}
