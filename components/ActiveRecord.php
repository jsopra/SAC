<?php

namespace app\components;

use \IntlDateFormatter;
use app\components\ActiveQuery;
use app\helpers\StringHelper;
use yii\db\ActiveRecord as YiiActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\validators\Validator;

class ActiveRecord extends YiiActiveRecord
{
    const SAVE_OBJECT = 1;
    const DONT_SAVE_OBJECT = 0;

    protected $dateDbTypes = [
        'date', 'datetime', 'timestamp', 'timestamp without time zone',
        'timestamptz'
    ];

    protected $dateOutcomeFormat = 'Y-m-d';
    protected $dateTimeOutcomeFormat = 'Y-m-d H:i:s';

    protected $dateIncomeFormat = 'yyyy-MM-dd';
    protected $dateTimeIncomeFormat = 'yyyy-MM-dd hh:mm:ss';

    /**
     * @return string
     */
    public static function tableName()
    {
        $className = explode('\\', get_called_class());
        $className = array_pop($className);

        $tableName = StringHelper::camelToWords($className);

        return str_replace(' ', '_', strtolower($tableName));
    }

    /**
     * @param string $descriptionAttribute
     * @param string $idAttribute 'id' by default
     * @param string $groupingRelation Se quiser agrupar por uma relation (ex: bairros agrupados por cidade no <select>)
     * @param string $groupingRelationAttribute Nome do atributo da relation usado para o <optgroup>
     * @return array
     */
    public static function listData($descriptionAttribute, $idAttribute = 'id', $groupingRelation = null, $groupingRelationAttribute = 'id')
    {
        return static::find()->listData($descriptionAttribute, $idAttribute, $groupingRelation, $groupingRelationAttribute);
    }

    /**
     * @inheritdoc
     */
    public static function find()
    {
        $className = get_called_class();
        $queryClassName = str_replace('\\models\\', '\\models\\query\\', $className) . 'Query';
        $tableName = $className::tableName();

        if (class_exists($queryClassName)) {
            $query = new $queryClassName($className);
        }
        else {
            $query = new ActiveQuery($className);
        }

        return $query;
    }

    /**
     * Procura pelos atributos. Se não encontrar, cria um novo
     * @param array $attributes atributo => valor
     * @param boolean $save Se deve salvar o objeto antes de retornar ou só construí-lo
     * @return ActiveRecord
     */
    public static function findOrCreate($attributes, $save = true)
    {
        $object = static::find()->where($attributes)->one();

        if (!$object) {

            $object = new static($attributes);

            if ($save && false == $object->save()) {
                throw new \Exception('Falhou ao salvar objeto! Erros: ' . print_r($object->errors, true));
            }
        }

        return $object;
    }
}
