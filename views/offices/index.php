<?php
use yii\helpers\Html;

 ?>

 <h1>Offices</h1>

 <div class="section">
   <div class="row">
     <div class="col">
    <?php foreach ($offices as $office): ?>
      <span>
       <?= $office->name; ?>
      </span>
    <?php endforeach; ?>
     </div>

   </div>

 </div>
