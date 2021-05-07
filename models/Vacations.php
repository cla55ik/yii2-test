<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\User;
use Yii;

class Vacations extends ActiveRecord{

  public static function tableName()
    {
        return '{{%vacation}}';
    }







    public function rules()
    {
      return [
        [['date_start', 'date_end'], 'required'],
      ];
    }


      public function attributeLabels(){
          return [
            'date_start' => 'Дата начала',
            'date_end'=> 'Дата конца'
          ];
      }


      public function getUser()
      {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
      }



        public function afterSave($insert, $changedAttributes)
        {
          if ($insert) {
            Yii::$app->session->setFlash('success', 'Запись добавлена');
          } else {
            Yii::$app->session->setFlash('success', 'Запись обновлена');
          }
          parent::afterSave($insert, $changedAttributes);
        }




      public function getId()
      {
        return $this->getPrimaryKey();
      }



}
