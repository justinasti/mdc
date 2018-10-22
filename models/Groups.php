<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groups".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $adviser_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Groupmembers[] $groupmembers
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'adviser_id'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'description', 'adviser_id'], 'string', 'max' => 191],
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
            'adviser_id' => 'Adviser ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupmembers()
    {
        return $this->hasMany(Groupmembers::className(), ['groupid' => 'id']);
    }
}
