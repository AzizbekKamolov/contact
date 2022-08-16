<?php

namespace app\modules\contact\models;

use Yii;

/**
 * This is the model class for table "view_to_permission".
 *
 * @property int $id
 * @property string $main_name
 * @property string $role_name
 * @property int $main_id
 */
class ViewToPermission extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_to_permission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['main_name', 'role_name', 'main_id'], 'required'],
            [['main_id'], 'integer'],
            [['main_name', 'role_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main_name' => 'Main Name',
            'role_name' => 'Role Name',
            'main_id' => 'Main ID',
        ];
    }
}
