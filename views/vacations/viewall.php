<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
 ?>




<div class="row">


  <?= var_dump($vacations); ?>

  <div class="col-lg-3">
    Vacation ID
  </div>
  <div class="col-lg-3">
    Даты отпуска
  </div>
  <div class="col-lg-3">
    change_attr
  </div>

  <div class="col-lg-3">

    Действие
  </div>

<?php foreach ($vacations as $vacation) : ?>
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
