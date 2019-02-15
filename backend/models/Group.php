<?php

namespace backend\models;

use Yii;

class Group extends \common\models\Group
{
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $code = $this->code;
        Yii::debug('CODE: ' . $code);

        $codeSplited = str_split($code);
        Yii::debug('CODE SPLITTED: ' . print_r($codeSplited, true));

        if(is_numeric($this->isActive)){
            $this->isActive = intval($this->isActive);
        }

        if (isset($codeSplited[0]) && isset($codeSplited[1])) {
            if ($codeSplited[0] && $codeSplited[1]) {
                $this->term = $codeSplited[0];
                Yii::debug('GROUP YEAR: ' . $codeSplited[0]);
                $groupYear = intval($codeSplited[0]);
                Yii::debug('GROUP YEAR INT: ' . $groupYear);
                $currentYear = date('Y');
                Yii::debug('CURRENT YEAR: ' . $currentYear);
                $this->currentYear = $currentYear;
                if ($groupYear == 1) {
                    $this->beginYea = $currentYear;
                }

                if ($groupYear > 1) {
                    $this->beginYear = $currentYear - $groupYear;
                }
                Yii::debug('BEGIN YEAR OBJECT: ' . $this->beginYear);
                Yii::debug('CURRENT YEAR OBJECT: ' . $this->currentYear);
                return true;

            }
        }   
        return false;
    }

    public function rules()
    {
        return [
            [['code'], 'trim'],
            [['speciality_id', 'specialization_id', 'code', ], 'required', 'message' => 'Поля не можуть бути порожніми'],
            [['code'], 'uniqueGroupCode'],
            [['speciality_id', 'specialization_id',], 'string'],
            [['code', 'isActive'], 'integer'],
            [['beginYear', 'currentYear', 'term'], 'safe']
        ];
    }

    public function uniqueGroupCode()
    {
        $code = $this->code;

        $codeSearch = self::find()->where(
            ['AND', ['isActive' => 1], ['code' => $code], ['NOT', '_id', $this->id]]
        )->all();

        
        if($codeSearch){
             $this->addError('code', 'Є активна група з таким номером');
        }
    }
};