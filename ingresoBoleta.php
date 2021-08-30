<head>
	<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" ></script>
	<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js" ></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.min.css" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.min.js"></script>
</head>
<form id ="frmAsignacion" method="post">
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
	<div class="container" id ="seleccionAlumnos" style="display:none" >
		<table class="table table-striped" align ='center'>
			<thead>
				<tbody>
					<div class="form-group row">
						<div class="col-3">
							<tr>
								<div id="alumnos" disabled class="form-group col-md-4">
									<label for="exampleFormControlInput1">Seleccione alumno</label>
									<select id="alumno" name="alumno" class="form-control">
									</select>
								</div>
							</tr>
						</div>
					</div>
				</tbody>
			</thead>
		</table>			
	</div>
	<div class="container" id ="ingresoDatos" style="display:none">
		<table class="table table-striped" align ='center'>
			<thead>
				<tbody>
					<tr>
						<div class="form-group row">
							<div class="col-10">
								<div id="boleta1" disabled class="form-group col-md-10">
									<label for="boleta">Nro de Boleta: </label>
									<input type="number" id="boleta" name="boleta"/>
								</div>
							</div>
						</div>						
					</tr>
					<tr>
						<div class="form-group row">
							<div class="col-10">
								<div id="clasesP1" disabled class="form-group col-md-10">
									<label for="clasesP">Cantidad de clases pagadas: </label>
									<input type="number" id="clasesP" name="clasesP"/>
								</div>
							</div>
						</div>						
					</tr>
					<tr>
						<div class="form-group row">
							<div class="col-10">
								<div id="mesP1" disabled class="form-group col-md-10">
									<label for="mesPago">Mes Pago</label>
									<input size="10" type="text" name="mpago" id="mpago" readonly />
								</div>
							</div>
						</div>	
					</tr>
					<tr>
						<div class="form-group row">
							<div class="col-10">
								<div id="envio" disabled class="form-group col-md-10">
									<button id = "ingresar" type="submit" class="btn btn-primary">Ingresar Boleta</button>
								</div>
							</div>
						</div>	
					</tr>
				</tbody>
			</thead>
		</table>	
		
	</div>
	<div id ="sinDatos"></div>
	
	
</form>

<script type="text/javascript">

var cursoSeleccionado1;

  
$(document).on('click', '#curso', function(event) {
	
	cursoSeleccionado1= $(this).val();

	$.ajax({
		type: 'post',
		url: 'Controllers/alumnoController.php',
		dataType: 'json',
		data:  {func3: 'obtenerAlumnos', cursoSeleccionado1: cursoSeleccionado1},
		beforeSend:function(){				
			$('#seleccionAlumnos').show();
			$('#ingresoDatos').show();
		},
		success:function(respuesta){				
			var largo = respuesta.length;
			$('#alumno option').remove();
			if (largo > 0){
				$.each(respuesta, function(index, value){
					$("#alumno").append($("<option>",{
						text : value.NOMBRE, value:value.RUT
					}))
				});
			} else{							
					$('#ingresoDatos').hide();
					$('#seleccionAlumnos').hide();
					sinDatos = '<div class="container" style="display:yes"><table class="table table-striped" align ="center"><thead><tbody><tr><div class="form-group row"><div class="col-10"><div id="alumnos" disabled class="form-group col-md-10"><label for="boleta"><strong>No existen alumnos inscritos para este curso</strong></label></div></div></div></tr></tbody></thead></table></div>';
					$('#sinDatos').append(sinDatos);
					return false;
			}
		},
		error:function(respuesta){
			console.log(respuesta);
		}
	});
		
	$('#sinDatos').html("");
});

$(document).ready(function(){
	$("#mpago").datepicker({
			format: "mm-yyyy",
			minViewMode: "months"
		});
	$("#ingresar").click(function(){
		var cursoSeleccionadoB = cursoSeleccionado1;
		var nroBoleta= $('#boleta').val();
		var cantClases= $('#clasesP').val();
		var mesPagado= $('#mpago').val();
		var alumnoS= $('#alumno').val();
		
		alert(cursoSeleccionadoB+'-'+nroBoleta+'-'+cantClases+'-'+mesPagado+'-'+alumnoS);
		
		
		$.ajax({
			type: 'post',
			url: 'Controllers/alumnoController.php',
			dataType: 'json',
			data:  {func5: 'validaBoleta', msPag:mesPagado,alSel: alumnoS,cursoSel:cursoSeleccionadoB},
			beforeSend:function(){				
			},
			success:function(respuesta){
				console.log(respuesta);
				return false;
				if(respuesta == 0){
					$.ajax({
						type: 'post',
						url: 'Controllers/alumnoController.php',
						dataType: 'json',
						data:  {func4: 'guardarBoleta', nrBoleta: nroBoleta, cantClas: cantClases, msPag:mesPagado,alSel: alumnoS,cursoSel:cursoSeleccionadoB},
						beforeSend:function(){				
							alert('Boleta Guardada');
						},
						success:function(){				
							alert('Boleta Guardada');
						},
						error:function(){
							
						}
					});		
				}else {
					alert('Boleta ya ingresada para el mes seleccionado');
					
				}
			},
			error:function(){
				
			}
		});
		
		
		
	
	});	
	
});
	

</script>