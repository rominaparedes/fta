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
	
		$clases= new Clases(null, $_POST['fcDesde'],$_POST['fcHasta'],$_POST['hrDesde'],$_POST['hrHasta'],$lunes , $martes, $miercoles ,$jueves ,$viernes ,$sabado ,$domingo,$_POST['cupos'],trim($_POST['curso']));

		Clases::guardarClase($clases);
	}
	
	function obtenerProfes(){
		
		$profes=Clases::buscaProfes();
		$clasesDisponibles=Clases::buscaClasesDisponibles();
		$clasesDis=Clases::buscaClases();
		require_once('asignarProfe.php');
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
		//echo print_r($clasesDisponiblesxCurso);
		$clasesTomadasxProfesor=Clases::buscaClasesTomadasxProfe($profeSeleccionado);
		if ($clasesTomadasxProfesor){
			$cantP = count($clasesTomadasxProfesor);
			//echo print_r($clasesTomadasxProfesor);
			
			for ($i=0; $i<$cantC;$i++){
				$igual=false;
				
				for ($j=0; $j<$cantP && !$igual;$j++){
					
					if (($clasesDisponiblesxCurso[$i]['HR_INICIO'] <= $clasesTomadasxProfesor[$j]['HR_INICIO'] && $clasesDisponiblesxCurso[$i]['HR_INICIO'] <= $clasesTomadasxProfesor[$j]['HR_FIN'])
						|| ($clasesDisponiblesxCurso[$i]['HR_INICIO'] <= $clasesTomadasxProfesor[$j]['HR_INICIO'] && $clasesDisponiblesxCurso[$i]['HR_INICIO'] <= $clasesTomadasxProfesor[$j]['HR_FIN'])){
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
						
						$arreglo[] = array('horas'=> $clasesDisponiblesxCurso[$i]['HR_INICIO'].' a '. $clasesDisponiblesxCurso[$i]['HR_FIN'].' - '. $dias , 'id'=> $clasesDisponiblesxCurso[$i]['ID_HORARIO']);
					}
					
					
				
				}
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
		 
		
		/* $datoD = null;
		if($clasesDisponiblesxCurso){
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
		} 
		echo json_encode($datoD);  */
	}
	
	
	
	function buscar(){		
		$clases=Clases::buscaClases();
		require_once('verBotones.php');
	}
	
/* 	function buscaProfesor(){
		$curso = $_POST['curso'];
		$profesL=Clases::buscaProfes($curso);
		require_once('asignarProfe.php');
	} */
	
	function guardarAsignacion($horarios,$curso,$prof){
		/* $curso = $_POST['curso'];
		$profe = $_POST['profesor']; */
		foreach($horarios as $sele){
			//echo $sele.'-'.$curso.'-'.$profe.'<br>';
			Clases::guardarAsigna($sele,$curso,$prof);
			Clases::actualizaHorario($sele,$curso,$prof);
		}
		//require_once('asignarProfe.php');
	}


	function error(){
		require_once('Views/alumno/error.php');
	}

}

if(isset($_POST['func']) && !empty($_POST['func'])) {
	$opcion = $_POST['func'];
	$dato = $_POST['cursoSeleccionado'];
	$usuario = new UsuarioController();

	switch($opcion) {
		case 'obtenerProfess': 
			$usuario->obtenerProfess($dato);		
		break;
	}
}

if(isset($_POST['func2']) && !empty($_POST['func2'])) {
	$opcion = $_POST['func2'];
	$claseSeleccionada = $_POST['cursoSeleccionado'];
	$profeSeleccionado = $_POST['profeSeleccionado'];
	$usuario = new UsuarioController();

	switch($opcion) {
		case 'obtClasesDis':
			$usuario->obtClasesDis($claseSeleccionada,$profeSeleccionado);
		break;
	}
}

if (isset($_POST['horarios']) && !empty($_POST['horarios'])){
	$horarios = $_POST['horarios'];
	$curso = $_POST['curso'];
	$prof = $_POST['profesor'];
	$usuario = new UsuarioController();
	
	$usuario->guardarAsignacion($horarios,$curso,$prof);
	
}


?>