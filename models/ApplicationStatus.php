<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class ApplicationStatus extends ActiveRecord
{
    public static function tableName()
    {
        return 'application_status_tbl';
    }
}
