<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "expense".
 *
 * @property int $id
 * @property int|null $contract_id
 * @property int|null $currency_id
 * @property float|null $sum
 * @property float|null $rate
 * @property string|null $desc
 * @property int $created_at
 * @property int $updated_at
 */
class Expense extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'expense';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contract_id', 'currency_id', 'created_at', 'updated_at'], 'integer'],
            [['sum', 'rate'], 'number'],
            [['created_at', 'updated_at'], 'required'],
            [['desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contract_id' => 'Контракт',
            'currency_id' => 'Валюта',
            'sum' => 'Сумма',
            'rate' => 'Курс валюты',
            'desc' => 'Описание',
            'created_at' => 'Создан',
            'updated_at' => 'Updated At',
        ];
    }
}
