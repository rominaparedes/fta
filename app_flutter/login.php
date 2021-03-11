<?php
include 'conexion.php';

//$usuario = $_POST['NOM_PERFIL'];



$queryResult = $connect->query("SELECT * FROM PERFIL");

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
	$result[]=$fetchData;
}

echo json_encode($result);

?>