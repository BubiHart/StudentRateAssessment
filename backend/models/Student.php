<?php
namespace backend\models;

use Yii;


class Student extends \common\models\Student
{
    /**
     * @param bool $insert
     * @var $this Student
     * @return bool
     */
    public function beforeSave($insert)
    {
        if(!parent::beforeSave($insert)){
            return false;
        }

        if(is_numeric($this->isActive)){
            $this->isActive = intval($this->isActive);
        }
        $this->isPaid = 0;

        return true;
    }

    public function calculateStudentProgress(){
        $resultArray = [];

        $postStudent = Yii::$app->request->post('Student');


        $average = isset($postStudent['average']) ? $postStudent['average'] : '';
        $combined = isset($postStudent['combined']) ? $postStudent['combined'] : '';
        $rate = isset($postStudent['rate']) ? $postStudent['rate'] : [];

        if(!empty($average) && !empty($combined) && !empty($rate)){
            $resultArray['average'] = $average;
            $resultArray['combined'] = $combined;
            $resultArray['achievements'] = $rate;

            return $resultArray;
        }

        if(empty($combined) && !empty($rate) && !empty($average)){
            $percent = (double) 0.0;
            $attributePercents = Rate::attributePercents();
            foreach ($rate as $key => $value) {
                $percent += $this->searchActivityPercent($value, $attributePercents);
            }

            $combined = $average + ($average * $percent);

            $resultArray['average'] = $average;
            $resultArray['combined'] = $combined;
            $resultArray['achievements'] = $rate;

            return $resultArray;
        }

        if(!empty($average) && !empty($combined) && empty($rate)){
            $resultArray['average'] = $average;
            $resultArray['combined'] = $combined;

            return $resultArray;
        }

        if(!empty($average) && empty($rate) && empty($combined)){
            $resultArray['average'] = $average;
            $resultArray['combined'] = $average;

            return $resultArray;
        }

        return $resultArray;
    }

    /**
     * @param string $searchKey
     * @param array $attributesPercents
     * @return float
     */
    private function searchActivityPercent($searchKey, $attributesPercents){
        foreach ($attributesPercents as $key => $value) {
            if($searchKey == $key){
                return doubleval($value);
            }
        }
    }

    public function rules()
    {
        return [
            [['name'], 'trim'],
            [['speciality_id', 'specialization_id', 'group_id', 'name'], 'required', 'message' => 'Поля не можуть бути порожніми'],
            [['speciality_id', 'specialization_id', 'group_id', 'name'], 'string'],
            [['isAssessed', 'rate', 'isActive', 'isPaid', 'average', 'combined'], 'safe']
        ];
    }

    /**
     * @return array|Student[]|\yii\mongodb\ActiveRecord
     */
    public static function getAllActiveAssessedStudents()
    {
        $students = self::find()
            ->where([

                    'AND',
                    ['isAssessed' => 1, 'isActive' => 1],
                    ['isActive' => 1],

                ])
            ->all();

        return $students;
    }


}