<?php

namespace app\models;
use Yii;


class Tweet extends \yii\db\ActiveRecord
{
    public function getRegistration()
    {
    	return $this->hasOne(Registration::className(), ['id' => 'registration_id']);
    }
}