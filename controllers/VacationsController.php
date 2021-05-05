<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Vacations;

class VacationsController extends Controller {

  public function actionIndex(){
    $query = Vacations::find();
    $vacations = $query->all();
    $user = $query->where(['id'=>1])
    ->one();

    return $this->render('index',[
      'vacations'=>$vacations,
      'user'=>$user
    ]);
  }



}
