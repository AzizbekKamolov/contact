<?php

namespace app\models;

use phpDocumentor\Reflection\Types\Null_;
use yii\base\Model;
use yii\web\UploadedFile;

class FileUpload extends Model {
    public $file;

    public function rules()
    {
        return [
//          [['file'], 'required'],
          [['file'], 'file', 'maxSize' => 1024 * 1024 * 3]
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Файл'
        ];
    }

    public function uploadFile($file, $currentFile)
    {
        if (!empty($file)) {
            $this->file = $file;

            if ($this->validate())
            {
                $this->deleteCurrentFile($currentFile);

                return $this->saveFile();
            }
        }
        return null;
    }

    public function getFolder()
    {
        return \Yii::getAlias('@web') . 'uploads/';
    }

    public function generateFilename()
    {
        return strtolower(md5(uniqid($this->file->baseName))) . '.' . $this->file->extension;
    }

    public function deleteCurrentFile($currentFile)
    {
        if ($this->fileExists($currentFile))
        {
            unlink($this->getFolder() . $currentFile);
        }
    }

    public function fileExists($currentFile)
    {
        if (!empty($currentFile) && $currentFile != null)
        {
            return file_exists($this->getFolder() . $currentFile);
        }
    }

    public function saveFile()
    {
        $filename = $this->generateFilename();

        $this->file->saveAs($this->getFolder() . $filename);

        return $filename;
    }
}