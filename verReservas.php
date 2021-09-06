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
	<div class="container" style="display:none;align:center" id="consultaHora">	
		<table align="center">		
			<tr>
				<td>
					<div class="form-row align-items-center">
						<div class="col-auto my-1">
							<label for="example-date-input">Fecha </label>
							<input class="form-control" type="date" value="2021-07-28" id="fecha" name="fcDesde">
						</div>
						<div class="col-auto my-1">
							<label for="example-date-input">Hora </label>
							<select id = "hora" class="form-select" aria-label="Default select example">
							  <option selected>Seleccione una hora</option>
							  <option value="00:00">00:00</option>
							  <option value="01:00">01:00</option>
							  <option value="02:00">02:00</option>
							  <option value="03:00">03:00</option>
							  <option value="04:00">04:00</option>
							  <option value="05:00">05:00</option>
							  <option value="06:00">06:00</option>
							  <option value="07:00">07:00</option>
							  <option value="08:00">08:00</option>
							  <option value="09:00">09:00</option>
							  <option value="10:00">10:00</option>
							  <option value="11:00">11:00</option>
							  <option value="12:00">12:00</option>
							  <option value="13:00">13:00</option>
							  <option value="14:00">14:00</option>
							  <option value="15:00">15:00</option>
							  <option value="16:00">16:00</option>
							  <option value="17:00">17:00</option>
							  <option value="18:00">18:00</option>
							  <option value="19:00">19:00</option>
							  <option value="20:00">20:00</option>
							  <option value="21:00">21:00</option>
							  <option value="22:00">22:00</option>
							  <option value="23:00">23:00</option>
							</select>
						</div>

						<div class="form-row align-items-center">
							<div class="col-auto my-1">
								<input id= "consulta" name="consulta" class="btn btn-primary" value="Consultar" onclick="buscar()">
							</div>
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div class="container" id ="mostrarDatos2" style="display:none">
		<table class="table table-striped" align ="center" id="miTabla2" >
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col" align="center" >Profesor</th>
			  <th scope="col" align="center">Fecha</th>
			  <th scope="col" align="center">Hora</th>
			  <th scope="col" align="center">Inscritos</th>
			  <th scope="col" align="center">Vacantes</th>		
			  <th scope="col" align="center">Asistencia</th>			  
			</tr>
		  </thead>
		  <tbody>
		  </tbody>		  
		</table>
		<input type="button" class="btn btn-primary" onclick="history.back()" name="Volver" value="Volver">
	</div>
	<div class="container" id ="mostrarDatos3" style="display:none">
		<table class="table table-striped" align ="center" id="miTabla2" >
		  <thead>
			<tr>
			  <th scope="col">#</th>
			  <th scope="col" align="center" >Profesor</th>
			  <th scope="col" align="center">Fecha</th>
			  <th scope="col" align="center">Hora</th>
			  <th scope="col" align="center">Inscritos</th>
			  <th scope="col" align="center">Vacantes</th>		
			  <th scope="col" align="center">Asistencia</th>			  
			</tr>
		  </thead>
		  <tbody>
			<tr>
				<td >No se encontraron resultados</td>	
				<td ></td>
				<td ></td>
				<td ></td>
				<td ></td>
				<td ></td>
				<td ></td>
			</tr>
		  </tbody>
		</table>
		<input type="button" class="btn btn-primary" onclick="history.back()" name="Volver" value="Volver">
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Alumnos asistentes <?php ?></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">
			<table class="table" id="tabla" align ="center">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col" align="center">Nombre de Alumno</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		  </div>
		</div>
	  </div>
	</div>
	

</form>

<script>

var cursoSeleccionadoS;

$(document).on('click', '#curso_r', function(event) {
	
	
	cursoSeleccionadoS= $(this).val();

	$('#consultaHora').show();
	
	if ($("#mostrarDatos2 tbody").html("") != ""  ){
		$('#mostrarDatos2').hide();	
		$('#mostrarDatos3').hide();		
		$("#hora").val("");
	}
		
});

