<?php

namespace app\models;


use Yii;
use yii\base\Model;

class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $email;

    public function rules()
    {
        return [
            [['username', 'password', 'email'], 'required'],
            ['email', 'email'],
            ['email', 'validateEmail'],
            ['username', 'validateUsername'],
            ['password', 'string' ,'length' => [6]]
        ];
    }

    public function validateEmail($attribute, $params, $validator)
    {     
        $requestData = \Yii::$app->request->post('RegistrationForm');     

        $registrationEmail = Registration::findOne(['email' => $requestData['email']]);

        if(isset($registrationEmail->email))
        {
            $this->addError($attribute, 'The email exists in database');
        } 
    }

    public function validateUsername($attribute, $params, $validator)
    {     
        $requestData = \Yii::$app->request->post('RegistrationForm');     

        $registrationUsername = Registration::findOne(['username' => $requestData['username']]);

        if(isset($registrationUsername->username))
        {
            $this->addError($attribute, 'The username exists in database');
        } 
    }
}
