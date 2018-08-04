<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Transaction */

$this->title = 'Ajouter une  Transaction';
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
        'budgets' => $budgets,
    ]) ?>

</div>
