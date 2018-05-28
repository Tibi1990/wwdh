<?php 

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\UploadedFile;

use app\models\UploadForm;
use app\models\Tweet;
use app\models\Registration;

use yii\data\Pagination;

class ProfileController extends Controller
{
	public function actionIndex()
	{
		$loggedUserId = Yii::$app->user->id;
		$loggedUserTweets = Registration::findOne($loggedUserId);

		$query = $loggedUserTweets->getTweets()->orderBy(['created' => SORT_DESC]);
		$count = $query->count();
		$pagination = new Pagination(['totalCount' => $count]);

		$tweets = $query->offset($pagination->offset)->limit($pagination->limit)->all();

		return $this->render('index', ['tweets' => $tweets, 'pagination' => $pagination]);	
	}

	public function actionView($id = null)
	{
		if (!isset($id))
        {
			$id = Yii::$app->user->id;
		}

        if(!Yii::$app->user->isGuest)
        {
            $openTweetCount = Tweet::find()->where(['registration_id' => $id])->one(); 
            $openTweetCount->hits += 1;
            $openTweetCount->save();
        
    		$registredUser = Registration::find()->where(['id' => $id])->one();

    		return $this->render('view', ['registredUser' => $registredUser]);
        }
        else
        {
            Yii::$app->session->setFlash('error', "Please log in, if you want to see a tweet details.");
            return $this->redirect(['site/login']);
        }
	}

	public function actionUpload()
    {
        $model = new UploadForm();
        $registration = new Registration();

        if (Yii::$app->request->isPost)
        {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload()) {
            	$userPicture = Registration::findOne(Yii::$app->user->id);
            	$userPicture->picture_name = $model->imageFile->baseName . '-40x40' . '.' . $model->imageFile->extension;
            	$userPicture->save();

                return $this->redirect(['profile/view']);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionPicture()
    {
    	$userPicture = Registration::findOne(Yii::$app->user->id);

        unlink(Yii::getAlias('@webroot') . "/" . "uploads" . "/" . $userPicture->picture_name);

        $userPicture->picture_name = null;
        $userPicture->save();
        
    	return $this->redirect(['profile/view']);
    }

    public function actionDelete($id = null)
    {
        if (isset($id))
        {
            $tweet = Tweet::findOne($id);
            $tweet->delete();

            Yii::$app->getSession()->setFlash('success', 'Successfully deleted.');

            return $this->redirect(['profile/index', 'username' => 'tibor']);
        }
        else
        {
            $registrationId = Yii::$app->user->id; 

        	$userProfile = Registration::findOne($registrationId);
        	$userProfile->delete();

            Tweet::deleteAll(['registration_id' => $registrationId]);
            
            Yii::$app->getSession()->setFlash('success', 'Successfully deleted.');
        	return $this->redirect(['site/index']);
        }
    }
}



















