
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;


 ?>

  <div class="row">
    <div class="col title">
      <h1>Изменить даты отпуска</h1>
      <p>Вы запланировали отпуск с <?= $model['date_start'];?> до <?= $model['date_end'];?></p>
    </div>
  </div>

  <div class="row">
    <div class="col">

      <?= $this->render('_form', ['model' => $model]) ?>


    <div class="col">
      User ID = <?= Yii::$app->user->id;?>
    </div>




    </div>
  </div>
