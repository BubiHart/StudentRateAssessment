<?php

namespace common\models;

use yii\mongodb\ActiveRecord;

class Ratings extends ActiveRecord
{
    public static function collectionName()
    {
        return ['student_rate', 'ratings'];
    }

    public function attributes()
    {
        return [
            '_id',
            'speciality_id',
            'percentPermitted',
            'date',
            'rate',
            'term'
        ];
    }

    public function attributeLabels()
    {
        return [
            'speciality_id' => 'Спеціальність',
            'percentPermitted' => 'Відсоток фінансування',
        ];

    }
}


