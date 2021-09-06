<?php
session_start();
$resp=0;
$res = $_SESSION['logged_in_user_id'];
?>

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
<!--<div class="container" id ="container_admin">-->
	<!--<form action="?controller=alumno&action=guardar" method="post">-->
	<form id = "frmGuardar" method="post">
		<div class="container">
			<table class="table table-striped" align ='center'>
				<thead>
					<tbody>
						<div class="form-group row">
							<div class="col-3">
								<tr>
								<?php 
								foreach ($clases as $cla){
										?> 
								<td><div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" id="curso" name="curso" value="<?php  echo $cla['ID_CURSO']?>">
								  <label class="form-check-label" for="curso"><?php echo $cla['NOMBRE_CURSO'] ?></label>
								</div></td>
								<?php
								} ?>
								</tr>
							</div>
						</div>
					</tbody>
				</thead>
			</table>			
		</div>

		<div class="container">	
			<div class="bootstrap-iso">
				<h2>Fechas y Horas</h2>
				<hr style="color: #0056b2;" />
				<table class="table table-striped">
					
					<tr>
						<td>
							<div class="form-group row">
							  <label for="example-date-input" class="col-3 col-form-label">Fecha Desde</label>
							  <div class="col-5">
								<input class="form-control" type="date" value="2020-12-09" id="fcDesde" name="fcDesde">
							  </div>
							</div>
						</td>
						<td>
							<div class="form-group row">
							  <label for="example-date-input" class="col-3 col-form-label">Fecha Hasta</label>
							  <div class="col-5">
								<input class="form-control" type="date" value="2020-12-09" id="fcHasta" name="fcHasta">
							  </div>
							</div>				
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group row">
								<label for="default-picker" class="col-3 col-form-label">Hora Desde</label>
								<div class="col-5">
									<input type="time" id="hrDesde" name="hrDesde" class="form-control" placeholder="Select time">
								</div>
							</div>
						</td>
						<td>
							<div class="form-group row">
								<label for="default-picker" class="col-3 col-form-label">Hora Hasta</label>
								<div class="col-5">
									<input type="time" id="hrHasta" name="hrHasta" class="form-control" placeholder="Select time">
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
			<div class="bootstrap-iso" >
				<h2>Días de la Semana</h2>
				<hr style="color: #0056b2;" />
				<div class="col-sm-15">
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="checkbox" id="dias" name="dias[]" value="1">
					  <label class="form-check-label" for="dias">Lunes</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="checkbox" id="dias" name="dias[]" value="2">
					  <label class="form-check-label" for="dias">Martes</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="checkbox" id="dias" name="dias[]" value="3" >
					  <label class="form-check-label" for="dias">Miércoles</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="checkbox" id="dias" name="dias[]" value="4">
					  <label class="form-check-label" for="dias">Jueves</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="checkbox" id="dias" name="dias[]" value="5">
					  <label class="form-check-label" for="dias">Viernes</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="checkbox" id="dias" name="dias[]" value="6" >
					  <label class="form-check-label" for="dias">Sábado</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="checkbox" id="dias" name="dias[]" value="7" >
					  <label class="form-check-label" for="dias">Domingo</label>
					</div>
				</div>
			</div>
			<div class="bootstrap-iso">
				<h2>Cupos</h2>
				<hr style="color: #0056b2;" />
				<div class="form-group row">
				  <div class="col-2">
					<input class="form-control" type="number" value="1" id="cupos" name="cupos">
				  </div>
				</div>
				<button id = "ingresar" type="submit" class="btn btn-primary">Ingresar</button>
				<input type="button" class="btn btn-primary" onclick="history.back()" name="Volver" value="Volver">
			</div>	
		</div>
	</form>
<!--</div>-->

<script>

$(document).ready(function(){
  $("#ingresar").click(function(){
    var formulario = $("#frmGuardar").serializeArray();
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: 'Controllers/alumnoController.php',
      data: formulario,
	  beforeSend:function(){
				alert('Información Guardada');
				},
			success:function(respuesta){
				alert('Información Guardada');
			},
			error:function(respuesta){
					console.log(respuesta);
				}
    })
  });
}); 
  
</script>

