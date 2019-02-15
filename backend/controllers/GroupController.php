<?php
namespace backend\controllers;

use backend\models\Group;
use backend\models\search\GroupSearch;
use backend\models\Speciality;
use backend\models\Specialization;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class GroupController extends Controller{

    public function actionIndex(){

        $searchModel = new GroupSearch();
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

        $model = new Group();

        $specialityList = Speciality::getSpecialityActiveListArray();
        $specializationList = Specialization::getSpecializationActiveListArray();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->save();
            Yii::$app->session->setFlash('success', 'Запис було успішно створено');
            $url = Url::to(['index', 'page' => $page]);
            return $this->redirect($url);
        }

        return $this->render('create', [
            'model' => $model,
            'specialityList' => $specialityList,
            'specializationList' => $specializationList,
        ]);
    }

    public function actionUpdate($id, $page = null){
        $model = $this->findModel($id);

        $specialityList = Speciality::getSpecialityActiveListArray();
        $specializationList = Specialization::getSpecializationActiveListArray();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->save();
            Yii::$app->session->setFlash('success', 'Запис було успішно створено');
            $url = Url::to(['index', 'page' => $page]);
            return $this->redirect($url);
        }

        return $this->render('update', [
            'model' => $model,
            'specialityList' => $specialityList,
            'specializationList' => $specializationList,
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
        if (($model = Group::find()->where(['_id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Виникла неочікувана помилка');
    }

}
