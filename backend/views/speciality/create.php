<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Speciality */

$this->title = 'Додати нову спеціальність ';
$this->params['breadcrumbs'][] = ['label' => 'Спеціальності', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="post-create">
-->
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

<!--</div>-->
