<?php

namespace common\models;

use yii\helpers\ArrayHelper;
use yii\mongodb\ActiveRecord;

class Student extends ActiveRecord
{
    const ACTIVE_STATUSES = [
        1 => 'Навчається',
        0 => 'Закінчив',
    ];

    const STUDENT_STATUSES = [
        0 => 'Контракт',
        1 => 'Державне замовлення',
        2 => 'Соціальна стипендія',
    ];

    public static function collectionName()
    {
        return ['student_rate', 'students'];
    }

    public function attributes()
    {
        return [
            '_id',
            'name',
            'speciality_id',
            'specialization_id',
            'group_id',
            'average',
            'combined',
            'rate',
            'isActive',
            'isAssessed',
            'isPaid'
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'П.І.Б',
            'speciality_id' => 'Спеціальність',
            'specialization_id' => 'Спеціалізація',
            'group_id' => 'Група',
            'isActive' => 'Активність',
        ];
    }

    public function getId()
    {
        return (string) $this->getPrimaryKey();
    }

    public static function getStudentsActiveListArray(){
        $studentsList = self::find()->where(['isActive' => 1])->all();

        if($studentsList){
            $studentsListArray = ArrayHelper::map($studentsList, 'id', function($model){
                return $model->name;
            });
        }

        return $studentsListArray ?? [];
    }


    public function getSpeciality(){
        return $this->hasOne(Speciality::className(), ['_id' => 'speciality_id']);
    }

    public function getSpecialization(){
        return $this->hasOne(Specialization::className(), ['_id' => 'specialization_id']);
    }

    public function getGroup(){
        return $this->hasOne(Group::className(), ['_id' => 'group_id']);
    }

}