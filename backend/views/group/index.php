<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Групи';
$this->params['breadcrumbs'][] = $this->title;

?>
    <h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin();?>

<p>
    <?= Html::a('Створити нову групу', ['create', 'page' => Yii::$app->request->get('page') ?? '1'], ['class' => 'btn btn-success']) ?>
</p>


<?= GridView::widget([
        'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'speciality_id',
                'value' => function($model){
                    if($model->speciality){
                        return $model->speciality->name;
                    }
                    return null;
                },
                'filter' => ''

            ],
            [
                'attribute' => 'specialization_id',
                'value' => function($model) {
                    if ($model->specialization) {
                        return $model->specialization->name;
                    }
                    return null;
                },
                'filter' => ''
            ],
            [
                'attribute' => 'code',
                'filter' => ''
            ],
            [
                'attribute' => 'isActive',
                'filter' => '',
//                'filter' => Group::ACTIVE_STATUSES,
                'format' => 'raw',
                'value' => function($model){
                    return Html::activeCheckbox($model, 'isActive', ['label' => '']);
                }
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
                'buttons' => [
                    'update' => function ($url, $model){
                        return Html::a('Редагувати', ['update', 'id' => (string) $model->_id, 'page' => Yii::$app->request->get('page') ?? '1']).'<br>';
                    },
                    'delete' => function ($url, $model){
                        return Html::a('Видалити', ['delete', 'id' => (string) $model->_id, 'page' => Yii::$app->request->get('page') ?? '1'], [
                            'data' => [
                                'confirm' => Yii::t('app', 'Ви дійсно хочете видалити цей запис?'),
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
