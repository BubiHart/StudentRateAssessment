<?php

namespace common\models;

use backend\models\Speciality;
use yii\helpers\ArrayHelper;
use yii\mongodb\ActiveRecord;

class Specialization extends ActiveRecord
{
    const ACTIVE_STATUSES = [
        0 => 'Не активна',
        1 => 'Активна'
    ];

    public static function collectionName()
    {
        return ['student_rate', 'specialization'];
    }

    public function attributes()
    {
        return [
            '_id',
            'speciality_id',
            'code',
            'name',
            'isActive'
        ];
    }

    public function attributeLabels()
    {
        return [
            'speciality_id' => 'Спеціальність',
            'code' => 'Код спеціальності',
            'name' => 'Назва спеціальності',
            'isActive' => 'Активність'
        ];
    }

    public function getId()
    {
        return (string) $this->getPrimaryKey();
    }

    public static function getSpecializationActiveListArray(){
        $specializationList = self::find()->where(['isActive' => 1])->all();

        if($specializationList){
            $specializationListArray = ArrayHelper::map($specializationList, 'id', function($model){
                return $model->code . ' '. $model->name;
            });
        }

        return $specializationListArray ?? [];
    }


    public function getSpeciality(){
        return $this->hasOne(Speciality::className(), ['_id' => 'speciality_id']);
    }


}