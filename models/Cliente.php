<?php

namespace app\models;

use Yii;
use app\components\ActiveRecord;

/**
 * This is the model class for table "clientes".
 *
 * @property integer $id
 * @property string $nome
 * @property string $email
 *
 * @property Chamados[] $chamados
 */
class Cliente extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'email'], 'required'],
            [['nome', 'email'], 'string'],
            ['email', 'email'],
            [['email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChamados()
    {
        return $this->hasMany(Chamado::className(), ['cliente_id' => 'id']);
    }
}
