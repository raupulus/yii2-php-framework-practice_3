<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Reservas de piscina cubierta</h1>

        <p class="lead">Necesitas acceder a la aplicación para comenzar</p>

        <p>
            <?= Html::a('Acceder',['site/login'],
                ['class'=>'btn btn-lg btn-success'])  ?>
        </p>
    </div>
</div>
