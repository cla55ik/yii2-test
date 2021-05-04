<?php
namespace console\controller;

use Yii;
use yii\console\Controller;


class MyRbacController extends Controller{

  public function actionInit(){
    $auth = Yii::$app->authManager;
    $auth -> removeAll();

//создаем роли

    $admin = $auth->createRole('admin');
    $manager = $auth->createRole('manager');
    $worker = $auth->createRole('worker');


//записываем роли в DB
    $auth->add($admin);
    $auth->add($manager);
    $auth->add($worker);

// создаем разрешения
    $viewVacation = $auth->createPermission('viewVacation');
    $viewVacation->descripion = 'просмотр даты отпусков';

    $addVacation = $auth->createPermission('addVacation');
    $addVacation->descripion = 'добавление даты отпуска';

    $updateVacation = $auth->createPermission('updateVacation');
    $updateVacation->descripion = 'обновление даты отпуска';

    $blockedUpdate = $auth->createPermission('blockedUpdate');
    $blockedUpdate->descripion = 'блокировать обновление даты';

//записываем разрешения в DB
    $auth->add($viewVacation);
    $auth->add($addVacation);
    $auth->add($updateVacation);
    $auth->add($blockedUpdate);

//Добавляем наследование для ролей и разрешений

    $auth->addChild($worker, $viewVacation);
    $auth->addChild($worker, $addVacation);
    $auth->addChild($worker, $updateVacation);

    $auth->addChild($manager, $viewVacation);
    $auth->addChild($manager, $blockedUpdate);

    $auth->addChild($admin, $worker);
    $auth->addChild($admin, $updateVacation);


  }

}
