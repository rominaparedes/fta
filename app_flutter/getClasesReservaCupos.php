<?php
include 'conexion.php';

//$alumno = $_POST['id_alumno'];
$alumno = '11111111';
//$dia = $_POST['dia'];
$dia = 'Sabado';

$hoy = date("Ymd");

$result=array();

if ($dia == 'Lunes'){
	$queryResult = $connect->query("SELECT 
									(SELECT COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS CUPOS_VAN,
									(SELECT A.CUPOS - COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS DISP,
									A.*,
									A.ID_CURSO,
									B.NOM_PROFESOR,
									C.NOMBRE_CURSO
									FROM 
									HORARIO A,
									PROFESOR B,
									CURSO C
									WHERE 
									A.ID_CURSO = C.ID_CURSO AND 
									A.ID_PROFESOR = B.ID_PROFESOR AND 
									A.ESTADO_HORARIO = 'A' AND
									A.ID_PROFESOR <> 0  AND
									A.ID_HORARIO IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = $alumno) AND 
									A.LUNES = 1") ;
}
if ($dia == 'Martes'){
	$queryResult = $connect->query("SELECT 
									(SELECT COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS CUPOS_VAN,
									(SELECT A.CUPOS - COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS DISP,
									A.*,
									A.ID_CURSO,
									B.NOM_PROFESOR,
									C.NOMBRE_CURSO
									FROM 
									HORARIO A,
									PROFESOR B,
									CURSO C
									WHERE 
									A.ID_CURSO = C.ID_CURSO AND 
									A.ID_PROFESOR = B.ID_PROFESOR AND 
									A.ESTADO_HORARIO = 'A' AND
									A.ID_PROFESOR <> 0  AND
									A.ID_HORARIO IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = $alumno) AND 
									A.MARTES = 1" );
}
if ($dia == 'Miercoles'){
	$queryResult = $connect->query("SELECT 
									(SELECT COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS CUPOS_VAN,
									(SELECT A.CUPOS - COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS DISP,
									A.*,
									A.ID_CURSO,
									B.NOM_PROFESOR,
									C.NOMBRE_CURSO
									FROM 
									HORARIO A,
									PROFESOR B,
									CURSO C
									WHERE 
									A.ID_CURSO = C.ID_CURSO AND 
									A.ID_PROFESOR = B.ID_PROFESOR AND 
									A.ESTADO_HORARIO = 'A' AND
									A.ID_PROFESOR <> 0  AND
									A.ID_HORARIO IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = $alumno) AND 
									A.MIERCOLES = 1" );
}
if ($dia == 'Jueves'){
	$queryResult = $connect->query("SELECT 
									(SELECT COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS CUPOS_VAN,
									(SELECT A.CUPOS - COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS DISP,
									A.*,
									A.ID_CURSO,
									B.NOM_PROFESOR,
									C.NOMBRE_CURSO
									FROM 
									HORARIO A,
									PROFESOR B,
									CURSO C
									WHERE 
									A.ID_CURSO = C.ID_CURSO AND 
									A.ID_PROFESOR = B.ID_PROFESOR AND 
									A.ESTADO_HORARIO = 'A' AND
									A.ID_PROFESOR <> 0  AND
									A.ID_HORARIO IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = $alumno) AND 
									A.JUEVES = 1" );
}
if ($dia == 'Viernes'){
	$queryResult = $connect->query("SELECT 
									(SELECT COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS CUPOS_VAN,
									(SELECT A.CUPOS - COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS DISP,
									A.*,
									A.ID_CURSO,
									B.NOM_PROFESOR,
									C.NOMBRE_CURSO
									FROM 
									HORARIO A,
									PROFESOR B,
									CURSO C
									WHERE 
									A.ID_CURSO = C.ID_CURSO AND 
									A.ID_PROFESOR = B.ID_PROFESOR AND 
									A.ESTADO_HORARIO = 'A' AND
									A.ID_PROFESOR <> 0  AND
									A.ID_HORARIO IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = $alumno) AND 
									A.VIERNES = 1" );
}
if ($dia == 'Sabado'){
	$queryResult = $connect->query("SELECT 
									(SELECT COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS CUPOS_VAN,
									(SELECT A.CUPOS - COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS DISP,
									A.*,
									A.ID_CURSO,
									B.NOM_PROFESOR,
									C.NOMBRE_CURSO
									FROM 
									HORARIO A,
									PROFESOR B,
									CURSO C
									WHERE 
									A.ID_CURSO = C.ID_CURSO AND 
									A.ID_PROFESOR = B.ID_PROFESOR AND 
									A.ESTADO_HORARIO = 'A' AND
									A.ID_PROFESOR <> 0  AND
									A.ID_HORARIO IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = $alumno) AND 
									A.SABADO = 1" );
}
if ($dia == 'Domingo'){
	$queryResult = $connect->query("SELECT 
									(SELECT COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS CUPOS_VAN,
									(SELECT A.CUPOS - COUNT(D.ID_RESERVA) FROM RESERVA_CUPO_CLASE D WHERE D.FECHA_RESERVA = $hoy  AND D.ESTADO_RESERVA = 'A' AND C.ID_CURSO = D.ID_CURSO) AS DISP,
									A.*,
									A.ID_CURSO,
									B.NOM_PROFESOR,
									C.NOMBRE_CURSO
									FROM 
									HORARIO A,
									PROFESOR B,
									CURSO C
									WHERE 
									A.ID_CURSO = C.ID_CURSO AND 
									A.ID_PROFESOR = B.ID_PROFESOR AND 
									A.ESTADO_HORARIO = 'A' AND
									A.ID_PROFESOR <> 0  AND
									A.ID_HORARIO IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = $alumno) AND 
									A.DOMINGO = 1" );
}

while($fetchData=$queryResult->fetch_assoc()){
	$result[] = array('disponible'=>$fetchData['DISP'],'id_curso'=>$fetchData['ID_CURSO'],'cupos_curso'=>$fetchData['CUPOS'],'cupos'=>$fetchData['CUPOS_VAN'],'curso'=>$fetchData['NOMBRE_CURSO'],'profesor'=>$fetchData['NOM_PROFESOR'],'horas'=> date_format(date_create($fetchData['HR_INICIO']),'H:i').' a '. date_format(date_create($fetchData['HR_FIN']),'H:i') ,'id'=> $fetchData['ID_HORARIO']);
}
echo json_encode($result);

?>