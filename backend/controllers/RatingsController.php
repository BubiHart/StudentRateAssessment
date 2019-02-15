<?php

namespace backend\controllers;

use backend\models\Ratings;
use backend\models\Speciality;
use backend\models\Specialization;
use yii\web\Controller;

class RatingsController extends Controller
{
    public function actionIndex()
    {
        $model = new Ratings();
        $specialities = Speciality::getSpecialityActiveListArray();

        return $this->render('index', [
            'model' => $model,
            'specialities' => $specialities
        ]);
    }

    public function actionGenerateRate()
    {
        $model = new Ratings();

        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->generateRate();
            if ($model->validate()) {
                if ($model->save()) {
                    \Yii::$app->session->setFlash('success', 'Рейтинг було успішно сформовано');
                    $this->redirect(['site/index']);

                }
            }
        }
    }

    public function actionTest()
    {
        $test = Ratings::find()->all();
        var_dump($test);

    }

    public function actionInsert(){
        $array = [];
        $test = ['5', '5'];
        $array[1] = $test;

        $model = new Ratings();
        $model->rate = $array;
        $model->save(false);
    }

}