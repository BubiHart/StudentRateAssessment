<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Student */
/* @var array $specialityList */
/* @var array $specializationList */
/* @var array $groupList */

$this->title = 'Редагувати студента';
$this->params['breadcrumbs'][] = ['label' => 'Студенти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="">-->

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specialityList' => $specialityList,
        'specializationList' => $specializationList,
        'groupList' => $groupList,
    ]) ?>

<!--</div>-->
