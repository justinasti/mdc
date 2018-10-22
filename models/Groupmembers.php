<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "groupmembers".
 *
 * @property int $id
 * @property string $userid
 * @property string $groupid
 * @property int $grouprole 0=Leader, 1=Member
 *
 * @property User $user
 * @property Groups $group
 */
class Groupmembers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'groupmembers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid', 'groupid', 'grouprole'], 'required'],
            [['userid', 'groupid', 'grouprole'], 'integer'],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
            [['groupid'], 'exist', 'skipOnError' => true, 'targetClass' => Groups::className(), 'targetAttribute' => ['groupid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userid' => 'Userid',
            'groupid' => 'Groupid',
            'grouprole' => 'Grouprole',
        ];
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
    public function getGroup()
    {
        return $this->hasOne(Groups::className(), ['id' => 'groupid']);
    }
}
