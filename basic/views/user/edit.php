<?php

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\ArrayHelper;
$this->title = 'изменение пользователя';
//debug($roles);

// <div class="mb-3">
//                  $form->field($model, 'role', [
//                     'inputOptions' => [
//                         'class' => 'form-control mt-1'
//                     ]
//                 ])->dropdownList(ArrayHelper::map(
//                     $roles, 'name', 'description'),
//                     [
//                         'options' => [
//                             current(ArrayHelper::getColumn(Yii::$app->authManager->getRolesByUser($user['id']), 'name')) => ['selected' => true]
//                         ]
//                     ]
//                 )->label('Роль') 
//             </div>
?>


<?php  if(Yii::$app->user->isGuest): ?>
        <h1>У вас нет доступа к этой страницу</h1>
<?php  else: ?>

<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

    <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_confirmed')->passwordInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
            
    <div class="form-group">
        <div class="offset-lg-1 col-lg-11">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>
<?php  endif;?>