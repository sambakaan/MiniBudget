<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Se connecter';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login col-lg-offset-3">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-6 ">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'telephone')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Mot de passe') ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Se souvenir de moi'); ?>

                <div class="form-group">
                    <?= Html::submitButton('Se connecter', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
