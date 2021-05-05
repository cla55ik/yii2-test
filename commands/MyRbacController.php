<?php
namespace app\commands;


/*Запуск на сервере 
php yii my-rbac/init
*/


use Yii;
use yii\console\Controller;


class MyRbacController extends Controller {

  public function actionInit(){
    $auth = Yii::$app->authManager;
    $auth -> removeAll();

//создаем роли

    $admin = $auth->createRole('admin');
    $manager = $auth->createRole('manager');
    $worker = $auth->createRole('worker');


//записываем роли в DB
    $auth->add($admin);
    $admin->description = 'Администратор';
    $auth->add($manager);
    $auth->add($worker);

// создаем разрешения
    $viewVacation = $auth->createPermission('viewVacation');
    $viewVacation->description = 'просмотр даты отпусков';

    $addVacation = $auth->createPermission('addVacation');
    $addVacation->description = 'добавление даты отпуска';

    $updateVacation = $auth->createPermission('updateVacation');
    $updateVacation->description = 'обновление даты отпуска';

    $blockedUpdate = $auth->createPermission('blockedUpdate');
    $blockedUpdate->description = 'блокировать обновление даты';

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


// Назначаем роли
    $auth->assign($admin, 1);
    $auth->assign($manager, 2);
    $auth->assign($worker, 3);
    $auth->assign($worker, 4);
    $auth->assign($worker, 5);


  }

}
