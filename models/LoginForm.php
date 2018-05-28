<?php

namespace app\models;

use Yii;
use yii\base\Model;

class LoginForm extends Model
{
    //public $username;
    public $email;
    public $password;
    public $rememberMe = true;

    //private $_user = false;
    private $_email = false;

    public function rules()
    {
        return [
            // username and password are both required
            [['password', 'email'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            // The format is correct email format.
            ['email', 'email']
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getEmail();

            if (!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    public function login()
    {
        if ($this->validate())
        {
            return Yii::$app->user->login($this->getEmail(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    public function getEmail()
    {
        if ($this->_email === false) {
            $this->_email = Registration::findUserByEmail($this->email);
        }

        return $this->_email;
    }
}
