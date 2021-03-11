<?php
include 'conexion.php';

//$clase = $_POST['id_horario'];
$alumno = $_POST['id_alumno'];
$clase = $_POST['id_horario'];

$queryResult = $connect->query("INSERT INTO horario_alumno VALUES ($alumno,$clase)");



echo json_encode('grabado');

/*$queryResult = $connect->query("SELECT * FROM CURSO WHERE ESTADO_CURSO = 'A'");

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
	$result[]=$fetchData;
}*/



?>