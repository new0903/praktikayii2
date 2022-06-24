<?php

namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class Role extends ActiveRecord
{

    public static function tableName()
    {
        return 'auth_item';
    }

    public static function getRole()
    {
        return self::find()->where(['type' => 1])->asArray()->all();
    }

    public function assignRole($role, $id)
    {
        $auth = Yii::$app->authManager;
        $auth->assign($auth->getRole($role), $id);
    }
/*
что то там про роли неплохо растолковывает
https://yandex.ru/video/preview/?filmId=4839738049653775148&from=tabbar&reqid=1654509496464292-15580815967931105236-sas3-0752-6e1-sas-l7-balancer-8080-BAL-3526&suggest_reqid=79980853164682013994978015224832&text=yii2+%D0%BA%D0%B0%D0%BA+%D0%B4%D0%BE%D0%B1%D0%B0%D0%B2%D0%B8%D1%82%D1%8C+%D1%80%D0%BE%D0%BB%D1%8C+


*/
}