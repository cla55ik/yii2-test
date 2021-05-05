<?php

namespace app\models;

use yii\db\ActiveRecord;

class Vacations extends ActiveRecord{

  public static function tableName()
    {
        return '{{%vacation}}';
    }

}
