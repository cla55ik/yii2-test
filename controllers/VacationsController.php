<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Vacations;
use app\models\User;
use app\models\TestForm;
use yii\base\Model;

class VacationsController extends Controller {
/*
  public function actionUpdate($id)
  {
    $id = \Yii::$app->user->id;
    $model = Vacation::findOne($id);
    return $this->render('updateform', ['model'=>$model]);
  }
*/
  public function actionUpdateform(){
    return $this->render('updateform');
  }

  public function actionTestpage(){
    return $this->render('testpage');
  }





  public function actionIndex(){

    $current_user = \Yii::$app->user->id;
    $vacation_user = User::findOne($current_user);


    $query = Vacations::find();
    $vacations = $query->all();
    $user = $query->where(['user_id'=>$current_user])
    ->one();

    //$model = $query->where(['user_id'=>$current_user])
    //->one();

    //$model = TestForm::findOne(['user_id'=>$current_user]);

    if ($vacation_user == NULL){
      $model = TestForm::findOne($current_user);

      if($model->load(Yii::$app->request->post())){
         if($model->validate()){
           Yii::$app->session->setFlash('success','Данные обновлены');
           $model->save(false);
           return $this->refresh();
         }else{
           Yii::$app->session->setFlash('error', 'Ошибка');
         }
       }
    }else{

    $model = new TestForm();

    if($model->load(Yii::$app->request->post())){
       if($model->validate()){
         Yii::$app->session->setFlash('success','Данные обновлены');
         $model->save(false);
         return $this->refresh();
       }else{
         Yii::$app->session->setFlash('error', 'Ошибка');
       }
     }
}



/*
    $model = new TestForm();
    //  if($model->load(Yii::$app->request-post())){
        if($model->validate()){
          //\Yii::$app->session->setFlash('success','Данные обновлены');
          return $this->refresh();
        }else{
          //\Yii::$app->session->setFlash('error', 'Ошибка');
        }
      }

*/
    return $this->render('index',[
      'vacations'=>$vacations,
      'user'=>$user,
      'current_user'=>$current_user,
      'model' => $model,
      'vacation_user' => $vacation_user
    ]);
  }



}
