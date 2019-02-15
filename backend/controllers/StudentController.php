<?php

namespace backend\controllers;

use backend\models\Group;
use backend\models\Rate;
use backend\models\search\StudentSearch;
use backend\models\Speciality;
use backend\models\Specialization;
use backend\models\Student;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class StudentController extends Controller
{

    public function actionIndex()
    {

        $searchModel = new StudentSearch();
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
    public function actionCreate($page = null)
    {

        $model = new Student();

        $specialityList = Speciality::getSpecialityActiveListArray();
        $specializationList = Specialization::getSpecializationActiveListArray();
        $groupList = Group::getGroupActiveListArray();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (!$model->save()) {
                Yii::error($model->getErrors());
            }
            Yii::$app->session->setFlash('success', 'Запис було успішно створено');
            $url = Url::to(['index', 'page' => $page]);
            return $this->redirect($url);
        }

        return $this->render('create', [
            'model' => $model,
            'groupList' => $groupList,
            'specialityList' => $specialityList,
            'specializationList' => $specializationList,
        ]);
    }

    /**
     *
     * @param $id
     * @param null $page
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $page = null)
    {
        $model = $this->findModel($id);

        $specialityList = Speciality::getSpecialityActiveListArray();
        $specializationList = Specialization::getSpecializationActiveListArray();
        $groupList = Group::getGroupActiveListArray();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $url = Url::to(['index', 'page' => $page]);
            if (isset(Yii::$app->request->post('Student')['average'])) {
                $rate = $model->calculateStudentProgress();
                $model->average = $rate['average'];
                $model->combined = $rate['combined'];
                $model->rate = $rate;
                $model->isAssessed = 1;
                Yii::debug($model->rate);
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Запис було успішно створено');
                    return $this->redirect($url);
                }
            } else {
                $model->isAssessed = 1;
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Запис було успішно змінено');
                    return $this->redirect($url);
                }

            }


        }

        return $this->render('update', [
            'model' => $model,
            'groupList' => $groupList,
            'specialityList' => $specialityList,
            'specializationList' => $specializationList,
        ]);
    }

    public function actionDelete($id, $page = null)
    {

        $model = $this->findModel($id);

        if (!$model->delete()) {
            throw new ServerErrorHttpException('Помилка видалення');
        }
        Yii::$app->session->setFlash('success', 'Запис був успішно видалений');
        $url = Url::to(['index', 'page' => $page]);
        return $this->redirect($url);
    }

    public function actionRate($id)
    {
        $model = $this->findModel($id);
        $rateModel = new Rate();
        $activitiesArray = $rateModel->attributeLabels();

        return $this->render('rate', [
            'model' => $model,
            'activitiesArray' => $activitiesArray
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Student::find()->where(['_id' => $id])->one()) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Запитувана сторінка не була знайдена');
    }
}
