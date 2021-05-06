
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

 ?>



<div class="section">
  <div class="row">
    <div class="col">
      <h1>Календарь отпусков для пользователя</h1>

    </div>


  <div class="row">
    <div class="col">
      <?php if(empty($vacations) || $user['user_id'] == NULL) : ?>
        <p>Данные не заполнены</p>
      <?php else :?>
        <p>Данные есть</p>
        <p>userID= <?=$user['user_id'];?></p>
        <p>Дата начала отпуска: <?= $user['date_start'];?></p>
        <p>Дата конца отпуска: <?= $user['date_end'];?></p>

      <?php endif;?>
<?php if(\Yii::$app->user->can('blockedUpdate')): ?>
  <p>$blockedUpdate</p>
  <?php else: ?>
    <p>not can</p>
  <?php endif; ?>


  <?php if($user['change_attr']): ?>
    <p>Даты можно изменить</p>
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model,'date_start')->textInput(['type' => 'date']); ?>
    <?= $form->field($model,'date_end')->textInput(['type' => 'date']); ?>
    <?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
    <?php ActiveForm::end() ?>
  <?php else: ?>
    <p>Дата подтверждена, изменить невозможно</p>
  <?php endif; ?>



<?=\Yii::$app->user->id;?>


<div>USER ID = <?=$vacation_user['id'];?><div>
<div>DATE START  <?=$model['date_start'];?><div>
<div>DATE END  <?=$model['date_end'];?><div>
<div>change_attr =   <?=$model['change_attr'];?><div>


    </div>

  </div>
</div>
</div>
