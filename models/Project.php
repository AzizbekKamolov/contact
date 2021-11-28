<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property float|null $budget_sum
 * @property string|null $project_year
 * @property int|null $user_id
 * @property int|null $status_id
 * @property string|null $deadline
 * @property int $created_at
 * @property int $updated_at
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['budget_sum'], 'number'],
            [['project_year', 'deadline'], 'safe'],
            [['user_id', 'status_id', 'created_at', 'updated_at'], 'integer'],
            [['created_at', 'updated_at'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'budget_sum' => 'Budget Sum',
            'project_year' => 'Project Year',
            'user_id' => 'User ID',
            'status_id' => 'Status ID',
            'deadline' => 'Deadline',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
