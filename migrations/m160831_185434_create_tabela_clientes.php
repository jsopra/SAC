<?php

use yii\db\Migration;

class m160831_185434_create_tabela_clientes extends Migration
{
    public function up()
    {
        $this->createTable('clientes', [
            'id' => 'pk',
            'nome' => 'varchar not null',
            'email' => 'varchar not null',
        ]);
    }

    public function down()
    {
        $this->dropTable('clientes');
    }
}
