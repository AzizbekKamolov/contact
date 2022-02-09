<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $type
 */
class Status extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
            'title' => 'Title',
            'type' => 'Type',
        ];
    }

    public static function getIdsByStatus($status)
    {
        $models = self::find()->where(['in','title',$status])->all();
        $result = ArrayHelper::map($models, 'id', 'id');
        return $result;
    }

    public static function getStatuses()
    {
        return ArrayHelper::map(Status::find()->all(), 'id', 'title');
    }

    public static function getStatusById($id)
    {
        return Status::find()->where(['id' => $id])->one();
    }

    public static function getStatusColor($id)
    {
        switch ($id) {
            case 1: return 'text-primary' ; break;
            case 2: return 'text-warning' ; break;
            case 3: return 'text-danger' ; break;
            case 4: return 'text-success' ; break;
            case 5: return 'text-info' ; break;
            case 6: return 'text-success' ; break;
        }
    }
}
