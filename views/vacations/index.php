
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
 ?>



<div class="section">
  <div class="row">
    <div class="col">
      <h1>Календарь отпусков для пользователя <?= $user['username'];?>  UserID= <?=\Yii::$app->user->id;?></h1>

    </div>


  <div class="row">
    <div class="col">



      <?= Html::a('Смотреть все', ['viewall'], ['class'=>'btn btn-success']);?>
      <?= Html::a('Управлять', ['block'], ['class'=>'btn btn-success']);?>



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
<?php if(\Yii::$app->user->can('manager')): ?>
  <p>$blockedUpdate</p>
  <?php else: ?>
    <p>not can</p>
  <?php endif; ?>


  <?php print_r(\Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()));?>

  <?php print_r($user_cur);?>
<?php print_r($vacation_cur);?>







<div class="row">


<?php foreach ($model as $vacation) : ?>
  <div class="col-lg-3">
    <?= $vacation['id']; ?>
  </div>
  <div class="col-lg-3">
    <?= $vacation['date_start']; ?> -
    <?= $vacation['date_start']; ?>
  </div>
  <div class="col-lg-3">
    <?= $vacation['change_attr']; ?>
  </div>
  <?php if($vacation['change_attr']) : ?>
  <div class="col-lg-3">

    <?= Html::a('Утвердить', ['block'], ['class'=>'btn btn-success']);?>
  </div>
  <?php else : ?>
    <div class="col-lg-3">
      Отпуск утвержден
    </div>
  <?php endif; ?>
<?php endforeach; ?>
</div>

  </div>
</div>
</div>
