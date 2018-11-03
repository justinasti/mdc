<?php

namespace app\controllers;

use Yii;
use app\models\Reservations;
use app\models\ReservationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * EquipmentsController implements the CRUD actions for Equipments model.
 */
class RequestsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Equipments models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->identity->getRole()==200) {
            $facilityManaged = \app\models\Facilities::find()->where(['managed_by' => Yii::$app->user->identity->id])->one();
            $model = Reservations::find()->where(['facility_id' => $facilityManaged, 'confirmation_level' => 1, 'status' => 0])->all();   
            // var_dump($model);
            // die();
        }else if(Yii::$app->user->identity->getRole()==300){
            $sql = 'SELECT reservations.id as "reservation_id",reservations.occasion AS "occasion",reservations.no_of_participants AS "no_of_participants", 
                reservations.datetime_start as "datetime_start", reservations.facility_id AS "facility_id"
                FROM `reservations` INNER JOIN (groups, groupmembers,user) WHERE groupmembers.groupid = groups.id AND 
                user.id = groupmembers.userid AND reservations.userid = user.id AND reservations.status = 0 AND 
                reservations.confirmation_level = 0';
            $groupAdviser = \app\models\Groups::find()->where(['adviser_id' => Yii::$app->user->identity->id])->one();
            //  $model = Reservations::find()->joinWith(['user','groupmembers'],true, 'INNER JOIN')->onCondition(['groups.adviser_id' =>   Yii::$app->user->identity->id])
            //  ->andWhere(['groupmembers.groupid' => 'groups.id' ])->andWhere(['user.id' => 'groupmembers.userid'])->andWhere(['reservations.userid' => 'user.id'])->all();
           
            $model = Yii::$app->db->createCommand($sql)
            ->queryAll();
            //  $model = Reservations::findBySql($posts)->all();
            // print_r($model);
            // die();
        } else {
            $model = Reservations::find()->where(['status' => 0, 'confirmation_level' => 2])->all();
        }
        return $this->render('/requests/index', ['model' => $model]);
    }
    public function actionConfirm($id) {
        $model = $this->findModel($id);

        if (Yii::$app->user->identity->getRole()==100){
            $model->status = 1;
            $model->update();
        } else if (Yii::$app->user->identity->getRole()==200) {
            $model->status = 0;
            $model->confirmation_level = 2;
            $model->update();
        } else {
            $model->status = 0;
            $model->confirmation_level = 1;
            $model->update();
        }
        return $this->redirect(['requests/index', 'model' => $model]);
    }

    public function actionCancel($id) {
        $model = $this->findModel($id);
        $model->status = 2;
        $model->update();

        return $this->redirect(['view', 'id' => $id]);
    }

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

    protected function findModel($id)
    {
        if (($model = Reservations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}