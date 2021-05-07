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
                      'actions' => ['index','create','udate','viewall'],
                      'allow' => true,
                      'roles' => ['@'],
                  ],
                  [
                    'actions' => ['update', 'create'],
                    'allow' => true,
                    'roles' => ['worker', 'admin'],

                  ],
                  [
                    'actions' => ['block'],
                    'allow' => true,
                    'roles' => ['manager', 'admin'],

                  ],
              ],
          ],

      ];
  }




  public function actionTestpage(){
    return $this->render('testpage');
  }

  public function actionCreate()
  {
    $current_user = \Yii::$app->user->id;
    $user = User::findOne($current_user);
    $vacation = Vacations::findOne(['user_id'=>$current_user]);
    $count = Vacations::find()->count();

    $model = new Vacations();
    $model->user_id = $current_user;
    $model->id=$count;

    if($model->load(Yii::$app->request->post()) && $model->save()) {
      return $this->redirect(['index']);
    }

      return $this->render('create', ['model' => $model]);
  }




  public function actionUpdate()
  {
    $current_user = \Yii::$app->user->id;
    $user = User::findOne($current_user);
    $vacation = Vacations::findOne(['user_id'=>$current_user]);

    $model = Vacations::findOne(['user_id'=>$current_user]);

    if($model->load(Yii::$app->request->post())){
       if($model->validate()){
         Yii::$app->session->setFlash('success','Данные обновлены');
         $model->save();
         return $this->refresh();
       }else{
         Yii::$app->session->setFlash('error', 'Ошибка');
       }
     }
     return $this->render('update', ['model' => $model]);
  }




  public function actionBlock()
  {
    $vacations = Vacations::find()->all();
    return $this->render('block', ['vacations' => $vacations]);
  }



  public function actionViewall()
  {
      $vacations = Vacations::find()
          ->joinWith('user')
          ->all();
    //  $user = $vacations->user;
      
      return $this->render('viewall', [

          'vacations'=>$vacations,
      ]);
  }




  public function actionIndex(){


 $roles = \Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());

    $current_user = \Yii::$app->user->id;
    $user = User::findOne($current_user);
    $vacation = Vacations::findOne(['user_id'=>$current_user]);

$user_cur = $vacation->user;
$vacation_cur = $user->vacation;

    $model =  Vacations::find()->all();




    //Проверем есть ли запись в таблице Vacation для залогиненного юзера
  /*  if($vacation == NULL){

      $model = new Vacations();
      $count = Vacations::find()->count();
      $model->user_id = $current_user;
      $model->id=$count;




      $model->save(false);


    }else{
        $model = Vacations::findOne(['user_id'=>$current_user]);

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
*/
      return $this->render('index',[
        'user'=>$user,
        'model'=>$model,
        'vacation'=>$vacation,
        'roles'=>$roles,
        'user_cur'=>$user_cur,
        'vacation_cur'=>$vacation_cur,
      ]);


  }





}
