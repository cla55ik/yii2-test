<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\models\User;

class Vacations extends ActiveRecord{

  public static function tableName()
    {
        return '{{%vacation}}';
    }


}
