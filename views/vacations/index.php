

<div class="section">
  <div class="row">
    <div class="col">
      <h1>Календарь отпусков</h1>

    </div>


  <div class="row">
    <div class="col">
      <?php if(empty($vacations)) : ?>
        <p>Данные не заполнены</p>
      <?php else :?>
        <p>Данные есть</p>
        <p>userID= <?=$user['user_id'];?></p>
      <?php endif;?>



    </div>

  </div>
</div>
</div>
