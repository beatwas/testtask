<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Application extends ActiveRecord
{
    public static function tableName()
    {
        return 'application_tbl';
    }

    public function getCategory()
    {
        return $this->hasOne(ApplicationCategory::class, ['id' => 'category_id']);
    }

    public function getStatus()
    {
        return $this->hasOne(ApplicationStatus::class, ['id' => 'status_id']);
    }

    public function getWorker()
    {
        return $this->hasOne(User::class, ['id' => 'worker_id']);
    }
}
