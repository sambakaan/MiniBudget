<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Budget */

$this->title = 'Entrez le montant de votre budget';
$this->params['breadcrumbs'][] = ['label' => 'Budgets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="budget-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
