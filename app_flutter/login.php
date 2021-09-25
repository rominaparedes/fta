<?php
include 'conexion.php';

$usuario = $_POST['rut'];
$passw = $_POST['pass'];



$queryResult = $connect->query("
SELECT 
	B.NOMBRE_PERSONA as NOMBRE_PERSONA, 
	A.RUT_PERSONA AS RUT,
	B.SEXO AS SEXO
FROM 
	PERSONA_PERFIL A, 
	PERSONA B 
WHERE 
	A.RUT_PERSONA = '$usuario' and
	A.contrasena = '$passw' and
	A.id_perfil = 3 AND
	A.RUT_PERSONA = B.RUT_PERSONA");

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
	$result[]=$fetchData;
}

echo json_encode($result);

?>