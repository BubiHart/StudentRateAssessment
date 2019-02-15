<?php

use backend\models\Speciality;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\SpecialitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Спеціальності';
$this->params['breadcrumbs'][] = $this->title;
$activeStatuses = Speciality::ACTIVE_STATUSES;

?>
    <h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin([
        'id' => 'speciality'
]);?>

<p>
    <?= Html::a('Додати нову спеціальність', ['create', 'page' => Yii::$app->request->get('page') ?? '1'], ['class' => 'btn btn-success']) ?>
</p>


<?= GridView::widget([
        'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'code',
            ],
            [
                'attribute' => 'name',
            ],
            [
                'attribute' => 'isActive',
                'filter' => Html::activeDropDownList($searchModel, 'isActive', Speciality::ACTIVE_STATUSES),
                'format' => 'raw',
                'value' => function($model){
                    return Html::activeCheckbox($model, 'isActive', ['label' => '', 'data-url' => Url::to(['speciality/change-status']), 'data-id' => $model->id, 'onchange' => 'changeElementStatus(this)']);
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model){
                        return Html::a('Редагувати', ['speciality/update', 'id' => (string) $model->_id, 'page' => Yii::$app->request->get('page') ?? '1']).'<br>';
                    },
                    'delete' => function ($url, $model){
                        return Html::a('Видалити', ['speciality/delete', 'id' => (string) $model->_id, 'page' => Yii::$app->request->get('page') ?? '1'], [
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
<?php Pjax::end();?>
