<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Budget */

$this->title = 'Mise à Jour' ;
$this->params['breadcrumbs'][] = ['label' => 'Budgets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Editer';
?>
<div class="budget-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
