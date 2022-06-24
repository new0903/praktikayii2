<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

Class UserEditForm extends Model{
    
    public $login;
    public $password;
    public $name;
    public $email;
    public $password_confirmed;
    public $role;
    public $created_at;
    
    public function rules()
    {

        
        
        /*
        
        [['email', 'login', 'role'], 'required'],
            [['email'], 'email'],
            [['login'], 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['password'], 'string', 'min' => 10],
            [['password_confirmed'], 'compare', 'compareAttribute' => 'password']
        */
        
        
        return [
            [['login','password'],'required'],// 'string', 'max' => 128
            [['password'], 'string', 'min' => 10],
            [['password_confirmed'], 'compare', 'compareAttribute' => 'password'],
            [['password_confirmed'], 'string', 'min' => 10],
            [['login'], 'match', 'pattern' => '/^[a-z]\w*$/i'],
           // ['password','string', 'mix' => 10],
           // ['username','match','pattern' => '/^[0-9]\w*$/i'],
          //  ['password','match','pattern' => '/^[0-9]\w*$/i'],
            [['email'], 'email'],
            [['name_u','email'], 'safe'],
        ];
    }

    public function update(array $data)
    {

        $user = User::findOne($_GET['id']);

        $user->login = $data['UserEditForm']['login'];
        $user->email = $data['UserEditForm']['email'];

        if ($data['UserEditForm']['name']) {
            $user->name = $data['UserEditForm']['name'];
        } else {
            $user->name = null;
        }

        if ($data['UserEditForm']['password']) {
            $user->password = \Yii::$app->security->generatePasswordHash($data['UserEditForm']['password']);
        }

       // $user->is_active = $data['UserEditForm']['active'];
        $user->created_at = date('Y-m-d');

        return $user->save();
    }

}


?>