/*function ver(){

		var fechaS = $("#fecha").val();
		var horaS = $("#hora").val()
	
		
var parametros=[{func1:'buscaReservas', cursoSeleccionado:cursoSeleccionadoS, fecha:fechaS, hora: horaS}];
		
		console.log(parametros);

	dataTable = $('#miTabla2').DataTable( {
		ajax: {
			url: 'Controllers/alumnoController.php',
			type: 'POST',
			data: { parametros },
			beforeSend:function(json){
				$('#mostrarDatos2').show();
			},
			error:function(jqXHR, textStatus, errorThrown){
				console.log(textStatus + " in pushJsonData: " + errorThrown + " " + jqXHR);
			}
		},
		language: {
			sProcessing: 'Procesando...',
			sLengthMenu: 'Mostrar _MENU_ registros',
			sZeroRecords: 'No existen datos para mostrar',
			sEmptyTable: 'No existen datos para mostrar',
			sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_registros.',
			sInfoEmpty: 'Mostrando resgistros del 0 al 0 de un total de 0 registros',
			sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
			sInfoPostFix: '',
			sSearch: 'Filtrar',
			sUrl:'',
			sInfoThousands: ',',
			sLoadingRecords: '<span class= "progress-description load-text" data-text="Cargando..." style="display:block;margin:50px 0;font-size:1.2em">Cargando..',
			oPaginate: {
				sFirst: '<<',
				sLast: '>>',
				sNext: '>',
				sPrevious: '<'
			},
			oAria: {
				sSortAcending: ': Activar para ordenar la columna de manera ascendente',
				sSortDescending: ': Activar para ordenar la columna de manera descendente'
			}
			
		},
		dom: "lrtip",
		pagingType: "full_numbers",
		responsive: true,
		searching:false,
		bLengthChange: false,
		isDisplayLength: 10,
		pageLength : 10,
		columns: [
			{ data2 : 'PROFE' },
			{ data2 : 'FECHA' },
			{ data2 : 'INICIO' },
			{ data2 : 'CUPOS_VAN' },
			{ data2 : 'DISP' },
			{ data2 : 'boton2' },
		],
		columnsDefs: [
			{targets: 0, searchable:false, orderable: false, responsivePriority: 1, class: 'text-center'},
			{targets: 1, searchable:false, orderable: false, responsivePriority: 2, class: 'text-center'},
			{targets: 2, searchable:false, orderable: false, responsivePriority: 3, class: 'text-center'},
			{targets: 3, searchable:false, orderable: false, responsivePriority: 4, class: 'text-center'},
			{targets: 4, searchable:false, orderable: false, responsivePriority: 5, class: 'text-center'},
			{targets: 5, searchable:false, orderable: false, responsivePriority: 6, class: 'text-center'},
		],
		aaSorting:[],
		initComplete: function (settings, json){
			console.log(json);
		}
		
	});
	
}*/


function buscar(){
	
	var fechaS = $("#fecha").val();
	var horaS = $("#hora").val();
	
	if (horaS == null || horaS =='Seleccione una hora'){
		alert("Seleccione una hora valida");
		return false;
	}

	$("#mostrarDatos2 tbody").html("");  
	var i =1;  
	var estado = "";
	var newRow="";
	
	$.ajax({
		type: 'post',
		url: 'Controllers/alumnoController.php',
		dataType: 'json',
		data:  {func1: 'buscaReservas', cursoSeleccionado: cursoSeleccionadoS, fecha: fechaS, hora: horaS},
		beforeSend:function(){
				console.log("before");
				//$('#mostrarDatos2').show();
				
			},
		success:function(respuesta2){
				console.log(respuesta2);
				//$('#mostrarDatos3').hide();
			
				if (respuesta2 == ""){					
					$('#mostrarDatos3').show();
					return false;
				}else{
					$('#mostrarDatos2').show();
				}

				$.each(respuesta2, function(index, value){					
					newRow =
					"<tr>"
					+"<td>"+i+"</td>"
					+"<td>"+value.PROFE+"</td>"
					+"<td>"+value.FECHA+"</td>"
					+"<td>"+value.INICIO+" - "+value.TERMINO+"</td>"
					+"<td>"+ value.CUPOS_VAN+"</td>"
					+"<td>"+value.DISP+"</td>"
					+"<td><button type='button' onclick = verAlumnos("+value.ID_R+") data-toggle='modal' data-target='#exampleModal' class='btn btn-primary'>Ver Alumnos</button></td>"+
					+"</tr>";
					$(newRow).appendTo("#mostrarDatos2 tbody");
					i++;

				});
				
			},
		error:function(respuesta2){
				console.log("error");
				$.each(respuesta2, function(index, value){		
					console.log(value);

				});
			}
	});
	
	
}

function verAlumnos(valor){

	var j = 1;
	
	newRowModal="";
	
	$.ajax({
		type: 'post',
		url: 'Controllers/alumnoController.php',
		dataType: 'json',
		data:  {funcR: 'detalleHorasAlumno', id_res: valor},
		beforeSend:function(){
			$('#exampleModal').show();
		},
		success:function(respuesta5){
			$.each(respuesta5, function(index, value){
				newRowModal = 
				"<tr>"
				+"<td>"+j+"</td>"
				+"<td>"+value.nombre+"</td>"
				+"</tr>";
				$(newRowModal).appendTo("#exampleModal tbody");
				j++;
			});
			
			
		},
		error:function(respuesta5){
			console.log(respuesta5);
		}
		
	});
	$('#exampleModal tbody').html("");
	
	
}



</script>