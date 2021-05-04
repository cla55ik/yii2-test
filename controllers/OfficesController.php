<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Offices;

class OfficesController extends Controller
{
  public function actionIndex()
  {
    $query = Offices::find();
    $offices = $query->orderBy('name')
    ->all();

    return $this->render('index',['offices'=>$offices]);
  }

}
