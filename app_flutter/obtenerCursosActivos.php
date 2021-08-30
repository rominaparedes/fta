<?php
include 'conexion.php';


$queryResult = $connect->query("SELECT DISTINCT A.ID_CURSO, A.NOMBRE_CURSO FROM CURSO A, HORARIO B WHERE A.ESTADO_CURSO = 'A' AND B.ID_PROFESOR > 1 AND A.ID_CURSO = B.ID_CURSO");

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
	$result[]=$fetchData;
}

echo json_encode($result);

?>