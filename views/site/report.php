<?php

use app\widgets\GridView;
use yii\helpers\Html;
use app\models\Pedido;
use app\models\Cliente;

$this->title = 'Relatório de Chamados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'exportable' => false,
        'buttons' => [],
        'columns' => [
            [
                'attribute' => 'cliente_id',
                'filter' => Cliente::listData('email'),
                'value' => function ($model, $index, $widget) {
                    return $model->cliente->nome . ' (' . $model->cliente->email . ')';
                },
                'options' => ['width' => '25%'],
            ],
            [
                'attribute' => 'pedido_id',
                'filter' => Pedido::listData('numero'),
                'value' => function ($model, $index, $widget) {
                    return $model->pedido->numero;
                },
                'options' => ['width' => '25%'],
            ],
            'titulo',
            [
                'format' => 'raw',
                'attribute' => 'observacao',
                'filter' => false,
                'value' => function ($model, $index, $widget) {
                    return nl2br($model->observacao);
                },
                'options' => ['width' => '25%'],
            ],
        ],
    ]);
    ?>

</div>
