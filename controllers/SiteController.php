<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\Pagination;

use app\models\Registration;
use app\models\RegistrationForm;
use app\models\LoginForm;
use app\models\Tweet;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Tweet::find()->with('registration')->orderBy(['created' => SORT_DESC]);
        
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);
        $tweets = $query->offset($pagination->offset)->limit($pagination->limit)->all();

        return $this->render('index', ['tweets' => $tweets, 'pagination' => $pagination]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
      
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegistration()
    {
        $model = new RegistrationForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            $registration = new Registration();

            $registration->username = $model->username;
            $registration->password = $model->password;
            $registration->email = $model->email;

            $registration->save();

            Yii::$app->getSession()->setFlash('success', 'Registration has been successfully, please log in.');

            return $this->redirect(['site/login']);
        }

        return $this->render('registration', ['model' => $model]);
    }
}
