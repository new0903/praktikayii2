<?php

namespace app\models;
use Yii;
use yii\base\Model;

class UserCreateForm extends Model
{

    public $login;
    public $email;
    public $password;
    public $created_at;
    public $name;
    public $role;

    public function rules()
    {
        return [
            [['password', 'email', 'login', 'role'], 'required'],
            [['email'], 'email'],
            [['login'], 'unique', 'targetClass' => 'User', 'targetAttribute' => ['login']],
            [['login'], 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['password'], 'string', 'min' => 10],
        ];
    }


    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'name' => 'ФИО',
            'role' => 'Роль',
        ];
    }


    public function store(array $data)
    {
        //$tr = Yii::$app->db->beginTransaction();
        try {
            $user = new User();
            $user->login = $data['UserCreateForm']['login'];
            $user->password = Yii::$app->security->generatePasswordHash($data['UserCreateForm']['password']);

            if(!empty($data['UserCreateForm']['name'])) {
                $user->name = $data['UserCreateForm']['name'];
            }
            $user->email = $data['UserCreateForm']['email'];
            $user->created_at = date('Y-m-d');
            $user->save();

            if (Yii::$app->user->can('roleUser')) {
                $role = new Role();
                $role->assignRole($data['UserCreateForm']['role'], $user['id']);
            }

            //$tr->commit();
            return true;
        } catch (\Exception $e) {
            //$tr->rollBack();
            return false;
        }



    }



}