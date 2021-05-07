<?php
use yii\widgets\ActiveForm;

use yii\helpers\Html;
 ?>

  <div class="row">
    <div class="col title">
          <h1>Отпуск. Планирование </h1>
          <h2> <?= $user['username'];?>  UserID= <?=\Yii::$app->user->id;?></h2>
    </div>
  </div>

  <div class="row">
    <div class="col control">
      <?php if(empty($vacation) || $user['id'] == NULL) : ?>
        <p>Вы еще не запланировали отпуск</p>
        <?= Html::a('Запланировать отпуск', ['create'], ['class'=>'btn btn-success']);?>
      <?php else :?>
        <div class="">
          Вы запланировали отпуск с <?= $vacation['date_start'];?> до <?= $vacation['date_end'];?>
        </div>

        <?php if($vacation['change_attr']) :?>
          <p>Вы можете обновить даты отпуска</p>
          <?= Html::a('Обновить даты', ['update'], ['class'=>'btn btn-success']);?>
        <?php else: ?>
          <p class="text-uppercase">Даты вашего отпуска согласованы</p>
        <?php endif; ?>
      <?php endif;?>





    </div>





  </div>

<div class="row">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Сотрудник</th>
        <th scope="col">Даты отпуска</th>
        <th scope="col">Статус</th>
        <th scope="col">Действие</th>
      </tr>
    </thead>
    <tbody>
      <?php $num=1; ?>
      <?php foreach ($vacations as $vacation): ?>
        <?php $user=$vacation['user'];
          $num ++;
        ?>
        <tr>
          <th scope="col"><?= $num  ?></th>
          <td><?=$user['username'];  ?></td>
          <td>с <?=$vacation['date_start'];  ?> по <?=$vacation['date_end'];  ?></td>
          <td><?= $vacation['change_attr']; ?></td>
          <td><?= Html::a('Управлять', ['block'], ['class'=>'btn btn-success']);?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>
