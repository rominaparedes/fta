<?php
include 'conexion.php';

$dias = substr($_POST['id_dias_sel'],1);
$ddd = explode(",", $dias);

$result=array();
$p = count($ddd);
for ($i=0; $i<$p;$i++){
	if ($ddd[$i] == 'Lunes'){
		$queryResult = $connect->query("SELECT A.*, B.NOMBRE_CURSO FROM HORARIO A, CURSO B WHERE A.ESTADO_HORARIO = 'A' AND A.ID_PROFESOR <> 0 AND A.LUNES = 1 AND A.ID_CURSO = B.ID_CURSO AND A.ID_HORARIO NOT IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = 11111111 ) " );		
		while($fetchData=$queryResult->fetch_assoc()){
			$result[] = array('horas'=> date_format(date_create($fetchData['HR_INICIO']),'H:i').' a '. date_format(date_create($fetchData['HR_FIN']),'H:i').' - '. $ddd[$i] . ' - ' . $fetchData['NOMBRE_CURSO'] , 'id'=> $fetchData['ID_HORARIO']);
		}		
	}
	
	if ($ddd[$i] == 'Martes'){
		$queryResult = $connect->query("SELECT A.*, B.NOMBRE_CURSO FROM HORARIO A, CURSO B WHERE A.ESTADO_HORARIO = 'A' AND A.ID_PROFESOR <> 0 AND A.MARTES = 1 AND A.ID_CURSO = B.ID_CURSO AND A.ID_HORARIO NOT IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = 11111111 )" );
		while($fetchData=$queryResult->fetch_assoc()){
			$result[] = array('horas'=> date_format(date_create($fetchData['HR_INICIO']),'H:i').' a '. date_format(date_create($fetchData['HR_FIN']),'H:i').' - '. $ddd[$i] . ' - ' . $fetchData['NOMBRE_CURSO'] , 'id'=> $fetchData['ID_HORARIO']);
		}		
	}
	
	if ($ddd[$i] == 'Miercoles'){
		$queryResult = $connect->query("SELECT A.*, B.NOMBRE_CURSO FROM HORARIO A, CURSO B WHERE A.ESTADO_HORARIO = 'A' AND A.ID_PROFESOR <> 0 AND A.MIERCOLES = 1 AND A.ID_CURSO = B.ID_CURSO AND A.ID_HORARIO NOT IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = 11111111 )" );
		while($fetchData=$queryResult->fetch_assoc()){
			$result[] = array('horas'=> date_format(date_create($fetchData['HR_INICIO']),'H:i').' a '. date_format(date_create($fetchData['HR_FIN']),'H:i').' - '. $ddd[$i] . ' - ' . $fetchData['NOMBRE_CURSO'] , 'id'=> $fetchData['ID_HORARIO']);
		}		
	}
	
	if ($ddd[$i] == 'Jueves'){
		$queryResult = $connect->query("SELECT A.*, B.NOMBRE_CURSO FROM HORARIO A, CURSO B WHERE A.ESTADO_HORARIO = 'A' AND A.ID_PROFESOR <> 0 AND A.JUEVES = 1 AND A.ID_CURSO = B.ID_CURSO AND A.ID_HORARIO NOT IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = 11111111 )" );
		while($fetchData=$queryResult->fetch_assoc()){
			$result[] = array('horas'=> date_format(date_create($fetchData['HR_INICIO']),'H:i').' a '. date_format(date_create($fetchData['HR_FIN']),'H:i').' - '. $ddd[$i] . ' - ' . $fetchData['NOMBRE_CURSO'] , 'id'=> $fetchData['ID_HORARIO']);
		}		
	} 
	
	if ($ddd[$i] == 'Viernes'){
		$queryResult = $connect->query("SELECT A.*, B.NOMBRE_CURSO FROM HORARIO A, CURSO B WHERE A.ESTADO_HORARIO = 'A' AND A.ID_PROFESOR <> 0 AND A.VIERNES = 1 AND A.ID_CURSO = B.ID_CURSO AND A.ID_HORARIO NOT IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = 11111111 )" );
		while($fetchData=$queryResult->fetch_assoc()){
			$result[] = array('horas'=> date_format(date_create($fetchData['HR_INICIO']),'H:i').' a '. date_format(date_create($fetchData['HR_FIN']),'H:i').' - '. $ddd[$i] . ' - ' . $fetchData['NOMBRE_CURSO'] , 'id'=> $fetchData['ID_HORARIO']);
		}		
	} 
	
	if ($ddd[$i] == 'Sabado'){
		$queryResult = $connect->query("SELECT A.*, B.NOMBRE_CURSO FROM HORARIO A, CURSO B WHERE A.ESTADO_HORARIO = 'A' AND A.ID_PROFESOR <> 0 AND A.SABADO = 1 AND A.ID_CURSO = B.ID_CURSO AND A.ID_HORARIO NOT IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = 11111111 )" );
		while($fetchData=$queryResult->fetch_assoc()){
			$result[] = array('horas'=> date_format(date_create($fetchData['HR_INICIO']),'H:i').' a '. date_format(date_create($fetchData['HR_FIN']),'H:i').' - '. $ddd[$i] . ' - ' . $fetchData['NOMBRE_CURSO'] , 'id'=> $fetchData['ID_HORARIO']);
		}		
	} 
	
	if ($ddd[$i] == 'Domingo'){
		$queryResult = $connect->query("SELECT A.*, B.NOMBRE_CURSO FROM HORARIO A, CURSO B WHERE A.ESTADO_HORARIO = 'A' AND A.ID_PROFESOR <> 0 AND A.DOMINGO = 1 AND A.ID_CURSO = B.ID_CURSO AND A.ID_HORARIO NOT IN (SELECT ID_HORARIO FROM horario_alumno WHERE RUT_PERSONA = 11111111 )" );
		while($fetchData=$queryResult->fetch_assoc()){
			$result[] = array('horas'=> date_format(date_create($fetchData['HR_INICIO']),'H:i').' a '. date_format(date_create($fetchData['HR_FIN']),'H:i').' - '. $ddd[$i] . ' - ' . $fetchData['NOMBRE_CURSO'] , 'id'=> $fetchData['ID_HORARIO']);
		}		
	}
	
}

echo json_encode($result);

?>