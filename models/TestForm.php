<?php


namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;


class TestForm extends ActiveRecord{

  public static function tableName()
  {
    return '{{%vacation}}';
  }



  public function attributeLabels(){
      return [
        'date_start' => 'Дата начала',
        'date_end'=> 'Дата конца'
      ];
  }


  public function rules()
  {
    return [
      [ ['date_start', 'date_end'], 'required', 'message' => 'Это поле обязательно'],
      [ ['date_start', 'date_end'], 'safe'],

    ];
  }








}
