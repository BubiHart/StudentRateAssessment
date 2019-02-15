<?php

use yii\helpers\Html;
use backend\models\Group;
use yii\web\View;


/* @var $this View */
/* @var $model Group */
/* @var array $specialityList */
/* @var array $specializationList */

$this->title = 'Створити нову групу';
$this->params['breadcrumbs'][] = ['label' => 'Групи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="post-create">
-->
    <h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', [
        'model' => $model,
        'specialityList' => $specialityList,
        'specializationList' => $specializationList,
    ]) ?>

<!--</div>-->
