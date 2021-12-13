<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "task_exchange".
 *
 * @property int $id
 * @property int|null $task_exe_id
 * @property int|null $exe_user_id
 * @property int|null $rec_user_id
 * @property int|null $status_id
 * @property string|null $info_executor
 * @property string|null $info_receiver
 * @property int $created_at
 * @property int $updated_at
 */
class TaskExchange extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task_exchange';
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
            [['task_exe_id', 'exe_user_id', 'rec_user_id', 'created_at', 'updated_at'], 'integer'],
            [['info'], 'string'],
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
            'task_exe_id' => 'Task Exe ID',
            'exe_user_id' => 'Exe User ID',
            'rec_user_id' => 'Rec User ID',
            'info' => 'Info',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
