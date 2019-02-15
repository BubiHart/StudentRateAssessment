<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Student */
/* @var $form ActiveForm */

$action = Yii::$app->controller->action->id;
?>

<?php $form = ActiveForm::begin(); ?>

<div class="wrapper-container-form">
    <?= $form->field($model, 'average')->textInput(['label' => 'Середній бал']) ?>
    <?= $form->field($model, 'combined')->textInput(['label' => 'Консолідований бал']) ?>
    <div style="display: none">
    <?= $form->field($model, 'rate')->checkboxList($activitiesArray) ?>
    </div>
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
    ]) : Html::a('Додати', ['student/update', 'id' => (string) $model->_id,'page' => Yii::$app->request->get('page') ?? '1'], [
        'class' => 'btn btn-success',
        'data' => [
            'confirm' => 'Додати?',
            'method' => 'post',
        ],
    ]) ?>
</div>

<?php ActiveForm::end(); ?>


