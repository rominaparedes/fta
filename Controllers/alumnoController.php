<?php 
require_once dirname(__DIR__) .'/connection.php';
require_once dirname(__DIR__) .'/Model/alumno.php';

class UsuarioController
{


	
	function __construct()
	{

	}
	
	function index(){
		require_once('Views/Alumno/bienvenido.php');
	}


	function guardar(){
		
		$lunes = 0;
		$martes = 0;
		$miercoles = 0;
		$jueves = 0;
		$viernes = 0;
		$sabado = 0;
		$domingo = 0;

		foreach($_POST['dias'] as $selected){
			
			if ($selected == 1){
				$lunes = 1;
			}else if ($selected == 2){
				$martes = 1;
			}else if ($selected == 3){
				$miercoles = 1;
			}else if ($selected == 4){
				$jueves = 1;					
			}else if ($selected ==5){
				$viernes = 1;					
			}else if ($selected == 6){
				$sabado = 1;					
			}else if ($selected == 7){
				$domingo = 1;					
			}
		}
	
		$clases= new Clases(null, $_POST['fcDesde'],$_POST['fcHasta'],$_POST['hrDesde'],$_POST['hrHasta'],$lunes , $martes, $miercoles ,$jueves ,$viernes ,$sabado ,$domingo,$_POST['cupos'],$_POST['curso']);

		Clases::guardarClase($clases);
		
		
	}
	
	
	function obtenerProfes(){
		
		$profes=Clases::buscaProfes();
		$clasesDisponibles=Clases::buscaClasesDisponibles();
		$clasesDis=Clases::buscaClases();
		require_once('asignarProfe.php');
	}
	
	function obtenerAlumnos(){		
		//$alumnos=Clases::buscaAlumnos();
		$clasesDis=Clases::buscaClases();
		require_once('ingresoBoleta.php');
	}
	
	function detalleAsis(){		
		$detalleA=Clases::buscaDetAsis();
		foreach($detalleA as $i => $row ){
			$totalC = $row['CANTIDAD_CLASES'] - $row['ASISTIDAS'];
			$detalleA[$i]['boton'] = "<button onclick='verDetalle(".$row['RUT_PERSONA'].",".$row['ID_CURSO'].")'type='button' data-toggle='modal' data-target='#exampleModal' class='btn btn-primary'>Ver Días</button>";
			
		}
		$arreglo = Array('data'=>$detalleA);
		echo json_encode($arreglo);
		
		
	}
	
	function detAsis(){		
		require_once('consumoMensual.php');
	}
	
	function cerrarSession(){		
		require_once('cerrarSession.php');
	}
	
	function obtenerAlumnoss($curso){		
		$alumnos=Clases::buscaAlumnos($curso);
		echo json_encode($alumnos);
	}
	
	public function obtenerProfess($curso){	
 		$profesO=Clases::buscaProfess($curso);
 		$dato = null;
		echo json_encode($profesO);
	}
	
	public function obtClasesDis($claseSeleccionada,$profeSeleccionado){
		$arreglo = null;
		$datoD = null;
		
		$clasesDisponiblesxCurso=Clases::buscaClasesDisponiblesxCurso($claseSeleccionada);
		$cantC = count($clasesDisponiblesxCurso);
		$clasesTomadasxProfesor=Clases::buscaClasesTomadasxProfe($profeSeleccionado);
		if ($clasesTomadasxProfesor){
			$cantP = count($clasesTomadasxProfesor);
			
			for ($i=0; $i<$cantC;$i++){
				$igual=false;
				
				for ($j=0; $j<$cantP && !$igual;$j++){
					
					if (($clasesDisponiblesxCurso[$i]['HR_INICIO'] <= $clasesTomadasxProfesor[$j]['HR_INICIO'] && $clasesDisponiblesxCurso[$i]['HR_INICIO'] <= $clasesTomadasxProfesor[$j]['HR_FIN'])
						|| ($clasesDisponiblesxCurso[$i]['HR_INICIO'] >= $clasesTomadasxProfesor[$j]['HR_INICIO'] && $clasesDisponiblesxCurso[$i]['HR_INICIO'] >= $clasesTomadasxProfesor[$j]['HR_FIN'])){
							
						$dias = "";
						if ($clasesDisponiblesxCurso[$i]['LUNES'] == 1){
							$dias = $dias .' Lunes';
						}
						if ($clasesDisponiblesxCurso[$i]['MARTES'] == 1){
							$dias = $dias .' Martes';
						}
						if ($clasesDisponiblesxCurso[$i]['MIERCOLES'] == 1){
							$dias = $dias .' Miercoles';
						}
						if ($clasesDisponiblesxCurso[$i]['JUEVES'] == 1){
							$dias = $dias .' Jueves';
						}
						if ($clasesDisponiblesxCurso[$i]['VIERNES'] == 1){
							$dias = $dias .' Viernes';
						}
						if ($clasesDisponiblesxCurso[$i]['SABADO'] == 1){
							$dias = $dias .' Sabado';
						}
						if ($clasesDisponiblesxCurso[$i]['DOMINGO'] == 1){
							$dias = $dias .' Domingo';
						}
						
					}
					
				}
				$arreglo[] = array('horas'=> $clasesDisponiblesxCurso[$i]['HR_INICIO'].' a '. $clasesDisponiblesxCurso[$i]['HR_FIN'].' - '. $dias , 'id'=> $clasesDisponiblesxCurso[$i]['ID_HORARIO']);
			}
					
		echo json_encode($arreglo);
			
			
		}else {
				foreach($clasesDisponiblesxCurso as $row){
					$dias = "";
					if ($row['LUNES'] == 1){
						$dias = $dias .' Lunes';
					}
					if ($row['MARTES'] == 1){
						$dias = $dias .' Martes';
					}
					if ($row['MIERCOLES'] == 1){
						$dias = $dias .' Miercoles';
					}
					if ($row['JUEVES'] == 1){
						$dias = $dias .' Jueves';
					}
					if ($row['VIERNES'] == 1){
						$dias = $dias .' Viernes';
					}
					if ($row['SABADO'] == 1){
						$dias = $dias .' Sabado';
					}
					if ($row['DOMINGO'] == 1){
						$dias = $dias .' Domingo';
					}
					$datoD[] = array('horas'=> $row['HR_INICIO'].' a '. $row['HR_FIN'] .' - '. $dias, 'id'=> $row['ID_HORARIO']);
				}
				echo json_encode($datoD);
				
		}
	}
	
	
	
