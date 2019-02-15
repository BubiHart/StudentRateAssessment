<?php

use backend\models\Speciality;
use backend\models\Student;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Студенти';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin([
    'id' => 'student'
]); ?>

<p>
    <?= Html::a('Додати нового студента', ['create', 'page' => Yii::$app->request->get('page') ?? '1'], ['class' => 'btn btn-success']) ?>
</p>


<?= GridView::widget([
    'filterModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'name',
        ],
        [
            'attribute' => 'speciality_id',
            'value' => function ($model) {
                if ($model->speciality) {
                    return $model->speciality->code . ' ' . $model->speciality->name;
                } else {
                    return null;
                }

            }
        ],
        [
            'attribute' => 'specialization_id',
            'value' => function ($model) {
                if ($model->specialization) {
                    return $model->specialization->code . ' ' . $model->specialization->name;
                } else {
                    return null;
                }
            }
        ],
        [
            'attribute' => 'group_id',
            'value' => function ($model) {
                if ($model->group) {
                    return $model->group->code;
                } else {
                    return null;
                }

            }
        ],
        [
            'attribute' => 'isActive',
            'filter' => Html::activeDropDownList($searchModel, 'isActive', Student::ACTIVE_STATUSES),
            'format' => 'raw',
            'value' => function ($model) {
                return Html::activeCheckbox($model, 'isActive', ['label' => '', 'data-url' => Url::to(['speciality/change-status']), 'data-id' => $model->id, 'onchange' => 'changeElementStatus(this)']);
            }
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{rate}{update}{delete}',
            'buttons' => [
                'rate' => function ($url, $model) {
                    return Html::a('Успішність', ['student/rate', 'id' => (string)$model->_id, 'page' => Yii::$app->request->get('page') ?? '1']) . '<br>';
                },
                'update' => function ($url, $model) {
                    return Html::a('Редагувати', ['student/update', 'id' => (string)$model->_id, 'page' => Yii::$app->request->get('page') ?? '1']) . '<br>';
                },
                'delete' => function ($url, $model) {
                    return Html::a('Видалити', ['student/delete', 'id' => (string)$model->_id, 'page' => Yii::$app->request->get('page') ?? '1'], [
                        'data' => [
                            'confirm' => Yii::t('app', 'Ви точно хочете видалити цей запис?'),
                            'method' => 'post',
                        ]
                    ]);
                }
            ],
        ],

    ],
    'pager' => [
        'firstPageLabel' => 'Перша сторінка',
        'lastPageLabel' => 'Остання сторінка',
    ],
]);
?>
<?php Pjax::end(); ?>
