<?php


namespace app\models;
use yii\base\Model;

class AboutsForm extends Model{
    public $numrow;
  //  public $searech;
    
    public function rules()
    {
        return [
            
            ['numrow', 'string'],
        ];
    }
}


?>