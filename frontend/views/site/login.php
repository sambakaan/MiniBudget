<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Authentification';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1 class="col-lg-offset-3"><?= Html::encode($this->title) ?></h1>

    <div class="row ">
        <div class="col-lg-5 col-lg-offset-3">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'telephone')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Mot de passe') ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Se souvenir de moi'); ?>

                <div style="color:#999;margin:1em 0" class="text-center">
                    Mot de passe oublié <?= Html::a('Réinitialiser ici', ['site/request-password-reset']) ?>.
                </div>

                <div class="form-group text-center ">
                    <?= Html::submitButton('Se connecter', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