	function buscar(){		
		$clases=Clases::buscaClases();
		require_once('verBotones.php');
	}
	
	function obtenerReservas(){		
		$clases=Clases::buscaClases();
		require_once('verReservas.php');
	}
	
	function registrarAlumno(){		
		//$clases=Clases::buscaClases();
		require_once('registroAlumno.php');
	}
	
	
	
	function guardarAsignacion(){
		$horarios = $_POST['horarios'];
		$curso = $_POST['curso'];
		$prof = $_POST['profesor'];
		foreach($horarios as $sele){
			Clases::guardarAsigna($sele,$curso,$prof);
			Clases::actualizaHorario($sele,$curso,$prof);
		}
	}
	
	function guardarIngreso(){
		
		$lunes = 0;
		$martes = 0;
		$miercoles = 0;
		$jueves = 0;
		$viernes = 0;
		$sabado = 0;
		$domingo = 0;

		foreach($_POST['dias'] as $selected){
			
			if ($selected == 1){
				$lunes = 1;
			}else if ($selected == 2){
				$martes = 1;
			}else if ($selected == 3){
				$miercoles = 1;
			}else if ($selected == 4){
				$jueves = 1;					
			}else if ($selected ==5){
				$viernes = 1;					
			}else if ($selected == 6){
				$sabado = 1;					
			}else if ($selected == 7){
				$domingo = 1;					
			}
		}
	
		$clases= new Clases(null, $_POST['fcDesde'],$_POST['fcHasta'],$_POST['hrDesde'],$_POST['hrHasta'],$lunes , $martes, $miercoles ,$jueves ,$viernes ,$sabado ,$domingo,$_POST['cupos'],$_POST['curso']);

		Clases::guardarClase($clases);
		//echo json_encode(0);		
		
	}
	
	function guardarBoleta($nrBoleta,$cantClas,$msPag,$alSel,$cursoSel){
		Clases::guardarBoleta($nrBoleta,$cantClas,$msPag,$alSel,$cursoSel);		
	}
	
	function validaBoleta($msPag,$alSel,$cursoSel){
		$existeBol = Clases::validaBoleta($msPag,$alSel,$cursoSel);
		/*if ($existeBol=='1'){
			$existeBol='s';
		}else{
			$existeBol='n';
		}*/
		echo json_encode($existeBol[0][0]);		
	}
	
	function buscaHoras($alumno,$curso){
		$bHoras = Clases::buscaHoras($alumno,$curso);
		echo json_encode($bHoras);		
	}
	
	function buscaDetHras($idReserva){
		
		$bDetHras=Clases::buscaDetHras($idReserva);
		echo json_encode($bDetHras);
		
		
	}
	
		
	function existeUsuario($uss,$pasw){
		$existe=Clases::existeUsuario($uss,$pasw);
		echo json_encode($existe[0][0]);
		
		
	}
	
	function obtPerfil($ussuario,$pasword){
		
		//echo 's';
		$perfil=Clases::obtPerfil($ussuario,$pasword);
		//echo $perfil[0][0];
		//require_once('..\Views\diseno\login.php');
		//
		echo json_encode($perfil[0][0]);
		
		
		//$clases=Clases::buscaClases();
		
		
		
	}
	
	
	
	function buscaReservas($curso,$fecha,$hora){
 		$reservas=Clases::buscaReservas($curso,$fecha,$hora);
		echo json_encode($reservas);
	}


