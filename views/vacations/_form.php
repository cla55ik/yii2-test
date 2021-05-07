

<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
 ?>



<?php $form = ActiveForm::begin() ?>
<?= $form->field($model,'date_start')->textInput(['type' => 'date']); ?>
<?= $form->field($model,'date_end')->textInput(['type' => 'date']); ?>
<?= Html::submitButton('Сохранить',['class'=>'btn btn-success'])?>
<?php ActiveForm::end() ?>
