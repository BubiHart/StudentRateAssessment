<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\mongodb\ActiveRecord;

class Group extends ActiveRecord
{
    const TERMS = 4;

    const ACTIVE_STATUSES = [
        0 => 'Не активна',
        1 => 'Активна'
    ];

    public static function collectionName()
    {
        return ['student_rate', 'groups'];
    }

    public function attributes()
    {
        return [
            '_id',
            'code',
            'speciality_id',
            'specialization_id',
            'beginYear',
            'currentYear',
            'term',
            'isActive',
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'Номер групи',
            'speciality_id' => 'Спеціальність',
            'specialization_id' => 'Спеціалізація',
            'isActive' => 'Активність'
        ];
    }

    public static function getGroupActiveListArray(){
        $groupList = self::find()->where(['isActive' => 1])->all();

        Yii::trace(print_r($groupList, true));

        if($groupList){
            $groupListArray = ArrayHelper::map($groupList, 'id', 'code');
        }

        return $groupListArray ?? [];
    }

    public function getId()
    {
        return (string) $this->getPrimaryKey();
    }

    public function getSpeciality(){
        return $this->hasOne(Speciality::className(), ['_id' => 'speciality_id']);
    }

    public function getSpecialization(){
        return $this->hasOne(Specialization::className(), ['_id' => 'specialization_id']);
    }

    public static function getGroupTerms(){
        $terms = [
            1 => 1,
            2 => 2,
            3 => 3,
            4 => 4,
        ];

        return $terms;

    }

}