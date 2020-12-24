<?php

namespace app\models;

use Yii\db\ActiveRecord;

/**
 * This is the model class for table "Cabinets".
 *
 * @property int $id
 * @property int $cabnetFloor Этаж кабинета
 * @property int $cabnetNumber Номер кабинета
 * @property string $cabnetDesc Описание кабинета
 */
class Cabinets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Cabinets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cabnetFloor', 'cabnetNumber', 'cabnetDesc'], 'required'],
            [['cabnetFloor', 'cabnetNumber'], 'integer'],
            [['cabnetDesc'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cabnetFloor' => 'Cabnet Floor',
            'cabnetNumber' => 'Cabnet Number',
            'cabnetDesc' => 'Cabnet Desc',
        ];
    }
}
