<?php

namespace app\modules\contact\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $info
 *
 * @property Subcategory[] $subcategories
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['info', 'title'], 'required'],
            [['info'], 'string'],
            [['title'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Создать категорию',
            'info' => 'Информация',
        ];
    }

    /**
     * Gets query for [[Subcategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategories()
    {
        return $this->hasMany(Subcategory::className(), ['category_id' => 'id']);
    }


    public function getMain()
    {
        return $this->hasMany(Main::className(), ['category' => 'id']);
    }
}
