<?php
namespace frontend\models\search;

use frontend\models\Ratings;
use yii\base\Model;

class RatingsSearch extends Ratings
{
    public function scenarios()
    {
        return Model::scenarios();
    }


    public function search($queryParams){

    }
}
