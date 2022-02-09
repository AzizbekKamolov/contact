<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

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
            [['user_id', 'status_id', 'created_at', 'updated_at', 'currency_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['title', 'description'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'budget_sum' => 'Бюджет',
            'currency_id' => 'Тип валюты',
            'project_year' => 'Год проекта',
            'user_id' => 'Ответственный',
            'status_id' => 'Статус',
            'deadline' => 'Срок',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getContracts()
    {
        return $this->hasMany(Contract::className(), ['project_id' => 'id']);
    }

    public static function getProjects()
    {
        return ArrayHelper::map(Project::find()->all(), 'id', 'title');
    }

    public static function getProjectById($id)
    {
        return Project::find()->where(['id' => $id])->one();
    }

}
