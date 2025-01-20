<?php

use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ArrayDataProvider */
/* @var $categories array */
/* @var $dateFrom string */
/* @var $dateTo string */

$this->title = 'Звіт по заявках';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="application-report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="filter-form">
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'action' => ['index'],
        'fieldConfig' => [
            'template' => "{input}",
            'options' => ['tag' => false],
        ],
    ]); ?>


    <div class="form-group">
        <?= $form->field($filterModel, 'date_from')->input('date', [
            'name' => 'date_from',
        ])->label('Дата з') ?>
    </div>

    <div class="form-group">
        <?= $form->field($filterModel, 'date_to')->input('date', [
            'name' => 'date_to',
        ])->label('Дата по') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Фільтрувати', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Скинути', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => array_merge(
            [['attribute' => 'full_name', 'label' => 'ПІБ']],
            array_map(function ($categoryName) {
                return [
                    'attribute' => $categoryName,
                    'label' => $categoryName,
                ];
            }, $categories),
            [['attribute' => 'total', 'label' => 'Загалом']]
        ),
    ]) ?>

</div>
