<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
//debug($result);
$items=[
    '6'=>'6',
    '10'=>'10',
    '20'=>'20',
    '30'=>'30',
    '40'=>'40',
    'all'=>'все',
];
$this->title = 'список пользователей';
?>
<?php  if(Yii::$app->user->isGuest): ?>
        <h1>У вас нет доступа к этой страницу</h1>
<?php  else: ?>

<?php $form = ActiveForm::begin(['id' => 'search-form','method'=>'GET']); ?>
<?= $form->field($search, 'search') ?>
<div class="form-group">
    <?= Html::submitButton('Найти', ['class' => 'btn btn-primary', 'name' => 'search-button']) ?>
</div>
<?php ActiveForm::end(); ?>
<?= Html::a('Создать пользователя',['/user/create'],['class'=>'btn btn-primary']) ?>
<div class="site-about">
    <h1> Catalog</h1>
    

    <table>
        <thead>
            <tr>
                <td>name</td>
                <td>login</td>
                <td></td>
            </tr>
        </thead> 
        <tbody> 
            <?php foreach($result as $item): ?>
                <tr>
                    <td><?= $item["name"]?></td>
                    <td><?= $item["login"]?></td>
                    <td><?= Html::a('изменить',['/user/edit','id'=>$item["id"]]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>



</div>

<?php if ($limit!=$pages): ?>
<ol class="pagination">
    <?php for ($i = 1; $i <= $pages; $i = $i + 1): ?>
      <li>
           <?= Html::a($i,['/site/about','page'=>$i,'limit'=>$limit]) ?>
           
      </li>
    <?php endfor; ?>
</ol>
<?php endif ?>

<div class="row">
    <div class="col-lg-5">

    <?php $form2 = ActiveForm::begin(['id' => 'numrow-form','method'=>'GET']); ?>

    <?= $form2->field($model, 'numrow')->dropdownList(
    $items
    ,[
       // 'prompt' => 'Выбор категории',
        'options' => [
            $limit => ['Selected' => true]
        ],
        'onchange'=>'this.form.submit()',
    ])?>


    <?php ActiveForm::end(); ?>

    </div>
</div>
    
<?php  endif;?>