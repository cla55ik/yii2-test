
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;


 ?>




  <div class="row">
    <div class="col title">
      <h1>Изменить даты отпуска</h1>

      <?php if (!$model['change_attr']): ?>
        <div class="alert alert-warning">
          Даты вашего отпуска устверждены руководителем. Вы не можете их изменить.
        </div>
        <span><?= Html::a('Назад', ['index'], ['class'=>'btn btn-success']);?></span>

      <?php else: ?>
      <p>Вы запланировали отпуск с <?= $model['date_start'];?> до <?= $model['date_end'];?></p>
    </div>
  </div>

  <div class="row">
    <div class="col">

      <?= $this->render('_form', ['model' => $model]) ?>



<?php endif; ?>


    </div>
  </div>
