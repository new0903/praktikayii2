<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\AppealForm;
use app\models\Appeals;
use app\models\AboutsForm;
use app\models\SearchForm;
use yii\data\Sort;
use yii\web\UploadedFile;
//use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    
   // public static $user;
   
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();//возвращаемся в индекс (выходим из формы)
        }
//Yii::$app->user->identity->username
//Yii::$app->user->isGuest
        
        $model = new LoginForm();
        //User::$users=Users::find()->asArray()->all();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
          //  debug($model->login());
          //  die;
            return $this->goBack();
        }
      //  $model->password = '';
        return $this->render('login', [
            'model' => $model,
          //  'users'=>User::$users,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionAppeal()
    {
        $model = new AppealForm();
        if (!Yii::$app->user->isGuest) {
            //$userInfo= //Users::find()->where('id='.Yii::$app->user->getId())->asArray()->all();
            //if ($userInfo[0]['name_u']) {
            
                $model->name=Yii::$app->user->identity->name;//$userInfo[0]['name_u'];
         //   }
          //  if ($userInfo[0]['email']) {
               
                $model->email=Yii::$app->user->identity->email;//$userInfo[0]['email'];
           // }
        }
        
       // $model->phone;
       //$model->email=;
        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isPost) {
                if ($model->validate()) {
                   // debug($_FILES);
                    //die;
                    ($_FILES['AppealForm']['name']['userFile'] ? $model->userFile = UploadedFile::getInstance($model, 'userFile') : "");
                    if ($model->userFile) {
                        $a=0;
                        $path=__DIR__.'/../doc/'. $model->userFile->baseName . '.' . $model->userFile->extension;
                        while (!fileExist($path)) {
                            
                            $path=$a===0 ?  __DIR__.'/../doc/'. $model->userFile->baseName . '.' . $model->userFile->extension : __DIR__.'/../doc/'. $model->userFile->baseName .'('.$a.')'. '.' . $model->userFile->extension;
                            if (!fileExist($path)) {
                                $a++;
                            }
                            
                        }
                        $model->userFile->saveAs($path);
                        $path=$a===0 ? $model->userFile->baseName . '.' . $model->userFile->extension: $model->userFile->baseName .'('.$a.')'. '.' . $model->userFile->extension;
                        $model->userFile=$path;
                    }

                    $post=new Appeals();
                   // $user=new Posts();
                    // if (!Yii::$app->user->isGuest) {
                    //     $post->id_user=Yii::$app->user->getId();
                    // }else{
                    //     $post->id_user=3;
                    // }
                    
                    $post->text=$model->text;
                    $post->file=$model->userFile;
                    $post->email=$model->email;
                    $post->phone=$model->phone;
                    $post->name=$model->name;
                    $post->created_at=date('Y-m-d H:i:s');
                    $post->save();
                //     var_dump($message);
                //     die;
                   // $this->sendMessage('anfisakh@yandex.ru','Russcazak@yandex.ru',$post->name.' отправил вам сообщение',$post->text,$post->file);
                    Yii::$app->session->setFlash('success','данные приняты');

                // $model->save();
                    return $this->refresh();//очищает форму
                }else{
                    Yii::$app->session->setFlash('error','ошибка');
                }
            }  
        }
        return $this->render('appeal', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAppealcontent($page=null,$limit=null)
    {
        $sort=new Sort([
            'attributes' => [
                'created_at' => [
                    'asc' => ['created_at' => SORT_ASC, 'created_at' => SORT_ASC],
                    'desc' => ['created_at' => SORT_DESC, 'created_at' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'отсортировать по дате',
                ],
                'name' => [
                    'asc' => ['name' => SORT_ASC, 'name' => SORT_ASC],
                    'desc' => ['name' => SORT_DESC, 'name' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'отсортирповать по ФИО',
                ],
                'phone' => [
                    'asc' => ['phone' => SORT_ASC, 'phone' => SORT_ASC],
                    'desc' => ['phone' => SORT_DESC, 'phone' => SORT_DESC],
                    'default' => SORT_DESC,
                    'label' => 'отсортировать по номеру телефона',
                ],
            ],
        ]);

        $model=new AboutsForm();
        $search=new SearchForm();
        $poisk='';
        if ($limit===null) {
            $limit=6;
        }   
        if ($page===null) {
            $page=1;
        }
        $pages=0;
        $offset=0;
        if ($search->load(Yii::$app->request->get())) {
            if ($search->validate()) {
                $poisk=$search->search;
                
            }
        }
        $posts=Appeals::find()->where(['like','name',$poisk])->
        orWhere(['like','email',$poisk])->
        orWhere(['like','phone',$poisk])->
        orderBy($sort->orders)->asArray()->all();//->with('user')
        
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
        return $this->render('appealcontent',compact('limit','result','pages','model','sort','search'));//'page',
        
    }




    public function actionContent($id){
        $post=Appeals::find()->where('id='.$id)->asArray()->all();
        return $this->render('content',['postContent'=>$post]);
    }


    public function actionDownload($id)
    {
       // $model = $this->findModel($id);
        $file = __DIR__.'/../doc/'.$id;
        return Yii::$app->response->sendFile($file); 
    }





    public function sendMessage($from,$to,$subject,$text,$file=null){
        $message=Yii::$app->mailer->compose();
        // $message->setFrom($from);//'from@domain.com'
        // $message->setTo($to);//'to@domain.com'
        // $message->setSubject($subject);//'Тема сообщения'
        // $message->setTextBody($text);//'Текст сообщения'
        // if ($file) {
        //     $message->attach(__DIR__.'/../doc/'.$file);
        // }
        $message->setFrom('Russcazak@yandex.ru');
        $message->setTo('Russcazak@yandex.ru');
        $message->setSubject('Оглавление');
        $message->setTextBody('Содержимое');
      //  ->setHtmlBody('<b>текст сообщения в формате HTML</b>')
        $message->send();
    }




    
}
