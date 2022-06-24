<?php

namespace app\models;

use Yii;
use yii\base\Model;
//use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * ContactForm is the model behind the contact form.
 */
class AppealForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $text;
    public $userFile;
    public $verifyCode;


  /*  public static function tableName()
    {
        return 'post';
    }*/

    /**
     * @return array the validation rules.
     * 
     * 
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'phone','text'], 'required'],
            ['phone','match','pattern' => '/^8[0-9]{3}[0-9]{3}[0-9]{2}[0-9]{2}$/'],//+7 (012) 345-67-89
            //['text','safe'],                                                                   /^\+7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/
            // email has to be a valid email address 12
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
         
            [['userFile'], 'file',  'extensions' => 'doc, pdf, docx'],//'skipOnEmpty' => false,
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'name'=>'ФИО',
            'subject'=>'телефон',
            'email'=>'E-mail',
            'body'=>'Текст обращения',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }

/*
    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
*/
}

