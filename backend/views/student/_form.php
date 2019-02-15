<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Student */
/* @var $form ActiveForm */
/* @var array $specialityList */
/* @var array $specializationList */
/* @var array $groupList */

$action = Yii::$app->controller->action->id;
?>

    <?php $form = ActiveForm::begin(); ?>

        <div class="wrapper-container-form">
            <?= $form->field($model, 'name')->textInput() ?>
            <?= $form->field($model, 'speciality_id')->dropDownList($specialityList) ?>
            <?= $form->field($model, 'specialization_id')->dropDownList($specializationList) ?>
            <?= $form->field($model, 'group_id')->dropDownList($groupList) ?>
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
            <?= $action == 'update' ? Html::a('Сохранить', ['update', 'id' => (string) $model->_id, 'page' => Yii::$app->request->get('page') ?? '1'], [
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


