<?php 
$controller = $_REQUEST["controller"];
$action = $_REQUEST["action"];

$controllers=array(
	'alumno'=>['index','error','buscar','guardar','verTodos','obtenerProfes','guardarAsignacion','buscaProfesor','obtenerReservas','registrarAlumno','obtenerAlumnos','detAsis','cerrarSession']
);


if (array_key_exists($controller,  $controllers)) {
	if (in_array($action, $controllers[$controller])) {
		call($controller, $action);
		
	}
	else{
		call('alumno','error');
	}		
}else{
	call('alumno','error');
}

function call($controller, $action){
	require_once('Controllers/'.$controller.'Controller.php');

	switch ($controller) {
		case 'alumno':
		require_once('Model/alumno.php');
		$controller= new UsuarioController();
		break;			
		default:

		break;
	}
	$controller->{$action}();
}

?>