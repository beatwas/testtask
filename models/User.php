<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{
    public static function tableName()
    {
        return 'user_tbl';
    }

    public function getApplications()
    {
        return $this->hasMany(Application::class, ['worker_id' => 'id']);
    }
}
