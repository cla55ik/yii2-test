
<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

 ?>



 <div class="row">

   <?php foreach ($vacations as $vacation) : ?>
     <div class="col-lg-4">
       <?= $vacation['id']; ?>
     </div>
     <div class="col-lg-4">
       <?= $vacation['date_start']; ?> -
       <?= $vacation['date_start']; ?>
     </div>
     <div class="col-lg-4">
       <?= $vacation['change_attr']; ?>
     </div>
  <?php endforeach; ?>

 </div>
