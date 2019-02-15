<?php

namespace backend\models\search;

use backend\models\Student;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class StudentSearch extends Student{

    public $group_id;
    public $beginYear;
    public $currentYear;
    public $term;
    public $isActive;
    public $name;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function rules()
    {
        return [
            [
                [
                    'speciality_id',
                    'specialization_id',
                    'group_id',
                    'beginYear',
                    'currentYear',
                    'term',
                    'isActive',
                    'term',
                    'name',
                ],
        'safe'],
        ];
    }

    public function search($params)
    {
        $query = Student::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->load($params);

        if(!$this->validate()){
            return $dataProvider;
        }

        Yii::debug(print_r($this, true));

//        $query->andFilterWhere(['like', 'students.firstName', $this->code]);
//        $query->andFilterWhere(['like', 'students.firstName', $this->name]);
//        $query->andFilterWhere(['students.isActive' => $this->isActive]);
        Yii::debug(print_r($query, true));
        return $dataProvider;
    }
}