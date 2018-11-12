<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reserve_equipments".
 *
 * @property string $id
 * @property string $reservation_id
 * @property string $equipment_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Equipments $equipment
 * @property Reservations $reservation
 */
class ReserveEquipments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reserve_equipments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reservation_id', 'equipment_id'], 'required'],
            [['reservation_id', 'equipment_id','quantity'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['equipment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipments::className(), 'targetAttribute' => ['equipment_id' => 'id']],
            [['reservation_id'], 'exist', 'skipOnError' => true, 'targetClass' => Reservations::className(), 'targetAttribute' => ['reservation_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reservation_id' => 'Reservation ID',
            'equipment_id' => 'Equipment ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'quantity' => 'Equipment Quantity',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipment()
    {
        return $this->hasOne(Equipments::className(), ['id' => 'equipment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservation()
    {
        return $this->hasOne(Reservations::className(), ['id' => 'reservation_id']);
    }
}
