<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reservations".
 *
 * @property string $id
 * @property string $occasion
 * @property int $no_of_participants
 * @property string $datetime_start
 * @property string $datetime_end
 * @property string $facility_id
 * @property string $userid
 * @property int $status 0=Pending, 1=Confirmed, 2=Cancelled
 *
 * @property Facilities $facility
 * @property User $user
 * @property ReserveEquipments[] $reserveEquipments
 */
class Reservations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reservations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['occasion', 'no_of_participants', 'datetime_start', 'datetime_end', 'facility_id', 'userid', 'status'], 'required'],
            [['no_of_participants', 'facility_id', 'userid', 'status'], 'integer'],
            [['datetime_start', 'datetime_end'], 'safe'],
            [['occasion'], 'string', 'max' => 191],
            [['facility_id'], 'exist', 'skipOnError' => true, 'targetClass' => Facilities::className(), 'targetAttribute' => ['facility_id' => 'id']],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'occasion' => 'Occasion',
            'no_of_participants' => 'No Of Participants',
            'datetime_start' => 'Datetime Start',
            'datetime_end' => 'Datetime End',
            'facility_id' => 'Facility ID',
            'userid' => 'Userid',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacility()
    {
        return $this->hasOne(Facilities::className(), ['id' => 'facility_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReserveEquipments()
    {
        return $this->hasMany(ReserveEquipments::className(), ['reservation_id' => 'id']);
    }
}
