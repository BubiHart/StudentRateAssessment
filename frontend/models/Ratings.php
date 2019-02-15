<?php
namespace frontend\models;

class Ratings extends \common\models\Ratings
{
    private $_ratings;

    public function rules()
    {
        return [
            [['speciality_id', 'percentPermitted', 'date', 'rate', 'term'], 'safe']
        ];
    }

    public function getStudentRate()
    {

        $this->_ratings = self::find()->where(['speciality_id' => $this->speciality_id])->all();

        foreach (self::find()->all() as $rating) {
//            var_dump($this->speciality_id);
//            var_dump($rating->speciality_id);
//            die;
            var_dump($rating->speciality_id == $this->speciality_id);
            die;
        }
        
        if ($this->_ratings) {
            foreach ($this->_ratings as $rating) {
                if (isset($rating['rate']) && $rating['rate']) {
                    foreach ($rating['rate'] as $key => $value) {
                        if ($key == $this->term) {
                            return $value;
                        }
                    }
                }
            }
        }

        return false;

    }

}