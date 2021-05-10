<p align="center">
    <h1 align="center">Тестовое задание. Управление отпусками сотрудников</h1>
    <br>
</p>

Задача:

Нужно сделать простую систему.

Есть рядовой сотрудник, который может:

• ввести начало и конец отпуска;

• посмотреть какие даты отпусков у других сотрудников.

• скорректировать свои даты.

Есть Руководитель, который может:

• так же посмотреть какие даты ввели сотрудники.

• поставить признак, что данные по отпуску конкретного сотрудника зафиксированы.

После этого сотрудник не может скорректировать свои даты


РЕАЛИЗАЦИЯ
-------------------

Проект выполнен на фреймворке [Yii 2](http://www.yiiframework.com/)
и размещен на тестовом [домене](http://yii2.siteforyou.ru.com/) 


Структура базы данных
----------------------
Для хранения информации о Пользователях и их Отпусках созданы 2 таблицы:
User и Vacation соответственно.

В таблице User хранятся данные с именами и должностями пользователей и данные для авторизации пользователей в приложении.  

В таблице Vacation хранятся данные об отпусках: дата начала и дата конца отпуска, ID сотрудника и признак возможности изменеия даты отпуска.

Работа с данными осуществляется через модели User и Vacations средствами интерфейса ActiveRecord.

```
class Vacations extends ActiveRecord 
```


Работа с данными
----------------
Управление датами отпуска пользователи осуществляют через форму реализованную виджетом ActiveForm.

```
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
 ?>



<?php $form = ActiveForm::begin() ?>
<?= $form->field($model,'date_start')->textInput(['type' => 'date']); ?>
<?= $form->field($model,'date_end')->textInput(['type' => 'date']); ?>
<?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?php ActiveForm::end() ?>
```

Планирование отпуска
--------------------
Если пользователь еще не указал даты отпуска, выполняется действие Create

~~~
  public function actionCreate()
~~~

в контроллере VacationsController.
При этом создается новый экземпляр объекта Vacations и сохраняется в таблицу Vacation


Изменение дат отпуска
--------------------
Если пользователь уже планировал отпуск и хочет изменить даты, выполняется действие Update

~~~
  public function actionUpdate()
~~~

в контроллере VacationsController.
При этом вызывается экземпляр объекта модели Vacations и обновляется в таблице Vacation


Запрет изменения дат отпуска
----------------------------
Разрешение и запрет изменения дат отпуска контролируется атрибутом 
~~~
change_attr
~~~
у модели Vacation.
- при значении TRUE - изменение экземпляра Vacation разрешено
- при значении FALSE - изменение запрещено

Изменение атрибута выполняется действием Block
~~~
public function actionBlock($value)
~~~
в контроллере VacationController.

### Вызов действия actionBlock
 Инициализурется на фронте нажатием кнопки с передачей параметра id модели Vacation
 ```
 <?= Html::a('Согласовать и зафиксировать', ['/vacations/block','value' => $vacation['id']], ['class'=>'btn btn-success']) ;?>
 ```


Доступ пользователей к данным
-----------------------------
Доступ к данным реализован на основе RBAC.
Каждому пользователю присвоена одна из трех ролей:
-admin
-manager - руководитель
-worker - сотрудник

и заданы разрешения:
-viewVacation - просмотр отпусков
-addVacation - добавление отпусков
-updateVacation - изменение отпусков
-blockedUpdate - блокировка изменений


Назначение ролей и разрешений RBAC производится запуском скрипта MyRbacController, расположенном в директории \commands\

```
<?php
namespace app\commands;


/*Запуск на сервере 
php yii my-rbac/init
*/


use Yii;
use yii\console\Controller;


class MyRbacController extends Controller {
``



Доступ к разделам приложения настроен в контроллере VacationController:
```
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
                      'actions' => ['index'],
                      'allow' => true,
                      'roles' => ['@'],
                  ],


              ],
          ],

      ];
  }
  ```
  
  Доступ к разделу Vacation имеют только авторизованные пользователи.
  Доступ к добавлению и изменению дат отпуска имеют только пользователи с ролями admin и worker.
  Доступ к блокировке изменений у пользователей с ролями admin и manager.
  
  
  Проверка разрешений 'updateVacation' и 'addVacation' происходит на слое view и в зависимости от наличия или отсутствия разрешений пользователю отображается необходимая информация
  
  
  ```
    <?php if (\Yii::$app->user->can('updateVacation') || \Yii::$app->user->can('addVacation')): ?>
  ```



Валидация данных
-------------------------
Для корректной работы приложения необъодимо соблюдение условий:
-Дата начала отпуска не может быть в прошлом.
-Дата окончания отпуска не может быть раньше даты его начала.

Прокерка соблюдения этих условий происходит в модели Vacation:
```
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
```



