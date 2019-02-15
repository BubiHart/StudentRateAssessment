<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var array $specializations */
$action = Yii::$app->controller->action->id;
?>

<?php $form = ActiveForm::begin(); ?>

<div class="wrapper-container-form">
    <?= $form->field($model, 'speciality_id')->dropDownList($specialities) ?>
    <?= $form->field($model, 'percentPermitted')->textInput() ?>
</div>

<div class="form-group btn-save">
    <?= Html::a('Сохранить', ['ratings/generate-rate'], [
        'class' => 'btn btn-success',
        'data' => [
            'confirm' => 'Згенерувати рейтинг для обраної спеціальності?',
            'method' => 'post',
        ]]);
?>
</div>

<?php ActiveForm::end(); ?>


