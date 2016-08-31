<?php

use yii\db\Migration;

class m160831_185438_create_tabela_chamados extends Migration
{
    public function up()
    {
        $this->createTable('chamados', [
            'id' => 'pk',
            'cliente_id' => 'integer not null references clientes(id)',
            'pedido_id' => 'integer not null references pedidos(id)',
            'titulo' => 'varchar not null',
            'observacao' => 'varchar not null',
        ]);
    }

    public function down()
    {
        $this->dropTable('chamados');
    }
}
