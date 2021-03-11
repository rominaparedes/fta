<?php
include 'conexion.php';

//$clase = $_POST['id_horario'];
$alumno = $_POST['id_alumno'];
$curso = $_POST['id_curso'];

$fcHoy = date("Ymd");
$queryResult = $connect->query("INSERT INTO reserva_cupo_clase VALUES ($alumno,$curso,$fcHoy,NULL,'A')");



echo json_encode('grabado');

?>