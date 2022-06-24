<?php

namespace app\controllers;

//use app\commands\RbacController;
use app\models\SearchForm;
use app\models\AboutsForm;
use app\models\User;
use Yii;
use yii\web\Controller;
use app\models\Role;
use app\models\UserCreateForm;
use app\models\UserEditForm;

class UserController extends Controller{

    public function actionListusers($page=null,$limit=null){
        $model=new AboutsForm();
        $search=new SearchForm();
        $poisk='';
        if ($search->load(Yii::$app->request->get())) {
            if ($search->validate()) {
                $poisk=$search->search;
                
            }
        }
        $posts=User::find()->where(['like','name',$poisk])->orWhere(['like','login',$poisk])->asArray()->all();//->with('user')
        if ($limit===null) {
            $limit=6;
        }   
        if ($page===null) {
            $page=1;
        }
        
        $pages=0;
        $offset=0;
        if ($model->load(Yii::$app->request->get())) {
            if ($model->validate()) {
                $limit=$model->numrow;
                
            }
        }
        if ($limit=='all') {
            $limit=count($posts);
            $result=$posts;
        }else{
            $offset = ($page-1) * $limit;
            $result = array_slice($posts, $offset, $limit, true);
            $pages=count($posts);
            $pages = $pages / $limit;
            $pages = ceil($pages);
        }
        return $this->render('listusers',compact('limit','result','pages','model','search'));
    }
    public function actionEdit($id=null)
    {
        //$user=Yii::$app->user->getId();
        $model=new UserEditForm();//::findOne(['id'=>$user]);
        
       // $test=new RbacController();
      //  $test->actionInit();
        $user=User::findOne($id);
        $model->login=$user->login;
       // $model->password=$user->password;
        $model->name=$user->name;
        $model->email=$user->email;
       // $roles = Role::getRole();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->update(Yii::$app->request->post());
               // $model;
               //$model->update(Yii::$app->request->post());
             //  $model->save();
            }
        }
        return $this->render('edit',compact('model','user'));
    }

    public function actionCreate(){
        $model=new UserCreateForm();
       // $roles = Role::getRole();
        $model->login='';
        $model->password='';
        if(Yii::$app->request->post()) {
            $success = $model->store(Yii::$app->request->post());

            if($success) {
                Yii::$app->session->setFlash('success', "Вы успешно добавили пользователя!");
            } else {
                Yii::$app->session->setFlash('error', "Произошла ошибка при добавление!");
            }
        }
        //$success = $model->store(Yii::$app->request->post());
        return $this->render('create',compact('model'));//,'roles'
    }
}
?>