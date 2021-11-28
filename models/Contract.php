<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contract".
 *
 * @property int $id
 * @property int|null $project_id
 * @property string|null $title
 * @property string|null $description
 * @property float|null $price
 * @property int|null $user_id
 * @property string|null $file_url
 * @property int|null $status_id
 * @property string|null $deadline
 * @property int $created_at
 * @property int $updated_at
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contract';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'user_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['deadline'], 'safe'],
            [['created_at', 'updated_at'], 'required'],
            [['title', 'file_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_id' => 'Project ID',
            'title' => 'Title',
            'description' => 'Description',
            'price' => 'Price',
            'user_id' => 'User ID',
            'file_url' => 'File Url',
            'status_id' => 'Status ID',
            'deadline' => 'Deadline',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
