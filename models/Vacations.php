<?php

namespace app\models;


use yii\db\ActiveRecord;
use app\models\User;
use yii\base\Model;
use Yii;

class Vacations extends ActiveRecord{

  public static function tableName()
    {
        return '{{%vacation}}';
    }



    public function attributeLabels(){
        return [
          'date_start' => 'Дата начала',
          'date_end'=> 'Дата конца',

        ];
    }





    public function rules()
    {
      return [
        [['date_start', 'date_end'], 'required', 'message' => 'Заполните это поле'],
        ['date_start', function(){
            $date_start = strtotime($this->date_start);

            $today = strtotime(date('d.m.Y'));
            if($today > $date_start){
              $this->addError('date_start', 'Дата начала отпуска должна быть больше сегодняшней');
            }
          }
        ],
        ['date_end', function(){
            if($this->date_start > $this->date_end){
              $this->addError('date_end', 'Дата окончания отпуска должна быть больше даты начала');
            }
        }

      ],
      ];
    }


      public function afterFind()
        {
          $date_start = strtotime($this->date_start);
          $this->date_start = date('d.m.Y',$date_start);
          $date_end = strtotime($this->date_end);
          $this->date_end = date('d.m.Y',$date_end);


        }


        public function beforeSave($insert)
        {
          $date_start = strtotime($this->date_start);
          $this->date_start = date('Y-m-d', $date_start);
          $date_end = strtotime($this->date_end);
          $this->date_end = date('Y-m-d', $date_end);

          return parent::beforeSave($insert);
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


      public function getUserFio(){
        $user = User::findOne(['id'=>User::findIdentity(\Yii::$app->user->id)]);

        return $user->getFio();
      }

      public function getUserPost(){
        $user = User::findOne(['id'=>User::findIdentity(\Yii::$app->user->id)]);
        return $user->getPost();
      }




}
