<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Specialization;
use yii\web\View;

/* @var $this View */
/* @var $model Specialization */
/* @var $form ActiveForm */

$action = Yii::$app->controller->action->id;
?>

    <?php $form = ActiveForm::begin(); ?>

        <div class="wrapper-container-form">
            <?= $form->field($model, 'speciality_id')->dropDownList($specialityArray) ?>
            <?= $form->field($model, 'code')->textInput() ?>
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'isActive')->checkbox() ?>
        </div>

        <div class="form-group btn-save">
            <?= $action == 'update' ? Html::a('Видалити', ['delete', 'id' => (string) $model->_id, 'page' => Yii::$app->request->get('page') ?? '1'], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Видалити запис?',
                    'method' => 'post',
                ],
            ]) : '' ?>
            <?= $action == 'update' ? Html::a('Зберегти', ['update', 'id' => (string) $model->_id, 'page' => Yii::$app->request->get('page') ?? '1'], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Зберегти зміни?',
                    'method' => 'post',
                ],
            ]) : Html::a('Додати', ['create', 'page' => Yii::$app->request->get('page') ?? '1'], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Додати?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>

    <?php ActiveForm::end(); ?>


