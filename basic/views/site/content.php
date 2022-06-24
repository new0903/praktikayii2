
<?php
use yii\helpers\Html;
$this->title = 'обращение';
//
?>
<?php
//echo $id;
?>
<?php  //debug($postContent) ?>

<?php  if(Yii::$app->user->isGuest): ?>
        <h1>У вас нет доступа к этой страницу</h1>
<?php  else: ?>

    <h3><?= $postContent[0]["name"] ?></h3>
    <div class="post-content">
        <span><?= $postContent[0]["phone"]?></span>
        <span><?= $postContent[0]["email"]?></span>
        <span><?= $postContent[0]["created_at"]?></span>
        <p><?= $postContent[0]["text"]?></p>
    </div>
    <?php  if($postContent[0]["file"]): ?>
        <?=  Html::a('Download '.$postContent[0]["file"],['download','id'=>$postContent[0]["file"]]) ?>
    <?php  endif;?>


    <?php  endif;?>

