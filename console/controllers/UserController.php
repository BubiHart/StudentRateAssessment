<?php
namespace console\controllers;

use common\models\User;
use yii\console\Controller;

class UserController extends Controller{
    public function actionAddUser($human_name, $email, $password){
        $model = new User();

        $model->human_name = $human_name;
        $model->username = $email;
        $model->password = $password;
        if($model->save()){
            echo 'MODEL SAVED'. PHP_EOL;
        }


    }
}