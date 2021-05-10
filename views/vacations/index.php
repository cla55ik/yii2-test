<?php
use yii\widgets\ActiveForm;

use yii\helpers\Html;

$this->title = 'Отпуск';

 ?>

  <div class="row">
    <div class="col-lg-6 title">
          <h1>Отпуск. Планирование </h1>
          <h2> <span><?= $user['fio'];?></span><span class="gray-title"><?= $user['post'];?></span> </h2>

    </div>
    <div class="col-lg-6 control">
      <?php if (\Yii::$app->user->can('updateVacation') || \Yii::$app->user->can('addVacation')): ?>


        <?php if(empty($vacation) || $user['id'] == NULL) : ?>
          <div class="alert alert-warning">
            Вы еще не запланировали отпуск
          </div>
          <?= Html::a('Запланировать отпуск', ['create'], ['class'=>'btn btn-success']);?>
        <?php else :?>
          <div class="alert alert-success">
            Вы запланировали отпуск с <?= $vacation['date_start'];?> до <?= $vacation['date_end'];?>
          </div>

        <?php if($vacation['change_attr']) :?>
          <div class="alert alert-success">
            <span>Вы можете обновить даты отпуска</span>
            <span><?= Html::a('Обновить даты', ['update'], ['class'=>'btn btn-success']);?></span>
          </div>


        <?php else: ?>
          <div class="alert alert-warning">
              <p class="text-uppercase">Даты вашего отпуска согласованы</p>
          </div>
        <?php endif; ?>
      <?php endif;?>
      <?php endif; ?>
    </div>
  </div>

  <div class="row">

  </div>
<div class="row">
  <div class="col title">
    <h2>Список отпусков всех сотрудников</h2>
  </div>
</div>


<div class="row">
  <div class="col">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Сотрудник</th>
          <th scope="col">Даты отпуска</th>
          <th scope="col">Статус</th>
          <?php if (\Yii::$app->user->can('blockedUpdate') || \Yii::$app->user->can('admin')): ?>
            <th scope="col">Действие</th>
          <?php endif; ?>

        </tr>
      </thead>
      <tbody>
        <?php $num=0; ?>
        <?php foreach ($vacations as $vacation): ?>
          <?php $user=$vacation['user'];
            $num ++;
          ?>
          <tr>
            <th scope="col"><?= $num  ?></th>
            <td><span><?=$user['fio'];?></span><span class="gray-title"><?=$user['post'];?></span></td>
            <td>с <?=$vacation['date_start'];  ?> по <?=$vacation['date_end'];  ?></td>
            <td><?= ($vacation['change_attr'] ? 'на утверждении' :  'согласован'); ?></td>
            <?php if (\Yii::$app->user->can('blockedUpdate') || \Yii::$app->user->can('admin')): ?>
              <td>
                <?php if ($vacation['change_attr']): ?>
                  <?= Html::a('Согласовать и зафиксировать', ['/vacations/block','value' => $vacation['id']], ['class'=>'btn btn-success']) ;?>
                  <?php else: ?>

                    <?= Html::a('Разрешить редактирование', ['/vacations/block','value' => $vacation['id']], ['class'=>'btn btn-primary']) ;?>
                <?php endif; ?>

              </td>
            <?php endif; ?>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </div>
</div>
