<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<main class="container container--registration">
    <div class="center-block">
        <div class="registration-form regular-form">
            <?php $form = ActiveForm::begin(); ?>

            <h3 class="head-main head-task">Регистрация нового пользователя</h3>

            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'email')->input('email') ?>

            <?= $form->field($model, 'location')->textInput() ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'password_retype')->passwordInput() ?>

            <?= $form->field($model, 'willRespond')
                ->checkbox(['label' => 'я собираюсь откликаться на заказы']) ?>

            <?= Html::submitButton('Создать аккаунт', [
                'class' => 'button button--blue'
            ]) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</main>
