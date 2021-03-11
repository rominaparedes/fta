<?php
include 'conexion.php';


$queryResult = $connect->query("SELECT * FROM CURSO WHERE ESTADO_CURSO = 'A'");

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
	$result[]=$fetchData;
}

echo json_encode($result);

?>