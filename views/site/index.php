<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Abrir Chamado';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="chamado-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-xs-6">
                <?= $form->field($model, 'nome') ?>
            </div>
            <div class="col-xs-6">
                <?= $form->field($model, 'email')->input('email') ?>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-2">
                <?= $form->field($model, 'numero_pedido') ?>
            </div>
            <div class="col-xs-10">
                <?= $form->field($model, 'titulo') ?>
            </div>
        </div>

        <?= $form->field($model, 'observacao')->textArea(['rows' => 6]) ?>

        <div class="form-group">
            <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
