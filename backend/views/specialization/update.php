<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Specialization */

$this->title = 'Редагувати запис';
$this->params['breadcrumbs'][] = ['label' => 'Спеціалізації', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="">-->

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specialityArray' => $specialityArray
    ]) ?>

<!--</div>-->
