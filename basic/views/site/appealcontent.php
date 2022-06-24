<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
$items=[
    '6'=>'6',
    '10'=>'10',
    '20'=>'20',
    '40'=>'40',
    'all'=>'все',
];

$this->title = 'обращения';
?>

<?php  if(Yii::$app->user->isGuest): ?>
        <h1>У вас нет доступа к этой страницу</h1>
<?php  else: ?>

<?php $form = ActiveForm::begin(['id' => 'search-form','method'=>'GET']); ?>
<?= $form->field($search, 'search') ?>
<div class="form-group">
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'search-button']) ?>
</div>
<?php ActiveForm::end(); ?>


<div class="site-about">
    <table>
        <thead>
            <tr>
                <td><?php echo $sort->link('name') ?></td>
                <td><?php echo $sort->link('phone') ?></td>
                <td><?php echo $sort->link('created_at') ?></td>
                <td>почта</td>
            </tr> 
        </thead>  
        <tbody>
            <?php foreach($result as $item): ?>
                <tr>
                    <td><?= Html::a($item["name"],['/site/content','id'=>$item["id"]]) ?></td>
                    <td><?= $item["phone"]?></td>
                    <td><?= $item["created_at"]?></td>
                    <td><?= $item["email"]?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if ($limit!=$pages): ?>
<ol class="pagination">
    <?php for ($i = 1; $i <= $pages; $i = $i + 1): ?>
      <li>
           <?= Html::a($i,['/site/appealcontent','page'=>$i,'limit'=>$limit]) ?>
           
      </li>
    <?php endfor; ?>
</ol>
<?php endif ?>

<div class="row">
    <div class="col-lg-5">

    <?php $form2 = ActiveForm::begin(['id' => 'num-form','method'=>'GET']); ?>

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