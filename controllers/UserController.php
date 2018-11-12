<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                'only' => ['index', 'view', 'register', 'changepassword', 'reset', 'update', 'delete'],
                'rules'=>[
                    [
                        'actions'=>['login', 'register'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['changepassword'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_STUDENT]
                    ],
                    [
                        'actions' => ['changepassword'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_MANAGER]
                    ],
                    [
                        'actions' => ['index', 'changepassword', 'view', 'reset', 'update', 'delete'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_ADMIN]
                    ],
                    [
                        'actions' => ['changepassword'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_ADVISER]
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegister()
    {
        $this->layout = 'main-register';

        $model = new User();
       
        if ($model->load(Yii::$app->request->post())) {
            $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $model->authKey = 'bakakabawkanding';
            $model->save();
            if (Yii::$app->user->isGuest) {
                return $this->redirect(['/site/login']);
            } else {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }
    /**
     * Changepassword 
     */
    public function actionChangepassword(){
        $model = new \app\models\PasswordForm;
        $modeluser = User::find()->where([
            'id'=>Yii::$app->user->identity->id
        ])->one();
      
        if($model->load(Yii::$app->request->post())){
            if($model->validate()){
                try{
                    $modeluser->password = $_POST['PasswordForm']['newpass'];
                    if($modeluser->save()){
                        Yii::$app->getSession()->setFlash(
                            'success','Password changed'
                        );
                        return $this->redirect(['index']);
                    }else{
                        Yii::$app->getSession()->setFlash(
                            'error','Password not changed'
                        );
                        return $this->redirect(['index']);
                    }
                }catch(Exception $e){
                    Yii::$app->getSession()->setFlash(
                        'error',"{$e->getMessage()}"
                    );
                    return $this->render('changepass',[
                        'model'=>$model
                    ]);
                }
            }else{
                return $this->render('changepass',[
                    'model'=>$model
                ]);
            }
        }else{
            return $this->render('changepass',[
                'model'=>$model
            ]);
        }
    }

    /**
     * Reset Forgotten Password
     * 
     */
    public function actionReset($id)
    {
        $model = $this->findModel($id);
        $model->setPassword($model->username);
        $model->save();
        if(!$model->save()){;
            Yii::$app->session->setFlash('danger', 
        ' '.User::findOne($id)->name."'s account can't be reset.");
        }
        
        Yii::$app->session->setFlash('success', 
        ' '.User::findOne($id)->name."'s account has been password reset.");
        return $this->redirect('index');
    }
    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionChange($id)
    {
        $model = $this->findModel($id);
        $model->save();
        return $this->render('change-pass', [
            'model' => $model
        ]);
    }
}
