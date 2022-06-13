<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $short_name
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
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
            [['name', 'short_name'], 'string', 'max' => 255],
            [['code', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'short_name' => 'Short Name',
            'code' => 'Code',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function getCurrencies()
    {
        return ArrayHelper::map(Currency::find()->all(), 'id', 'name');
    }

    public static function getCurrencyById($id)
    {
        return Currency::find()->where(['id' => $id])->one();
    }
}
