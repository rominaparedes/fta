<?php
$opc = $_REQUEST['opcion'];

if ($opc == 1){

?>


<div class="container_admin" id ="container_admin">
	<table>
		<tr>
			<td>
				<form class="form-inline" action="?controller=alumno&action=buscar" method="post">
					<div class="form-group row">
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-search"> </span> Ingresar Cursos</button>
						</div>
					</div>
				</form>
			</td>
			<td>&nbsp;</td>
			<td>
				<form class="form-inline" action="?controller=alumno&action=obtenerProfes" method="post">
					<div class="form-group row">
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-transfer"> </span> Asignar Cursos</button>
						</div>
					</div>
				</form>
			</td>
			<td>&nbsp;</td>
			<td>
				<form class="form-inline" action="?controller=alumno&action=obtenerAlumnos" method="post">
					<div class="form-group row">
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-list-alt"> </span> Registro de Boletas</button>
						</div>
					</div>
				</form>
			</td>
			<td>&nbsp;</td>
			<td>
				<form class="form-inline" action="?controller=alumno&action=detAsis" method="post">
					<div class="form-group row">
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-list-alt"> </span> Detalle de Asistencias por Mes</button>
						</div>
					</div>
				</form>
			</td>
			<td>&nbsp;</td>
			<td>
				<form class="form-inline" action="?controller=alumno&action=obtenerReservas" method="post">
					<div class="form-group row">
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-time"> </span> Ver Reservas al dia</button>
						</div>
					</div>
				</form>
			</td>
		</tr>
	</table>
</div>

<?php  }else if ($opc == 2 ){ ?>
<div class="container_profe" id ="container_profe">
	<table>
		<tr>
			<td>
				<form class="form-inline" action="?controller=alumno&action=obtenerReservas" method="post">
					<div class="form-group row">
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-time"> </span> Ver Reservas al dia</button>
						</div>
					</div>
				</form>
			</td>
		</tr>
	</table>
</div>
<?php } ?>