<?php

namespace app\models;
//use app\models\db\Users;
use yii\db\ActiveRecord;

//\yii\base\BaseObject
class User extends ActiveRecord  implements \yii\web\IdentityInterface
{
    public static function tableName(){
        return 'user';
    }
    public static function findIdentity($id)
    {
      //  $users=Users::setUsers();
        return self::findOne($id); // isset($users[$id]) ? new static($users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
       /* $users=Users::setUsers();
        foreach ($users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }*/

      //  return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
       /* $users=Users::setUsers();
        foreach ($users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
            //if ($user['username'] ===$username  0) {
                return new static($user);
            }
        }*/

        return self::findOne($username);//null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        //return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
   /* public function TestFunct(){
        return $users;
    }*/
}
