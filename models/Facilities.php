<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facilities".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property int $capacity
 * @property string $managed_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $managedBy
 * @property Reservations[] $reservations
 */
class Facilities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facilities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'capacity', 'managed_by'], 'required'],
            [['capacity', 'managed_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 191],
            [['managed_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['managed_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'capacity' => 'Capacity',
            'managed_by' => 'Managed By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManagedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'managed_by']);
    }

    public function getManagedByName() {
        return $this->managedBy->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservations::className(), ['facility_id' => 'id']);
    }

}
