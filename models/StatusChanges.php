<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "status_changes".
 *
 * @property int $id
 * @property string|null $object_type
 * @property int|null $object_id
 * @property int|null $status_id
 * @property string|null $comment
 * @property int|null $user_id
 * @property int $created_at
 * @property int $updated_at
 */
class StatusChanges extends \yii\db\ActiveRecord
{
    const PROJECT_TYPE = 'project';
    const CONTRACT_TYPE = 'contract';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_changes';
    }

    /**
     * @return array
     */
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
            [['object_id', 'status_id', 'user_id', 'created_at', 'updated_at'], 'integer'],
            [['comment'], 'string'],
//            [['created_at', 'updated_at'], 'required'],
            [['object_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'object_type' => 'Object Type',
            'object_id' => 'Object ID',
            'status_id' => 'Status ID',
            'comment' => 'Комментарий',
            'user_id' => 'User ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
