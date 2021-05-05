<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Update Vacations';

?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'update-form']); ?>

                    <?= $form->field($model, 'date_start')?>

                    <?= $form->field($model, 'date_end') ?>


                    <div class="form-group">
                        <?= Html::submitButton('Обновить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

</div>
