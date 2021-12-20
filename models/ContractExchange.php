<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contract_exchange".
 *
 * @property int $id
 * @property int|null $con_exe_id
 * @property int|null $exe_user_id
 * @property int|null $rec_user_id
 * @property string|null $info
 * @property string|null $file_url
 * @property int $created_at
 * @property int $updated_at
 */
class ContractExchange extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contract_exchange';
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
            [['con_exe_id', 'exe_user_id', 'rec_user_id', 'created_at', 'updated_at'], 'integer'],
            [['info'], 'string'],
//            [['created_at', 'updated_at'], 'required'],
            [['file'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'con_exe_id' => 'Con Exe ID',
            'exe_user_id' => 'Exe User ID',
            'rec_user_id' => 'Rec User ID',
            'info' => 'Info',
            'file' => 'File Url',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function saveFile($filename)
    {
        $this->file = $filename;
        return $this->save(false);
    }

    public function deleteFile()
    {
        $fileUploadModel = new FileUpload();
        $fileUploadModel->deleteCurrentFile($this->file);
    }

    public function beforeDelete()
    {
        $this->deleteFile();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub
    }
}
