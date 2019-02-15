<?php

namespace common\models;

use yii\mongodb\ActiveRecord;

class Rate extends ActiveRecord
{
    public static function collectionName()
    {
        return ['student_rate', 'rate'];
    }

    public function attributes()
    {
        return [
            '_id',
            'studentId',
            'sciencePublication',
            'sciencePerformance',
            'competitionsParticipant',
            'competitionsCity',
            'competitionsState',
            'competitionsInternational',
            'patentGain',
            'certificationPass',
            'professionalStatus',
            'studyHelp',
            'studyHelp',
            'cityChampionParticipant',
            'cityChampionPrize',
            'districtChampionParticipant',
            'districtChampionParticipant',
            'stateChampionPrize',
            'stateChampionPrize',
            'worldChampionParticipant',
            'worldChampionPrize',
            'studentCouncilMaster',
            'studentCouncilDeputy',
            'studentCouncilRecorder',
            'studentCouncilActiveParticipant',
            'projectCreateDeployment',
            'cityEventsParticipant',
            'cityEventsVictory',
            'groupHeadman'
        ];
    }

    public function attributeLabels()
    {
        return [
            'sciencePublication' => 'Участь у роботі конференцій, публікація статті',
            'sciencePerformance' => 'Участь у роботі конференцій, виступ',
            'competitionsParticipant' => 'Участь в олімпіадах, конкурсах, фахових змаганнях, місто, район регіон, перемога',
            'competitionsCity' => 'Участь в олімпіадах, конкурсах, фахових змаганнях, місто, район регіон, перемога',
            'competitionsState' => 'Участь в олімпіадах, конкурсах, фахових змаганнях, всеукраїнська, перемога',
            'competitionsInternational' => 'Участь в олімпіадах, конкурсах, фахових змаганнях, міжнародна, перемога',
            'patentGain' => 'Отримання авторського свідоцтва, патенту ...',
            'certificationPass' => 'Отримання сертифікатів про проходження навчальних курсів',
            'professionalStatus' => 'Отримання професійного статусу, сертифікація',
            'studyHelp' => 'Впровадження власних розробок, створення макету, стенду, пристрою...',
            'cityChampionParticipant' => 'Чемпіонат міста, участь',
            'cityChampionPrize' => 'Чемпіонат міста, завоювання призів',
            'districtChampionParticipant' => 'Чемпіонат області, участь',
            'districtChampionPrize' => 'Чемпіонат області, завоювання призів',
            'stateChampionParticipant' => 'Всеукраїнські змагання, участь',
            'stateChampionPrize' => 'Всеукраїнські змагання, завоювання призів',
            'worldChampionParticipant' => 'Міжнародні змагання, участь',
            'worldChampionPrize' => 'Міжнародні змагання, завоювання призів',
            'studentCouncilMaster' => 'Голова студентської ради',
            'studentCouncilDeputy' => 'Заступник голови студентської ради, голова студентської ради гуртожитку, депутат міської студентської ради',
            'studentCouncilRecorder' => 'Секретар студентської ради',
            'studentCouncilActiveParticipant' => 'Активна участь в роботі студентської ради та профкому коледжу',
            'projectCreateDeployment' => 'Створення і впровадження проектів',
            'cityEventsParticipant' => 'Участь у загальноміських заходах',
            'cityEventsVictory' => 'Участь у загальноміських заходах, перемога',
            'groupHeadman' => 'Сумлінне виконання обов\'язків старости'
        ];
    }

    static public function attributePercents(){
        $attributePercents = [
            'sciencePublication' => '0.04',
            'sciencePerformance' => '0.04',
            'competitionsParticipant' => '0.02',
            'competitionsCity' => '0.04',
            'competitionsState' => '0.08',
            'competitionsInternational' => '0.1',
            'patentGain' => '0.1',
            'certificationPass' => '0.1',
            'professionalStatus' => '0.1',
            'studyHelp' => '0.08',
            'cityChampionParticipant' => '0.02',
            'cityChampionPrize' => '0.05',
            'districtChampionParticipant' => '0.04',
            'districtChampionPrize' => '0.07',
            'stateChampionParticipant' => '0.06',
            'stateChampionPrize' => '0.1',
            'worldChampionParticipant' => '0.07',
            'worldChampionPrize' => '0.1',
            'studentCouncilMaster' => '0.03',
            'studentCouncilDeputy' => '0.02',
            'studentCouncilRecorder' => '0.01',
            'studentCouncilActiveParticipant' => '0.05',
            'projectCreateDeployment' => '0.05',
            'cityEventsParticipant' => '0.02',
            'cityEventsVictory' => '0.04',
            'groupHeadman' => '0.03'
        ];
        return $attributePercents;
    }

//    public function attributesCheckboxList()
//    {
//        return [
//            'studentId' => '',
//            'sciencePublication' => '',
//            'sciencePerformance' => '',
//            'competitionsParticipant' => '',
//            'competitionsCity' => '',
//            'competitionsState' => '',
//            'competitionsInternational' => '',
//            'patentGain' => '',
//            'certificationPass' => '',
//            'professionalStatus' => '',
//            'studyHelp' => '',
//            'cityChampionParticipant' => '',
//            'cityChampionPrize' => '',
//            'districtChampionParticipant' => '',
//            'districtChampionPrize' => '',
//            'stateChampionParticipant' => '',
//            'stateChampionPrize' => '',
//            'worldChampionParticipant' => '',
//            'worldChampionPrize' => '',
//            'studentCouncilMaster' => '',
//            'studentCouncilDeputy' => '',
//            'studentCouncilRecorder' => '',
//            'studentCouncilActiveParticipant' => '',
//            'projectCreateDeployment' => '',
//            'cityEventsParticipant' => '',
//            'cityEventsVictory' => '',
//            'groupHeadman' => ''
//        ];
//    }

    public function getId()
    {
        return (string) $this->getPrimaryKey();
    }
}