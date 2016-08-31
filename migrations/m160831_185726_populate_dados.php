<?php

use yii\db\Migration;

class m160831_185726_populate_dados extends Migration
{
    public function up()
    {
        for ($i = 1; $i <= 10; $i++) {
            $pedido = new app\models\Pedido;
            $pedido->numero = str_pad($i, 4, "0", STR_PAD_LEFT);
            $pedido->save();
        }

        for ($i = 1; $i <= 10; $i++) {
            $cliente = new app\models\Cliente;
            $cliente->nome = 'Cliente ' . $i;
            $cliente->email = 'cliente' . $i . '@longevo.com.br';
            $cliente->save();
        }

        for ($i = 1; $i <= 10; $i++) {
            $chamado = new app\models\Chamado;
            $chamado->cliente_id = $cliente->id;
            $chamado->pedido_id = $pedido->id;
            $chamado->titulo = 'Chamado ' . $i;
            $chamado->observacao = 'Observações <br />do chamado <br /> número ' . $i;
            $chamado->save();
        }
    }

    public function down()
    {
        echo "m160831_185726_populate_dados cannot be reverted.\n";
        return false;
    }
}