	function error(){
		require_once('Views/alumno/error.php');
	}

}

if(isset($_POST['func']) && !empty($_POST['func'])) {
	$opcion = $_POST['func'];
	$dato = $_POST['cursoSeleccionado1'];
	$usuario = new UsuarioController();

	switch($opcion) {
		case 'obtenerProfess': 
			$usuario->obtenerProfess($dato);		
		break;
	}
}

if(isset($_POST['funcC']) && !empty($_POST['funcC'])) {
	$opcion = $_POST['funcC'];
	$usuario = new UsuarioController();

	switch($opcion) {
		case 'detalleAsis': 
			$usuario->detalleAsis();		
		break;
	}
}

if(isset($_POST['func2']) && !empty($_POST['func2'])) {
	$opcion = $_POST['func2'];
	$claseSeleccionada = $_POST['cursoSeleccionado1'];
	$profeSeleccionado = $_POST['profeSeleccionado'];
	$usuario = new UsuarioController();

	switch($opcion) {
		case 'obtClasesDis':
			$usuario->obtClasesDis($claseSeleccionada,$profeSeleccionado);
		break;
	}
}

if (isset($_POST['horarios']) && !empty($_POST['horarios'])){
	$usuario = new UsuarioController();
	
	$usuario->guardarAsignacion();
	
}

if (isset($_POST['dias']) && !empty($_POST['dias'])){
	
	$usuario = new UsuarioController();	
	$usuario->guardarIngreso();
	
}

if (isset($_POST['func1']) && !empty($_POST['func1'])){//func1: 'buscaReservas', cursoSeleccionado: cursoSeleccionado, fecha: fecha, hora: hora
	$opcion = $_POST['func1'];
	$curso = $_POST['cursoSeleccionado'];	
	$fecha = $_POST['fecha'];
	$hora = $_POST['hora'];
	
	$usuario = new UsuarioController();
	switch($opcion) {
		case 'buscaReservas': 
			$usuario->buscaReservas($curso,$fecha,$hora);
		break;
	}
	
	
}


if (isset($_POST['func3']) && !empty($_POST['func3'])){
	$opcion = $_POST['func3'];
	$dato = $_POST['cursoSeleccionado1'];
	$usuario = new UsuarioController();	
		switch($opcion) {
		case 'obtenerAlumnos': 
			$usuario->obtenerAlumnoss($dato);		
		break;
	}
	
}

if (isset($_POST['func4']) && !empty($_POST['func4'])){
	$opcion = $_POST['func4'];
	$nrBoleta = $_POST['nrBoleta'];
	$cantClas = $_POST['cantClas'];
	$msPag= $_POST['msPag'];
	$alSel= $_POST['alSel'];
	$cursoSel= $_POST['cursoSel'];
	
	$usuario = new UsuarioController();	
		switch($opcion) {
		case 'guardarBoleta': 
			$usuario->guardarBoleta($nrBoleta,$cantClas,$msPag,$alSel,$cursoSel);		
		break;
	}
	
}

if (isset($_POST['func5']) && !empty($_POST['func5'])){
	$opcion = $_POST['func5'];
	$msPag= $_POST['msPag'];
	$alSel= $_POST['alSel'];
	$cursoSel= $_POST['cursoSel'];
	
	$usuario = new UsuarioController();	
		switch($opcion) {
		case 'validaBoleta': 
			$usuario->validaBoleta($msPag,$alSel,$cursoSel);		
		break;
	}
	
}

if (isset($_POST['funcM']) && !empty($_POST['funcM'])){
	$opcion = $_POST['funcM'];
	$alumno= $_POST['alum'];
	$curso= $_POST['id_c'];

	
	$usuario = new UsuarioController();	
		switch($opcion) {
		case 'detalleHoras': 
			$usuario->buscaHoras($alumno,$curso);		
		break;
	}
	
}

if (isset($_POST['funcR']) && !empty($_POST['funcR'])){
	$opcion = $_POST['funcR'];
	$idReserva= $_POST['id_res'];

	
	$usuario = new UsuarioController();	
		switch($opcion) {
		case 'detalleHorasAlumno': 
			$usuario->buscaDetHras($idReserva);		
		break;
	}
	
}

if (isset($_POST['func01']) && !empty($_POST['func01'])){
	$opcion = $_POST['func01'];
	$uss= $_POST['rutUsuario'];
	$pasw= $_POST['passUsuario'];

	
	$usuario = new UsuarioController();	
		switch($opcion) {
		case 'existeUsuario': 
			$usuario->existeUsuario($uss,$pasw);		
		break;
	}
	
}

if (isset($_POST['func02']) && !empty($_POST['func02'])){
	$opcion = $_POST['func02'];
	$ussuario= $_POST['rutUsuario2'];
	$pasword= $_POST['passUsuario2'];

	
	$usuario = new UsuarioController();	
		switch($opcion) {
		case 'obtPerfil': 
			$usuario->obtPerfil($ussuario,$pasword);		
		break;
	}
	
}


?>