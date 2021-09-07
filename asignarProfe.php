<?php
session_start();

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
<form id = "frmAsignacion" method="post">
	<div class="container">
		<table class="table table-striped" align ='center'>
			<thead>
				<tbody>
					<div class="form-group row">
						<div class="col-3">
							<tr>
							<?php 
							foreach ($clasesDis as $cla){
									?> 
							<td><div id="cursos" class="form-check form-check-inline">
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
	<div class="container" id ="seleccionProfes" style="display:none" >
		<table class="table table-striped" align ='center'>
			<thead>
				<tbody>
					<div class="form-group row">
						<div class="col-3">
							<tr>
								<div id="profesores" disabled class="form-group col-md-6">
									<label for="exampleFormControlInput1">Seleccione profesor</label>
									<select id="profesor" name="profesor" class="form-control">
									</select>
								</div>
							</tr>
						</div>
					</div>
				</tbody>
			</thead>
		</table>			
	</div>
	<div class="container" id ="seleccionHorarios" style="display:none">
		<table class="table table-striped" align ='center'>
			<thead>
				<tbody>
					<div class="form-group row">
						<div class="col-3">
							<tr>
								<div class="form-group col-md-10">
									<label for="exampleFormControlInput1">Seleccione horario</label>
									<select  id = "horarios" name = "horarios[]" multiple class="form-control">
									</select>
								</div>
							</tr>
						</div>
					</div>
				</tbody>
			</thead>
		</table>	
		<input type="hidden" id="res" value="<?php echo $res; ?>">
		<button id = "asociar" type="submit" class="btn btn-primary">Asociar</button>
		<input id = "volver" type="button" class="btn btn-primary" name="Volver" value="Volver">
	</div>
</form>

<script type="text/javascript">


$(document).ready(function(){
  $("#asociar").click(function(){
    var formulario = $("#frmAsignacion").serializeArray();
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: 'Controllers/alumnoController.php',
      data: formulario,
	   beforeSend:function(){
				alert('Asignación Guardada');
				},
			success:function(respuesta){
				alert('Asignación Guardada');
			},
			error:function(respuesta){
					console.log(respuesta);
				}
    })
  });
  
  $("#volver").click(function(){
		  var resp = $('#res').val();
		$(location).attr('href','Views/diseno/login.php?res='+resp);
	  });
}); 
  
  
  
$(document).on('click', '#curso', function(event) {
		var cursoSeleccionado1= $(this).val();
		$.ajax({
			type: 'post',
			url: 'Controllers/alumnoController.php',
			dataType: 'json',
			data:  {func: 'obtenerProfess', cursoSeleccionado1: cursoSeleccionado1},
			beforeSend:function(){
					$('#seleccionProfes').show();
				},
			success:function(respuesta){
				console.log(respuesta);
 					$('#profesor option').remove();
                    $.each(respuesta, function(index, value){
						$("#profesor").append($("<option>",{
							text : value.NOM_PROFESOR, value:value.ID_PROFESOR
						}))
						verClasesDisponibles(cursoSeleccionado1,value.ID_PROFESOR);
					});
					
					
				},
			error:function(respuesta){
					console.log(respuesta);
				}
		});
	});
	
function verClasesDisponibles(cursoSeleccionado1,profeSeleccionado){
	$.ajax({
			type: 'post',
			url: 'Controllers/alumnoController.php',
			dataType: 'json',
			data:  {func2: 'obtClasesDis', cursoSeleccionado1: cursoSeleccionado1, profeSeleccionado:profeSeleccionado},
			beforeSend:function(){
					$('#seleccionHorarios').show();
				},
			success:function(respuesta){
					console.log(respuesta);
					$('#horarios option').remove();
					if (respuesta != null){					
						$.each(respuesta, function(index, value){
							$("#horarios").append($("<option>",{text : value.horas, value: value.id}))
						});  		
						$('#asociar').attr("disabled", false);
					}else {
						alert ("No existen horarios ingresados para la clase seleccionada");	
						$('#asociar').attr("disabled", true);
					}
				},
			error:function(respuesta){
					console.log(respuesta);
				}
	});
	
}
</script>