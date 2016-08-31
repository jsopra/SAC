<?php

namespace app\models\search;

use app\components\SearchModel;

class ChamadoSearch extends SearchModel
{
    public $cliente_id;
    public $pedido_id;

    public function rules()
    {
        return [
            [['cliente_id', 'pedido_id'], 'safe'],
        ];
    }

    public function searchConditions($query)
    {
        $this->addCondition($query, 'cliente_id');
        $this->addCondition($query, 'pedido_id');
    }
}
