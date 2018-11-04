<?php

namespace app\controllers;

use Yii;
use app\models\Reservations;
use app\models\ReservationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ReserveEquipments;
use app\models\User;
use yii\db\Query;

/**
 * ReservationsController implements the CRUD actions for Reservations model.
 */
class ReservationsController extends Controller
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
     * Lists all Reservations models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Reservations::find()->orderBy(['status' => SORT_DESC])->all();

        return $this->render('index', ['model' => $model]);
    }

    /**
     * Displays a single Reservations model.
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
     * Creates a new Reservations model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reservations();

        $model->userid = Yii::$app->user->identity->id;
        if (Yii::$app->user->identity->getRole()==100) {
            $model->status = 0;
            $model->confirmation_level = 1;
        } else if(Yii::$app->user->identity->getRole()==200){
            $model->status = 0;
            $model->confirmation_level = 2;
        }else{
            $model->confirmation_level = 1;
            $model->status = 0;
        }

        $reserveEquipments = new ReserveEquipments();

        if ($model->load(Yii::$app->request->post())) {
            if(!Reservations::findOne(['datetime_start' => $model->datetime_start, 'facility_id' => $model->facility_id])){
                $model->save();
                return $this->redirect(['/reserve-equipments/create', 'model' => $reserveEquipments, 'id' => $model->id]);
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionConfirm($id) {
        $model = $this->findModel($id);

        if (Yii::$app->user->identity->getRole()==100){
            $model->status = 1;
            $model->update();
        }else if (Yii::$app->user->identity->getRole()==200) {
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

    public function actionMyReservations() {
        $model = Reservations::find()->where(['userid' => Yii::$app->user->identity->id])->orderBy(['status' => SORT_DESC])->all();

        return $this->render('my-reservations', ['model' => $model]);
    }

    /**
     * Updates an existing Reservations model.
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
     * Deletes an existing Reservations model.
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
     * Finds the Reservations model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Reservations the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reservations::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // public function actionCalendar()
    // {
    //     $eventsQry = Reservations::find()->all();
    //     $events = [];

    //     $i = 0;
    //     foreach ($eventsQry as $item) {
    //         $event = new \yii2fullcalendar\models\Event();
    //         $event->id = $item->id;
    //         $event->title = $item->occasion;
    //         $event->start = $item->datetime_start;
    //         $i++;
    //         array_push($events, $event);
    //     }
    //     return $this->render('calendar', ['events' => $events]);
    // }

    // public function actionRequests() 
    // {
        

    //     // print_r(Yii::$app->user->identity->role);
    //     //     die();

    //     if (Yii::$app->user->identity->getRole()==200) {
    //         $facilityManaged = \app\models\Facilities::find()->where(['managed_by' => Yii::$app->user->identity->id])->one();
    //          $model = Reservations::find()->where(['facility_id' =>  $facilityManaged->id])->andWhere(['confirmation_level' => 0])->andWhere(['status' => 0])->all();

        
    //     }else if(Yii::$app->user->identity->getRole()==300){
    //         $sql = 'SELECT reservations.id as "reservation_id",reservations.occasion AS "occasion",reservations.no_of_participants AS "no_of_participants", 
    //         reservations.datetime_start as "datetime_start", reservations.facility_id AS "facility_id"
    //         FROM `reservations` INNER JOIN (groups, groupmembers,user) ON groups.id = 3 
    //         WHERE groupmembers.groupid = groups.id AND user.id = groupmembers.userid AND reservations.userid = user.id';
    //         $groupAdviser = \app\models\Groups::find()->where(['adviser_id' => Yii::$app->user->identity->id])->one();
    //         //  $model = Reservations::find()->joinWith(['user','groupmembers'],true, 'INNER JOIN')->onCondition(['groups.adviser_id' =>   Yii::$app->user->identity->id])
    //         //  ->andWhere(['groupmembers.groupid' => 'groups.id' ])->andWhere(['user.id' => 'groupmembers.userid'])->andWhere(['reservations.userid' => 'user.id'])->all();
           
    //         $model = Yii::$app->db->createCommand($sql)
    //         ->queryAll();
    //         //  $model = Reservations::findBySql($posts)->all();
    //         // print_r($model);
    //         // die();
    //     } else {
    //         return $this->render('requests', ['model' => $model]);
    //     }
    //     return $this->render('requests', ['model' => $model]);
    // }
}
//SELECT groups.name AS "Group Name", groupmembers.userid AS "Group Members", reservations.occasion AS "Occasion" FROM `reservations` 
//INNER JOIN (groups, groupmembers) ON groups.id = 3 WHERE groupmembers.groupid = groups.id AND reservations.userid = groupmembers.userid