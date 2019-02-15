<?php

use yii\helpers\Html;
use backend\models\Specialization;
use yii\web\View;


/* @var $this View  */
/* @var $model Specialization */

$this->title = 'Додати нову спеціалізацію';
$this->params['breadcrumbs'][] = ['label' => 'Спеціалізації', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="post-create">
-->
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'specialityArray' => $specialityArray
    ]) ?>

<!--</div>-->
