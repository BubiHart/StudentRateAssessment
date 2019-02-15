<?php

use backend\models\Specialization;
use backend\models\search\SpecializationSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\web\View;

/* @var $this View */
/* @var $searchModel SpecializationSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = 'Спеціалізації';
$this->params['breadcrumbs'][] = $this->title;

?>
<h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin([
    'id' => 'speciality',
]); ?>

<p>
    <?= Html::a('Додати нову спецалізацію', ['create', 'page' => Yii::$app->request->get('page') ?? '1'], ['class' => 'btn btn-success']) ?>
</p>


<?= GridView::widget([
    'filterModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'attribute' => 'speciality_id',
            'value' => function ($model) {
                if (isset($model->speciality_id))
                    if ($model->speciality) {

                        return $model->speciality->code . ' ' . $model->speciality->name;
                    }
                return null;
            }
        ],
        [
            'attribute' => 'code',
            'filter' => '',
        ],
        [
            'attribute' => 'name',
            'filter' => '',
        ],
        [
            'attribute' => 'isActive',
            'filter' => /*Specialization::ACTIVE_STATUSES*/'',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::activeCheckbox($model, 'isActive', ['label' => '', 'data-url' => Url::to(['specialization/change-status']), 'data-id' => $model->id, 'onchange' => 'changeElementStatus(this)']);
            }
        ],
        ['class' => 'yii\grid\ActionColumn',
            'template' => '{update}{delete}',
            'buttons' => [
                'update' => function ($url, $model) {
                    return Html::a('Редагувати', ['specialization/update', 'id' => (string)$model->_id, 'page' => Yii::$app->request->get('page') ?? '1']) . '<br>';
                },
                'delete' => function ($url, $model) {
                    return Html::a('Видалити', ['specialization/delete', 'id' => (string)$model->_id, 'page' => Yii::$app->request->get('page') ?? '1'], [
                        'data' => [
                            'confirm' => Yii::t('app', 'Ви точно хочете видалити запис?'),
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
