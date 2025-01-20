<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ArrayDataProvider;
use app\models\Application;
use app\models\ApplicationCategory;
use app\models\ApplicationStatus;
use app\models\ApplicationReportFilter;
use app\models\User;

class ReportController extends Controller
{
    public function actionIndex()
    {
        $filterModel = new ApplicationReportFilter();

        $dateFrom = Yii::$app->request->get('date_from');
        $dateTo = Yii::$app->request->get('date_to');
        
        $filterModel->date_from = $dateFrom;
        $filterModel->date_to = $dateTo;


        $categories = ApplicationCategory::find()
            ->select(['category_name'])
            ->indexBy('id')
            ->column();

        $query = Application::find()
            ->alias('a')
            ->select([
                "CONCAT(u.first_name, ' ', u.last_name) AS full_name",
                "COUNT(a.id) AS total",
            ])
            ->joinWith(['category c', 'worker u', 'status s'])
            ->andWhere(['s.status_name' => 'Вирішена']);

        if ($filterModel->date_from) {
            $query->andWhere(['>=', 'a.datetime_solved', $filterModel->date_from]);
        }
        if ($filterModel->date_to) {
            $query->andWhere(['<=', 'a.datetime_solved', $filterModel->date_to]);
        }

        foreach ($categories as $categoryName) {
            $query->addSelect([
                "SUM(CASE WHEN c.category_name = '$categoryName' THEN 1 ELSE 0 END) AS `$categoryName`"
            ]);
        }

        $data = $query->groupBy('u.id')->asArray()->all();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => array_merge(['full_name'], $categories, ['total']),
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'filterModel' => $filterModel,
        ]);
    }
}
