<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property int|null $project_id
 * @property string|null $title
 * @property float|null $price
 * @property string|null $deadline
 * @property int|null $user_id
 * @property int|null $status_id
 * @property int $created_at
 * @property int $updated_at
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
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
            [['project_id', 'user_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string'],
            [['price'], 'number'],
            [['deadline'], 'safe'],
//            [['created_at', 'updated_at'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Проект',
            'title' => 'Название',
            'price' => 'Price',
            'deadline' => 'Срок',
            'user_id' => 'Создатель',
            'status_id' => 'Статус',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
