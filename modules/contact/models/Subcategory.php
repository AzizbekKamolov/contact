<?php

namespace app\modules\contact\models;

use Yii;

/**
 * This is the model class for table "subcategory".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $category_id
 * @property string|null $info
 *
 * @property Category $category
 */
class Subcategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subcategory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['info'], 'string'],
            [['title'], 'string', 'max' => 500],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Название категории',
            'info' => 'Информация',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    public function getMain()
    {
        return $this->hasMany(Main::className(), ['subcategory' => 'id']);
    }
}
