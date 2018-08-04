<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = "S'enregister";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup col-lg-offset-4">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'nom')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'prenom')->textInput() ?>
                <?= $form->field($model, 'telephone')->textInput() ?>
                <?= $form->field($model, 'username')->textInput()->label('Pseudo') ?>

                <?= $form->field($model, 'email')->label('Email') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Mot de passe'); ?>

                <div class="form-group text-center">
                    <?= Html::submitButton('Valider', ['class' => 'btn btn-primary ', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
