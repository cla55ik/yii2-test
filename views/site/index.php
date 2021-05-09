<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Сайт компании';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Сайт компании</h1>

        <p class="lead">Скоро здесь появится многофункциональный сайт</p>
        <p class="lead">Сейчас можно управлять отпусками сотрудников</p>

        <?= Html::a('Управлять отпуском', ['/vacations/index'], ['class'=>'btn btn-success']);?>
    </div>


</div>
