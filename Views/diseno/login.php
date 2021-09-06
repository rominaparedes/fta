<head>
	<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
	<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js" ></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
</head>
<style>
.carousel-inner img {
    width: 100%;
    max-height: 600px;
}

.carousel-inner{
 height: 600px;
}
</style>

<?php
//require_once('../../routing.php'); 
session_start();
$resp = $_REQUEST["res"];
$_SESSION['logged_in_user_id'] = $resp;

if ($resp == 1){

?>


<nav class="nav nav-pills nav-justified-center">
	<div class="container" id ="container_admin" style="display: yes;border=1px">
		<table>
			<tr>
				<td>
					<form class="form-inline" action="../../routing.php?controller=alumno&action=buscar&resp=<?=$resp?>" method="post">
						<div class="form-group row">
							<div class="col-xs-4">
								<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-search"> </span> Ingresar Cursos</button>
							</div>
						</div>
					</form>
				</td>
				<td>&nbsp;</td>
				<td>
					<form class="form-inline" action="../../routing.php?controller=alumno&action=obtenerProfes&resp=<?=$resp?>" method="post">
						<div class="form-group row">
							<div class="col-xs-4">
								<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-transfer"> </span> Asignar Cursos</button>
							</div>
						</div>
					</form>
				</td>
				<td>&nbsp;</td>
				<td>
					<form class="form-inline" action="../../routing.php?controller=alumno&action=obtenerAlumnos&resp=<?=$resp?>" method="post">
						<div class="form-group row">
							<div class="col-xs-4">
								<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-list-alt"> </span> Registro de Boletas</button>
							</div>
						</div>
					</form>
				</td>
				<td>&nbsp;</td>
				<td>
					<form class="form-inline" action="../../routing.php?controller=alumno&action=detAsis" method="post">
						<div class="form-group row">
							<div class="col-xs-4">
								<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-list-alt"> </span> Detalle de Asistencias por Mes</button>
							</div>
						</div>
					</form>
				</td>
				<td>&nbsp;</td>
				<td>
					<form class="form-inline" action="../../routing.php?controller=alumno&action=obtenerReservas" method="post">
						<div class="form-group row">
							<div class="col-xs-4">
								<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-time"> </span> Ver Reservas al dia</button>
							</div>
						</div>
					</form>
				</td>
				<td>&nbsp;</td>
				<td >
					<form class="form-inline" action="../../routing.php?controller=alumno&action=cerrarSession" method="post" >
					<div class="form-group row">
						<div class="col-xs-4">
							<button  type="submit" class="btn btn-dark" ><span class="glyphicon glyphicon-time"> </span> Cerrar Sesión</button>
							</div>
						</div>
					</form>
				</td>
			</tr>
		</table>
	
		<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="..." >
				</div>
				<div class="carousel-item">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="..." >
				</div>
				<div class="carousel-item">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="...">
				</div>
				<div class="carousel-item">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="...">
				</div>
				<div class="carousel-item">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="...">
				</div>
				<div class="carousel-item">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="...">
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
	</div>
</nav>

<?php
}else{

?>
<div class="container" id ="container_profe" style="display: yes">
	<table>
		<tr>
			<td>
				<form class="form-inline" action="../../routing.php?controller=alumno&action=obtenerReservas" method="post">
					<div class="form-group row">
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-time"> </span> Ver Reservas al dia</button>
						</div>
					</div>
				</form>
			</td>
			<td>&nbsp;</td>
			<td>
				<form class="form-inline" action="../../routing.php?controller=alumno&action=cerrarSession" method="post">
                    <button type="submit" class="btn btn-dark" ><span class="glyphicon glyphicon-time"> </span> Cerrar Sesión</button>
                </form>
			</td>
		</tr>
	</table>
	<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="..." >
				</div>
				<div class="carousel-item">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="..." >
				</div>
				<div class="carousel-item">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="...">
				</div>
				<div class="carousel-item">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="...">
				</div>
				<div class="carousel-item">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="...">
				</div>
				<div class="carousel-item">
				  <img src="../img/img_grande_fta.png" class="d-block" alt="...">
				</div>
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			</button>
		</div>
</div>
<?php
}		
?>



