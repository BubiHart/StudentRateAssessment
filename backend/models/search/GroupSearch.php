<?php

namespace backend\models\search;

use backend\models\Group;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class GroupSearch extends Group {

    public $code;
    public $speciality_id;
    public $specialization_id;
    public $beginYear;
    public $currentYear;
    public $term;
    public $students;
    public $isActive;
    public $isActual;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function rules(){

        return [
            [['speciality_id', 'isActive', 'specialization_id', 'beginYear', 'currentYear', 'term', 'isActual', 'code'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Group::find();

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

/*        $query->andFilterWhere(['like', 'specialization.code', $this->code]);
        $query->andFilterWhere(['like', 'specialization.name', $this->name]);
        $query->andFilterWhere(['specialization.isActive' => $this->isActive]);
        $query->andFilterWhere(['specialization.speciality_id' => $this->speciality_id]);*/

        return $dataProvider;
    }
}