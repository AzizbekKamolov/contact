<?php

namespace app\modules\contact\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "additional_fields_values".
 *
 * @property int $id
 * @property int|null $contact_id
 * @property int|null $additional_id
 * @property string|null $value
 * @property string|null $created_at
 * @property string|null $created_by
 */
class AdditionalFieldsValue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'additional_fields_values';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id', 'additional_id', 'value'], 'required'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contact_id' => 'Название контакта',
            'additional_id' => 'Дополнительный заголовок',
            'value' => 'Ценность',
            'created_at' => 'Создано',
            'created_by' => 'Владелец',
        ];
    }

    public function getMain()
    {
        return $this->hasOne(Main::className(), ['id' => 'contact_id']);
    }
    public function getAdditionalField()
    {

        return $this->hasOne(AdditionalField::className(), ['id' => 'additional_id']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getMainById($id){
        return Main::find()->where(['id' => $id])->one()->title;
    }

}
