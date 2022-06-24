

<?php
use yii\helpers\Html;

$this->title = 'Административный раздел';

?>
<?php  if(Yii::$app->user->isGuest): ?>
        <h1>У вас нет доступа к этой страницу</h1>
<?php  else: ?>


<div class="container">
    <div class="admin_list w-50 m-auto" style="margin-top: 100px!important;">
        <h4 class="text-center text-dark mb-4">Выберите нужный раздел</h4>
        <div class="list-group">
            <?= Html::a('Настройки',['/user/edit','id'=>Yii::$app->user->getId()],['class'=>'list-group-item list-group-item-action']) ?>
            <?= Html::a('Управление пользователями',['/user/listusers'],['class'=>'list-group-item list-group-item-action']) ?>
            <?= Html::a('Обращения',['/site/appealcontent'],['class'=>'list-group-item list-group-item-action']) ?>
        </div>
    </div>

</div>

<?php  endif;?>
