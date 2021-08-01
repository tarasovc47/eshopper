<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'png,jpg,jpeg']
        ];
    }

    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file; // получаем картинку
        if ($this->validate()) // если она соответствует требованиям
        {
            $this->deleteCurrentImage($currentImage); // удаляем текущую картинку
            return $this->saveImage(); // и сохраняем новую
        }
    }

    private function getFolder()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName))) . '.' . $this->image->extension;
    }

    public function deleteCurrentImage($currentImage) // функция удаления текущей картинки
    {
        if ($this->fileExists($currentImage))  // если файл существует
        {
            unlink($this->getFolder() . $currentImage); // удаляем картинку
        }
    }
    public function fileExists($currentImage)
    {
        if (!empty($currentImage) && $currentImage != null) // если "картинка" не пуста И "картинка" не равна NULL
        {
            return file_exists($this->getFolder() . $currentImage); // возвращаем "картинка существует"
        }
    }

    public function saveImage()
    {
        $filename = $this->generateFilename(); // получаем сгенерированное имя файла
        $this->image->saveAs($this->getFolder() . $filename); // сохраняем файл
        return $filename; // возвращаем имя сохранённого файла
    }
}