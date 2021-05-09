<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Vacations;
use app\models\User;
use app\models\TestForm;
use yii\base\Model;
use yii\filters\AccessControl;

class VacationsController extends Controller {

  public function behaviors()
  {
      return [
          'access' => [
              'class' => AccessControl::className(),

              'rules' => [
                  [
                    'actions' => ['block'],
                    'allow' => true,
                    'roles' => ['manager', 'admin'],

                  ],
                  [
                    'actions' => ['update', 'create'],
                    'allow' => true,
                    'roles' => ['worker', 'admin'],

                  ],
                  [
                      'actions' => ['index','viewall'],
                      'allow' => true,
                      'roles' => ['@'],
                  ],


              ],
          ],

      ];
  }






  public function actionCreate()
  {
    $current_user = \Yii::$app->user->id;
    $user = User::findOne($current_user);
    $vacation = Vacations::findOne(['user_id'=>$current_user]);
    $max = Vacations::find()->max('id');

    if(empty($vacation)){

    $model = new Vacations();
    $model->user_id = $current_user;
    $model->id = $max + 1;


    if($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['index']);
    }else{
      Yii::$app->session->setFlash('error', 'Ошибка');
    }

      return $this->render('create', ['model' => $model]);
  }
 else{
      return $this->redirect(['index']);

}
}




  public function actionUpdate()
  {
    $current_user = \Yii::$app->user->id;
    $user = User::findOne($current_user);
    $vacation = Vacations::findOne(['user_id'=>$current_user]);

    $model = Vacations::findOne(['user_id'=>$current_user]);


    if(empty($model)){
      return $this->redirect('create');
    }

    if($model->load(Yii::$app->request->post())){
       if($model->validate()){
         Yii::$app->session->setFlash('success','Данные обновлены');
         $model->save();
         return $this->redirect('index');
       }else{
         Yii::$app->session->setFlash('error', 'Ошибка');
       }
     }
     return $this->render('update', ['model' => $model]);
  }




  public function actionBlock($value)
  {
    $vacations = Vacations::find()->all();
    $vacation = Vacations::findOne(['id' => $value]);
    $attr = $vacation->change_attr;
    if($attr){
      $vacation->change_attr = 0;
      $vacation->save();
      return $this->redirect(Yii::$app->request->referrer);


    }else{
      $vacation->change_attr = 1;
      $vacation->save();
      return $this->redirect(Yii::$app->request->referrer);


    }




  }



  public function actionIndex()
  {
      $current_user = \Yii::$app->user->id;
      $user = User::findOne($current_user);
      $vacation = Vacations::findOne(['user_id'=>$current_user]);

      $model = Vacations::find()
          ->joinWith('user')
          ->asArray()
          ->all();
    //  $user = $vacations->user;

      return $this->render('index', [
          'vacation'=>$vacation,
          'vacations'=>$model,
          'user'=>$user,
      ]);
  }




  public function actionViewAll(){


 $roles = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

    $current_user = \Yii::$app->user->id;
    $user = User::findOne($current_user);
    $vacation = Vacations::findOne(['user_id'=>$current_user]);

$user_cur = $vacation->user;
$vacation_cur = $user->vacation;

    $model =  Vacations::find()->all();


      return $this->render('viewall',[
        'user'=>$user,
        'model'=>$model,
        'vacation'=>$vacation,
        'roles'=>$roles,
        'user_cur'=>$user_cur,
        'vacation_cur'=>$vacation_cur,
      ]);


  }





}
