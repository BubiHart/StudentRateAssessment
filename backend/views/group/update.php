<?php
use yii\helpers\Html;

$this->title = 'Редагування групи';
$this->params['breadcrumbs'][] = ['label' => 'Групи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="">-->

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specialityList' => $specialityList,
        'specializationList' => $specializationList,
    ]) ?>

<!--</div>-->
