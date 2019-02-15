<?php

namespace backend\models;

use Yii;

class Speciality extends \common\models\Speciality
{

    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)){
            return false;
        }

        if(parent::validate(['code', 'name', 'isActive'])){
            $specialityPost = Yii::$app->request->post('Speciality');
            $specialityCode = $specialityPost['code'];
            $specialityIsActive = $specialityPost['isActive'];

            if(is_numeric($specialityCode)){
                $this->code = intval($specialityCode);
            }

            if(is_numeric($specialityIsActive)){
                $this->isActive = intval($specialityIsActive);
            }

            return true;
        }else {
            return false;
        }
    }

    public function rules()
    {
        return [
            [['code', 'name'], 'trim'],
            [['code', 'name'], 'required', 'message' => 'Поля не можуть бути порожніми'],
            [['code', 'name'], 'unique'],
            [['name'], 'string'],
            [['code', 'isActive'], 'integer'],
        ];
    }

}