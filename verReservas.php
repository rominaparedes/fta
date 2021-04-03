<form id = "frmAsignacion">
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
							<td><div id="cursos" class="form-check form-check-inline">
							  <input class="form-check-input" type="radio" id="curso_r" name="curso_r" value="<?php  echo $cla['ID_CURSO']?>">
							  <label class="form-check-label" for="curso_r"><?php echo $cla['NOMBRE_CURSO'] ?></label>
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
	<div class="container" id ="mostrarDatos" style="display:none">
		<table class="table table-striped" align ="center" >
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col" align="center">Nombre Alumno</th>
			  <th scope="col" align="center">Fecha</th>
			  <th scope="col" align="center">Hora</th>
			  <th scope="col" align="center">Estado Cupo</th>
			  <th scope="col" align="center" >Profesor</th>
			</tr>
		  </thead>
		  <tbody>
		  </tbody>
		</table>
	</div>
</form>

<script type="text/javascript">


$(document).on('click', '#curso_r', function(event) {
		$("#mostrarDatos tbody").html("");  
		var i =1;  
		var estado = "";
		var newRow="";
		var cursoSeleccionado= $(this).val();
		$.ajax({
			type: 'post',
			url: 'Controllers/alumnoController.php',
			dataType: 'json',
			data:  {func1: 'buscaReservas', cursoSeleccionado: cursoSeleccionado},
			beforeSend:function(){
					$('#mostrarDatos').show();
				},
			success:function(respuesta2){
					console.log(respuesta2);
					$.each(respuesta2, function(index, value){
						if (value.ESTADO == "A" ){
							estado = "<font color='green'><strong>Activo</strong></font>";							
						}else{
							estado = "<font color='red'><strong>Cancelado</strong></font>";	
						}
						newRow =
						"<tr>"
						+"<td>"+i+"</td>"
						+"<td>"+value.NOMBRE+" "+value.APELLIDO_P+" "+value.APELLIDO_M+"</td>"
						+"<td>"+value.FECHA+"</td>"
						+"<td>"+value.INICIO+" - "+value.TERMINO+"</td>"
						+"<td>"+ estado+"</td>"
						+"<td>"+value.PROFE+"</td>"
						+"</tr>";
						$(newRow).appendTo("#mostrarDatos tbody");
						i++;

					});
					
				},
			error:function(respuesta2){
					console.log("malo");
					$.each(respuesta2, function(index, value){		
						console.log(value);

					});
				}
		});
	});
</script>