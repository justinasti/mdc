<?php

namespace app\controllers;

use Yii;
use app\models\Reservations;
use app\models\ReservationsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EquipmentsController implements the CRUD actions for Equipments model.
 */
class CalendarController extends Controller
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
        $eventsQry = Reservations::find()->all();
        $events = [];

        $i = 0;
        foreach ($eventsQry as $item) {
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $item->id;
            $event->title = $item->occasion;
            $event->start = $item->datetime_start;
            $event->end = $item->datetime_end;
            $i++;
            if (!Reservations::findOne(['status' => 2])) {
                array_push($events, $event);
            }
        }
        return $this->render('index', ['events' => $events]);
    }

    /**
     * Displays a single Equipments model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
//     public function actionView($id)
//     {
//         return $this->render('view', [
//             'model' => $this->findModel($id),
//         ]);
//     }

//     /**
//      * Creates a new Equipments model.
//      * If creation is successful, the browser will be redirected to the 'view' page.
//      * @return mixed
//      */
//     public function actionCreate()
//     {
//         $model = new Equipments();

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->id]);
//         }

//         return $this->render('create', [
//             'model' => $model,
//         ]);
//     }

//     /**
//      * Updates an existing Equipments model.
//      * If update is successful, the browser will be redirected to the 'view' page.
//      * @param string $id
//      * @return mixed
//      * @throws NotFoundHttpException if the model cannot be found
//      */
//     public function actionUpdate($id)
//     {
//         $model = $this->findModel($id);

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->id]);
//         }

//         return $this->render('update', [
//             'model' => $model,
//         ]);
//     }

//     /**
//      * Deletes an existing Equipments model.
//      * If deletion is successful, the browser will be redirected to the 'index' page.
//      * @param string $id
//      * @return mixed
//      * @throws NotFoundHttpException if the model cannot be found
//      */
//     public function actionDelete($id)
//     {
//         $this->findModel($id)->delete();

//         return $this->redirect(['index']);
//     }

//     /**
//      * Finds the Equipments model based on its primary key value.
//      * If the model is not found, a 404 HTTP exception will be thrown.
//      * @param string $id
//      * @return Equipments the loaded model
//      * @throws NotFoundHttpException if the model cannot be found
//      */
//     protected function findModel($id)
//     {
//         if (($model = Equipments::findOne($id)) !== null) {
//             return $model;
//         }

//         throw new NotFoundHttpException('The requested page does not exist.');
//     }
}
