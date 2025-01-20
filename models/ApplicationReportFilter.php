<?php

namespace app\models;

use yii\base\Model;

class ApplicationReportFilter extends Model
{
    public $date_from;
    public $date_to;

    public function rules()
    {
        return [
            [['date_from', 'date_to'], 'date', 'format' => 'php:Y-m-d'],
            [['date_from', 'date_to'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'date_from' => 'Дата з',
            'date_to' => 'Дата по',
        ];
    }
}
