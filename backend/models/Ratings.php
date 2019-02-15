<?php

namespace backend\models;

use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class Ratings extends \common\models\Ratings
{

    private $_students;
    private $_limit;
    public $students;

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            [['speciality_id', 'percentPermitted', 'date', 'rate'], 'safe']
        ];
    }


    public function generateRate()
    {
        $this->initRate();
        $this->calculateLimits();
        $this->processStudents();
        $this->rate = $this->students;
        $this->date = date('d.m.Y');
    }

    public function initRate()
    {
        $this->_students = $this->getAllAssessedStudents();
    }

    private function getAllAssessedStudents()
    {
        $students = Student::getAllActiveAssessedStudents();

        $students = array_filter($students, function ($model) {
            return ($model->speciality->id == $this->speciality_id);
        });


        return $students;
    }

    private function processStudents()
    {
        for ($counter = 1; $counter <= Group::TERMS; $counter++) {
            $students = $this->_students;

            $students = array_filter($students, function ($model) use ($counter) {
                if ($model->group) {
                    return ($model->group->term == $counter);
                }
            });

            if ($students) {

                ArrayHelper::multisort($students, ['combined'], SORT_DESC);

                for ($limitCounter = 0; $limitCounter < $this->_limit; $limitCounter++) {
                    if (isset($students[$limitCounter])) {
                        $students[$limitCounter]->isPaid = 1;
                    }

                }
                $studentsArray = [];
                $studentArray = [];
                foreach ($students as $student) {
                    $studentArray['name'] = $student->name;
                    $studentArray['group_id'] = $student->group_id;
                    $studentArray['isPaid'] = $student->isPaid;
                    $studentArray['average'] = $student->average;
                    $studentArray['combined'] = $student->combined;
                    $studentsArray[] = $studentArray;
                }


                $this->students[$counter] = $studentsArray;
            }

        }
    }


    private function calculateLimits()
    {
        if (is_numeric($this->percentPermitted)) {
            $this->percentPermitted = doubleval($this->percentPermitted);
        }

        $allStudentsCount = count($this->_students);

        $this->_limit = round($allStudentsCount * ($this->percentPermitted * 0.01));
    }

}