<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReservasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reservas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reservas-index">

    <style>
        table {
            margin: auto;
        }
        td {
            padding: 6px;
            text-align: center;
        }
        td a {
            width: 100%;
        }
    </style>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $hoy = new DateTime('now');
    $hoy->setTime('00', '00', '00');

    $semana = new DateTime('now');
    $semana->setTime('00', '00', '00');
    $semana->add(new DateInterval('P7D'));

    $dia = $hoy;

    // Rango de horas abierto
    $horas = range(10, 20, 1);

    // Creo array con todas las fechas
    $modelos = $dataProvider->models;
    $reservas = [];
    foreach ($modelos as $modelo) {
        array_push($reservas, $modelo->fecha);
    }

    // Creo array solo con fechas del usuario logueado
    $modelos = $dataProvider->query->where([
        'usuario_id' => Yii::$app->user->identity->id
    ])->all();
    $misReservas = [];
    foreach ($modelos as $modelo) {
        array_push($misReservas, $modelo->fecha);
    }


    function titulo($dia) {
        return $dia->format('d-m-Y');
    }

    function accion($dia, $hora, $reservas, $misReservas) {
        $cita = $dia->setTime($hora, '00')->format('Y-m-d H:i:s');

        if (in_array($cita, $misReservas)) {
            return HTML::a('Anular', ['reservas/delete'], [
                'class' => 'btn btn-xs btn-danger',
                'data' => [
                    'method' => 'post',
                    'params' => ['fecha' => $cita],
                ],
            ]);
        } elseif (in_array($cita, $reservas)) {
            return '<p class="btn btn-xs btn-primary"> Reservado</p>';
        } else {
            return HTML::a('Reservar', ['reservas/create'], [
                'class' => 'btn btn-xs btn-success',
                'data' => [
                    'method' => 'post',
                    'params' => ['fecha' => $cita],
                ],
            ]);
        }
    }
    ?>

    <h3>Tabla de reservas</h3>

    <table border="1">
        <tr>
            <td></td>
            <?php foreach ($horas as $hora): ?>
            <td><?= $hora.':00' ?></td>
            <?php endforeach; ?>
        </tr>

        <?php while ($dia < $semana): ?>
        <tr>
            <td><?= titulo($dia); ?></td>

            <?php foreach ($horas as $hora): ?>
                <td>
                    <?= accion($dia, $hora, $reservas, $misReservas) ?>
                </td>

            <?php endforeach; ?>

            <?php $dia->add(new DateInterval('P1D')); ?>
        </tr>
        <?php endwhile; ?>
    </table>


    <br />

    <h3>Listado de reservas</h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [

            //'id',
            'usuario.nombre',
            'fecha:datetime',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
