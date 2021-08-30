<?php
include 'conexion.php';

$alumno = $_POST['id_alumno'];

$queryResult = $connect->query("
SELECT A.*, B.NOM_PROFESOR, C.NOMBRE_CURSO
FROM 
HORARIO A,
PROFESOR B,
CURSO C
WHERE 
A.ID_CURSO = C.ID_CURSO AND 
A.ID_PROFESOR = B.ID_PROFESOR AND 
A.ESTADO_HORARIO = 'A' AND
A.ID_PROFESOR <> 0  AND
A.ID_HORARIO IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = $alumno)
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
	
	$result[] = array('curso'=>$fetchData['NOMBRE_CURSO'],'profesor'=>$fetchData['NOM_PROFESOR'], 'horas'=> date_format(date_create($fetchData['HR_INICIO']),'H:i').' a '. date_format(date_create($fetchData['HR_FIN']),'H:i').' - '. $dias , 'id'=> $fetchData['ID_HORARIO']);	
	
}

echo json_encode($result);

?>