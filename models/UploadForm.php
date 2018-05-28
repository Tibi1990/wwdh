<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

use yii\imagine\Image;
use Imagine\Image\Box;

class UploadForm extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate())
        {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);

            $imagine = Image::getImagine();
            $image = $imagine->open('uploads/' . $this->imageFile);
            $image->resize(new Box(40, 40))->save('uploads/' . $this->imageFile->baseName . '-40x40' .  '.' . $this->imageFile->extension,
                ['quality' => 70]);

            unlink('uploads/' . $this->imageFile->baseName . '.'  . $this->imageFile->extension);

            return true;
        }
        else
        {
            return false;
        }
    }
}