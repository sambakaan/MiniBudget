<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_id')->dropDownList(
        ArrayHelper::map($types,'id','libelle'),
        ['prompt'=> 'Selectionner le type de transaction']
    )->label('Type de transaction'); ?>   

    <?= $form->field($model, 'budget_id')->dropDownList(
        ArrayHelper::map($budgets,'id','somme'),
        ['prompt'=> 'Selectionner le buget pour cette transaction']
    )->label('Buget pour cette transaction'); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'montant')->textInput() ?>
    
    <div class="form-group">
        <?= Html::submitButton('Enregister', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
