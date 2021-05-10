
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Планирование отпуска';


 ?>

  <div class="row">
    <div class="col-lg-6 title">
      <h1>Запланировать даты отпуска</h1>
      <h2> <span><?= $model->getUserFio();?></span></h2>

      <?php if (empty($model)): ?>
        <div class="alert alert-warning">
          Вы уже добавляли даты отпуска
        </div>
        <div class="contact">
            <?php if ($model['change_attr']): ?>

              <span><?= Html::a('Обновить даты', ['update'], ['class'=>'btn btn-success']);?></span>
            <?php endif; ?>

            <span><?= Html::a('Назад', ['index'], ['class'=>'btn btn-success']);?></span>
        </div>


      <?php else: ?>

    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">

      <?= $this->render('_form', ['model' => $model]) ?>



<?php endif; ?>


    </div>
  </div>
