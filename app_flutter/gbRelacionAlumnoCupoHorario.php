<?php
include 'conexion.php';

//$clase = $_POST['id_horario'];
$alumno = $_POST['id_alumno'];
$curso = $_POST['id_curso'];
$horario = $_POST['id_horario'];

$fcHoy = date("Ymd");
$queryResult = $connect->query("INSERT INTO reserva_cupo_clase VALUES ($alumno,$curso,$fcHoy,NULL,'A',$horario)");



echo json_encode($alumno);

?>