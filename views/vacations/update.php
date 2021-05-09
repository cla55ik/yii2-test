
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Изменение';
$this->params['breadcrumbs'][] = $this->title;
 ?>

  <div class="row">
    <div class="col-12 title">
      <h1>Изменить даты отпуска !</h1>

      <h2> <span><?= $model->getUserFio();?></span></h2>
      <?php if (!$model['change_attr']): ?>
        <div class="alert alert-warning">
          Даты вашего отпуска устверждены руководителем. Вы не можете их изменить.
        </div>
        <span><?= Html::a('Назад', ['index'], ['class'=>'btn btn-success']);?></span>
      <?php else: ?>
        <div>
          Вы запланировали отпуск с <?= $model['date_start'];?> до <?= $model['date_end'];?>
        </div>
        <div>
          Чтобы изменить даты
        </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-4">
      <?= $this->render('_form', ['model' => $model]) ?>
      <?php endif; ?>
    </div>
  </div>
