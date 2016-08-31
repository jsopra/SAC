<?php

use yii\db\Migration;

class m160831_185428_create_tabela_pedidos extends Migration
{
    public function up()
    {
        $this->createTable('pedidos', [
            'id' => 'pk',
            'numero' => 'varchar not null',
        ]);
    }

    public function down()
    {
        $this->dropTable('pedidos');
    }
}
