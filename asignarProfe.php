<form id = "frmAsignacion">
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
								<div id="profesores" disabled class="form-group col-md-4">
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
								<div class="form-group col-md-4">
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
		<button id = "asociar" type="submit" class="btn btn-primary">Asociar</button>
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
    }).done(function(respuesta){
      console.log(respuesta);
    });
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