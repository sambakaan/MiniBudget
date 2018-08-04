<?php
use yii\helpers\Html;
?>


<h1>Voici le lien </h1>
 <p>
 <?= Html::a('Changer Maintenant', ['/site/reset-password','token' => $user->password_reset_token], ['class' => 'btn  btn-success']) ?>
</p>