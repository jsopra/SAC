<?php

namespace app\models;

use Yii;
use app\components\ActiveRecord;

/**
 * This is the model class for table "pedidos".
 *
 * @property integer $id
 * @property string $numero
 *
 * @property Chamados[] $chamados
 */
class Pedido extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedidos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero'], 'required'],
            [['numero'], 'string'],
            [['numero'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Número',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChamados()
    {
        return $this->hasMany(Chamado::className(), ['pedido_id' => 'id']);
    }
}
