<?php

namespace backend\models;

class Specialization extends \common\models\Specialization
{
    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)){
            return false;
        }

        if(is_numeric($this->isActive)){
            $this->isActive = intval($this->isActive);
        }

        return true;
    }

    public function rules()
    {
        return [
            [['speciality_id', 'isActive'], 'safe'],
            [['code', 'name'], 'trim'],
            [['code', 'name'], 'required', 'message' => 'Поля не можуть бути порожніми'],
            [['code', 'name'], 'unique'],
            [['name'], 'string'],
            [['code'], 'integer'],
        ];
    }

}