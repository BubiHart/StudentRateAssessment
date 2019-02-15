<?php

namespace backend\models\search;

use backend\models\Speciality;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class SpecialitySearch extends Speciality{

    public $code;
    public $name;
    public $isActive;

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function rules(){

        return [
            [['code', 'name'], 'trim'],
            [['name'], 'string'],
            [['code', 'isActive'], 'integer']
        ];
    }

    public function search($params)
    {
        $query = Speciality::find();

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

        if($this->code){
            var_dump($this->code);  
        }

        $query->andFilterWhere(['like', 'speciality.code', $this->code]);
        $query->andFilterWhere(['like', 'speciality.name', $this->name]);
        $query->andFilterWhere(['speciality.isActive' => $this->isActive]);
        Yii::debug(print_r($query, true));
        return $dataProvider;
    }
}