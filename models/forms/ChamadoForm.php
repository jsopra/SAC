<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\Chamado;
use app\models\Pedido;
use app\models\Cliente;

class ChamadoForm extends Model
{
    public $nome;
    public $email;
    public $numero_pedido;
    public $titulo;
    public $observacao;

    private $cliente;
    private $pedido;

    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'email' => 'Email',
            'numero_pedido' => 'Número do Pedido',
            'titulo' => 'Título',
            'observacao' => 'Observações',
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'numero_pedido', 'titulo', 'observacao'], 'required'],
            ['email', 'email'],
            ['numero_pedido', 'validaPedido'],
            [['nome', 'numero_pedido', 'titulo', 'observacao'], 'safe'],
        ];
    }

    public function validaPedido($attribute, $params)
    {
        $this->pedido = Pedido::find()->where(['numero' => $this->numero_pedido])->one();
        if (!$this->pedido) {
            $this->addError('numero_pedido', 'Pedido não encontrado');
        }
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }

        $transaction = Chamado::getDb()->beginTransaction();

        try {

            $this->cliente = Cliente::find()->where(['email' => $this->email])->one();
            if (!$this->cliente) {

                $this->cliente = new Cliente;
                $this->cliente->email = $this->email;
                $this->cliente->nome = $this->nome;

                if (!$this->cliente->save()) {
                    $this->addError('email', 'Erro ao salvar cliente');
                    $transaction->rollback();
                    return false;
                }
            }

            $chamado = new Chamado;
            $chamado->pedido_id = $this->pedido->id;
            $chamado->cliente_id = $this->cliente->id;
            $chamado->titulo = $this->titulo;
            $chamado->observacao = $this->observacao;

            if (!$chamado->save()) {
                $this->addError('titulo', 'Erro ao salvar chamado');
                $transaction->rollback();
                return false;
            }

            $transaction->commit();
            return true;

        } catch (\Exception $e) {
            $transaction->rollback();
        }

        return false;
    }
}
