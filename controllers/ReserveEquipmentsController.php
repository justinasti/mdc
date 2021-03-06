<?php

namespace app\controllers;

use Yii;
use app\models\ReserveEquipments;
use app\models\ReserveEquipmentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReserveEquipmentsController implements the CRUD actions for ReserveEquipments model.
 */
class ReserveEquipmentsController extends Controller
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
                'only' => ['index', 'create', 'view', 'update', 'delete'],
                'rules'=>[
                    [
                        'actions'=>['login'],
                        'allow' => true,
                        'roles' => ['@']
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_STUDENT]
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_MANAGER]
                    ],
                    [
                        'actions' => ['create', 'index', 'view', 'update', 'delete'],
                        'allow' => true,
                        'roles' => [\app\models\User::ROLE_ADMIN]
                    ],
                    [
                        'actions' => ['create'],
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
     * Lists all ReserveEquipments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReserveEquipmentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ReserveEquipments model.
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
     * Creates a new ReserveEquipments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new ReserveEquipments();
        $model->reservation_id = $id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['create', 'id' => $id]);
        }

        return $this->render('create', [
            'model' => $model, 'id' => $id
        ]);
    }

    /**
     * Updates an existing ReserveEquipments model.
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
     * Deletes an existing ReserveEquipments model.
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
     * Finds the ReserveEquipments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ReserveEquipments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ReserveEquipments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
