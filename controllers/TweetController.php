<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;

use app\models\Tweet;
use app\models\TweetForm;

class TweetController extends Controller
{
	public function actionCreate()
    {
        $model = new TweetForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $tweet = new Tweet();

            $tweet->tweet = $model->tweet;
            $tweet->registration_id = Yii::$app->user->id; 
            $tweet->created = date('Y-m-d H:i:s');
           
            $tweet->save();

            Yii::$app->getSession()->setFlash('success', 'Tweet ha successfully created.');
        }

        return $this->render('create', ['model' => $model]);
    }
}