<?php

namespace app\modules\contact\models;

use Yii;

/**
 * This is the model class for table "additional_fields".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $type
 * @property int|null $multiple
 */
class AdditionalField extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'additional_fields';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['multiple', 'title', 'type'], 'required'],
            [['multiple'], 'integer'],
            [['title', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'type' => 'Тип',
            'multiple' => 'Несколько',
        ];
    }
    public function getAdditionalFieldsVal()
    {
        return $this->hasMany(AdditionalField::className(), ['additional_id' => 'id']);
    }


}
