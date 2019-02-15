<?php

namespace common\models;

use backend\models\Specialization;
use yii\helpers\ArrayHelper;
use yii\mongodb\ActiveRecord;

class Speciality extends ActiveRecord{

    const ACTIVE_STATUSES = [
        0 => 'Не активна',
        1 => 'Активна'
    ];

    public static function collectionName()
    {
        return ['student_rate', 'speciality'];
    }

    public function attributes()
    {
        return [
            '_id',
            'code',
            'name',
            'isActive'
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'Код спеціальності',
            'name' => 'Назва спеціальності',
            'isActive' => 'Активність'
        ];
    }

    public static function getSpecialityActiveListArray(){
        $specialityList = self::find()->where(['isActive' => 1])->all();

        if($specialityList){
            $specialityListArray = ArrayHelper::map($specialityList, 'id', function($model){
                return $model->code . ' '. $model->name;
            });
        }

        return $specialityListArray ?? [];
    }

    public function getId()
    {
        return (string) $this->getPrimaryKey();
    }

    public function getSpecialization(){
        return $this->hasMany(Specialization::className(), ['speciality_id' => 'id']);
    }

}