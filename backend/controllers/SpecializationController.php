<?php
namespace backend\controllers;

use backend\models\search\SpecializationSearch;
use backend\models\Speciality;
use backend\models\Specialization;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class SpecializationController extends Controller{

    public function actionIndex(){
        $searchModel = new SpecializationSearch();
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

        $model = new Specialization();
        $specialityList = Speciality::find()->where(['isActive' => 1])->all();
        $specialityArray = [];

        if($specialityList){
            foreach ($specialityList as $speciality) {
                $specialityArray[$speciality->id] = $speciality->code. ' '. $speciality->name;
            }
        }

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->save();
            Yii::$app->session->setFlash('success', 'Запис було успішно змінено');
            $url = Url::to(['index', 'page' => $page]);
            return $this->redirect($url);
        }


        return $this->render('create', [
            'model' => $model,
            'specialityArray' => $specialityArray
        ]);
    }

    public function actionUpdate($id, $page = null){
        $model = $this->findModel($id);

        $specialityList = Speciality::find()->where(['isActive' => 1])->all();
        $specialityArray = [];

        if($specialityList){
            foreach ($specialityList as $speciality) {
                $specialityArray[$speciality->id] = $speciality->code. ' '. $speciality->name;
            }
        }

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->save();
            Yii::$app->session->setFlash('success', 'Запис було успішно змінено');
            $url = Url::to(['index', 'page' => $page]);
            return $this->redirect($url);
        }

        return $this->render('update', [
            'model' => $model,
            'specialityArray' => $specialityArray
        ]);
    }

    public function actionDelete($id, $page = null){

        $model = $this->findModel($id);

        if(!$model->delete()){
            throw new ServerErrorHttpException('Помилка видалення');
        }
        Yii::$app->session->setFlash('success', 'Запис було успішно видалено');
        $url = Url::to(['index', 'page' => $page]);
        return $this->redirect($url);
    }

    protected function findModel($id){
        if (($model = Specialization::find()->where(['_id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Сторінка не була знайдена');
    }

    public function actionChangeStatus()
    {

        if (Yii::$app->request->isAjax) {
            $specialization = Yii::$app->request->post('id');
            $newStatus = Yii::$app->request->post('value');
            Yii::debug($specialization);
            Yii::debug($newStatus);

            if (!$variable = Specialization::find()->where(['_id' => $specialization])->one()) {
                throw new ServerErrorHttpException('Щось пішло не так');
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
