<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                    'class' => \app\components\AccessRule::className(),
                ],
                'only' => ['index', 'login', 'logout'],
                'rules'=>[
                    [
                        'actions'=>['login'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['index', 'login', 'logout'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_STUDENT]
                    ],
                    [
                        'actions' => ['index', 'login', 'logout'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_MANAGER]
                    ],
                    [
                        'actions' => ['index', 'login', 'logout'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_ADMIN]
                    ],
                    [
                        'actions' => ['index', 'login', 'logout'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_ADVISER]
                    ]
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

    /**
     * {@inheritdoc}
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {     
        if (Yii::$app->user->isGuest) {
            $model = new LoginForm();
            $model->password = '';
            return $this->redirect(['login',
                'model' => $model,
            ]); 
        } else if(User::findIdentity(Yii::$app->user->identity->id)->getRole()===400){
            return $this->redirect('/calendar/index');
        } else if(User::findIdentity(Yii::$app->user->identity->id)->getRole()===300){
            return $this->render('/site/adviser');
        } else if(User::findIdentity(Yii::$app->user->identity->id)->getRole()===200){
            return $this->render('/site/manager');   
        } else {
            return $this->render('/site/index');
        }
            
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'main-login';
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

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    // public function actionContact()
    // {
    //     $model = new ContactForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
    //         Yii::$app->session->setFlash('contactFormSubmitted');

    //         return $this->refresh();
    //     }
    //     return $this->render('contact', [
    //         'model' => $model,
    //     ]);
    // }

    // /**
    //  * Displays about page.
    //  *
    //  * @return string
    //  */
    // public function actionAbout()
    // {
    //     return $this->render('about');
    // }

    // public function actionRegister()
    // {
    //     $this->layout = 'main-register';
    //     return $this->render('../users/register', [
    //         'model' => $model,
    //     ]);
    // }
}
