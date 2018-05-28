<?php

namespace app\models;

use Yii;
use yii\base\Model;

class TweetForm extends Model
{
    public $tweet;
    public $created;
    
    public function rules()
    {
        return [
            ['tweet', 'string' ,'length' => [10, 160]],
            ['tweet', 'required']
        ];
    }   
}
