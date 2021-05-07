
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

 ?>



<div class="section">
  <div class="row">
    <div class="col">
      <h1>Добавить даты отпуска</h1>

    </div>


  <div class="row">
    <div class="col">

    <?= $this->render('_form', ['model' => $model]) ?>




<?=\Yii::$app->user->id;?>

<?php print_r($model); ?>

<div class="">
User ID = <?= Yii::$app->user->id;?>
</div>




</div>
</div>
</div>
</div>
