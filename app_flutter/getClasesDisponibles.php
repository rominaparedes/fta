<?php
include 'conexion.php';

$curso = $_POST['id_curso_sel'];
//$curso = 3;

$queryResult = $connect->query("
SELECT *
FROM 
HORARIO 
WHERE 
ESTADO_HORARIO = 'A' AND
ID_PROFESOR <> 0 AND
ID_CURSO = $curso AND ID_HORARIO NOT IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = 11111111 )
" );

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
	$dias = "";
	if ($fetchData['LUNES'] == 1){
		$dias = $dias .' Lunes';
	}
	if ($fetchData['MARTES'] == 1){
		$dias = $dias .' Martes';
	}
	if ($fetchData['MIERCOLES'] == 1){
		$dias = $dias .' Miercoles';
	}
	if ($fetchData['JUEVES'] == 1){
		$dias = $dias .' Jueves';
	}
	if ($fetchData['VIERNES'] == 1){
		$dias = $dias .' Viernes';
	}
	if ($fetchData['SABADO'] == 1){
		$dias = $dias .' Sabado';
	}
	if ($fetchData['DOMINGO'] == 1){
		$dias = $dias .' Domingo';
	}
	
	$result[] = array('horas'=> date_format(date_create($fetchData['HR_INICIO']),'H:i').' a '. date_format(date_create($fetchData['HR_FIN']),'H:i').' - '. $dias , 'id'=> $fetchData['ID_HORARIO']);	
	
}

echo json_encode($result);

?>