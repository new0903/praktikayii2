<?php

namespace app\commands;

use Yii;

use yii\filters\AccessControl;

//use yii\web\Controller;
use yii\console\Controller;


class RbacController  extends Controller{
//     public function behaviors()//: array
//     {
//         return [
//             'access' => [
//                 'class' => AccessControl::class,
//                 'rules' => [
//                     [
//                         'allow' => true,
//                         'actions' => ['init'],
//                         'roles' => ['superAdmin'],
//                     ],
//                     [
//                         'allow' => true,
//                         'actions' => ['init'],
//                         'roles' => ['admin'],
//                     ],
//                     [
//                         'allow' => true,
//                         'actions' => ['init'],
//                         'roles' => ['moder'],
//                     ],
//                     [
//                         'allow' => true,
//                         'actions' => ['init'],
//                         'roles' => ['contentManager'],
//                     ],
//                 ],
//             ],
//         ];
//     }

public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['init'],
                    'allow' => true,
                    'roles' => ['admin'],
                ],
            ],
        ]
    ];
}
    public function actionInit()
    {
       // $auth = Yii::$app->authManager;
        $role = Yii::$app->authManager->createRole('admin');
        $role->description = 'Администратор';
        Yii::$app->authManager->add($role);
         
        $role = Yii::$app->authManager->createRole('author');
        $role->description = 'Автор';
        Yii::$app->authManager->add($role);
        $permit = Yii::$app->authManager->createPermission('createAppeal');
        $permit->description = 'Право на создании обращения';
        Yii::$app->authManager->add($permit);

        
        /*# role */

    //    $admin = $auth->createRole('superAdmin');
    //    $admin->description = 'Главный администратор';
    //    Yii::$app->authManager->add($admin);

    //    $admin = $auth->createRole('quest');
    //    $admin->description = 'Пользователь';
    //    Yii::$app->authManager->add($admin);

    //    $contentManager = $auth->createRole('contentManager');
    //    $contentManager->description = 'Контент-менеджер';
    //    Yii::$app->authManager->add($contentManager);

    //    $moder = $auth->createRole('moder');
    //    $moder->description = 'Модератор';
    //    Yii::$app->authManager->add($moder);



    //     /*# permission */


    //    $active = $auth->createPermission('activeUser');
    //    $active->description = 'Активировать и деактивировать пользователей';
    //    $auth->add($active);


    //    $storeUser = $auth->createPermission('storeUser');
    //    $storeUser->description = 'Добавление пользователей';
    //    $auth->add($storeUser);

    //    $editUser = $auth->createPermission('editUser');
    //    $editUser->description = 'Изменение пользователей';
    //    $auth->add($editUser);

    //    $deleteUser = $auth->createPermission('deleteUser');
    //    $deleteUser->description = 'Удаление пользователей';
    //    $auth->add($deleteUser);


    //    $roleUser = $auth->createPermission('roleUser');
    //    $roleUser->description = 'Роли пользователей';
    //    $auth->add($roleUser);

    //    $viewFeedback = $auth->createPermission('viewFeedback');
    //    $viewFeedback->description = 'Просмотр обращений';
    //    $auth->add($viewFeedback);

    //    $viewActive = $auth->createPermission('viewActive');
    //    $viewActive->description = 'Включать и выключать активность обращений';
    //    $auth->add($viewActive);

    //    $viewEdit = $auth->createPermission('viewEdit');
    //    $viewEdit->description = 'Редактировать обращения';
    //    $auth->add($viewEdit);

    //    $viewDelete = $auth->createPermission('viewDelete');
    //    $viewDelete->description = 'Удаление обращений';
    //    $auth->add($viewDelete);


    //     /*# access role */


    //    $moder = $auth->getRole('moder');
    //    $auth->addChild($moder, $auth->getPermission('activeUser'));
    //    $auth->addChild($moder, $auth->getPermission('viewFeedback'));
    //    $auth->addChild($moder, $auth->getPermission('viewActive'));

    //    $contentManager = $auth->getRole('contentManager');
    //    $auth->addChild($contentManager, $moder);
    //    $auth->addChild($contentManager, $auth->getPermission('viewEdit'));


    //    $admin = $auth->getRole('admin');
    //    $auth->addChild($admin, $contentManager);
    //    $auth->addChild($admin, $auth->getPermission('createUser'));
    //    $auth->addChild($admin, $auth->getPermission('editUser'));
    //    $auth->addChild($admin, $auth->getPermission('deleteUser'));
    //    $auth->addChild($admin, $auth->getPermission('viewEdit'));
    //    $auth->addChild($admin, $auth->getPermission('viewDelete'));


    //    $superAdmin = $auth->getRole('superAdmin');
    //    $auth->addChild($superAdmin, $admin);
    //    $auth->addChild($superAdmin, $auth->getPermission('roleUser'));

    }
}

?>