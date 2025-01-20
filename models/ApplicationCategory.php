<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class ApplicationCategory extends ActiveRecord
{
    public static function tableName()
    {
        return 'application_category_tbl';
    }
}
