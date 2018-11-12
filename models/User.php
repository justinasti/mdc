<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $mobile_number
 * @property int $role
 * @property string $authKey
 *
 * @property Facilities[] $facilities
 * @property Groupmembers[] $groupmembers
 * @property Reservations[] $reservations
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    const STATUS_ACTIVE = 10;
    const STATUS_INACTIVE = 0;
    const ROLE_ADMIN = 100;
    const ROLE_MANAGER = 200;
    const ROLE_ADVISER = 300;
    const ROLE_STUDENT = 400;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'username', 'email', 'password', 'mobile_number', 'authKey'], 'required'],
            [['role'], 'integer'],
            [['name', 'email', 'password', 'mobile_number'], 'string', 'max' => 191],
            [['username'], 'string', 'max' => 225],
            [['authKey'], 'string', 'max' => 250],
            [['email', 'username'], 'unique'],
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
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'mobile_number' => 'Mobile Number',
            'role' => 'Role',
            'authKey' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFacilities()
    {
        return $this->hasMany(Facilities::className(), ['managed_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupmembers()
    {
        return $this->hasMany(Groupmembers::className(), ['userid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReservations()
    {
        return $this->hasMany(Reservations::className(), ['userid' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public static function getRoles() {
        return $roles = [
            100 => 'System Administrator',
            200 => 'Manager',
            300 => 'Teacher/Adviser',
            400 => 'Student'
        ];
    }
    public function getRoleName() {
        return static::getRoles()[$this->role];
    }

     public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getRole() {
        return $this->role;
    }

    public static function findIdentity($id) {
        return static::findOne(['id'=>$id]);
    }

    public static function findRole($role) {
        return static::findOne(['role'=>$role]);
    }

    public function validatePassword($password) {
        if(is_null($this->password)) 
            return false;
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function validateUsername($username) {
        return Yii::$app->security->validateUsername($username, $this->username);
    }
    
    public function setPassword($password) {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    } 

    public static function findByUsername($username) {
        return static::findOne(['username' => $username]);
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)  {
        return $this->getAuthKey() === $authKey;
    }

    public function generateAuthKey() {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

}
