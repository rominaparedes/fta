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
	<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
</head>

<style type="text/css">
body {
  etica, sans-serif;
  margin: 0;
  padding: 0;
  color: #333;
  background-color: #fff;
}
</style>
<?php
setlocale(LC_TIME, "spanish");
$mesActual =  strftime("%B");
?>

<br>

<div class="container" id ="mostrarDatosAsistencia" style="display:none">
	<table class="table table-striped" align ="center" id="miTabla">
		<h1 style="text-align:center;"> Detalle de asistencias para el mes de <?php echo ucwords($mesActual) ?></h1>       
		<thead>
			<tr>
			  <th scope="col" align="center">Rut Alumno</th>
			  <th scope="col" align="center">Nombre Alumno</th>
			  <th scope="col" align="center">Cantidad de clases pagadas</th>
			  <th scope="col" align="center">Cantidad de clases asistidas</th>
			  <th scope="col" align="center">Curso</th>
			  <th scope="col" align="center">Días Asistidos</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<input type="button" class="btn btn-primary" onclick="history.back()" name="Volver" value="Volver">
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dias asistidos <?php ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table" id="tabla" align ="center">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col" align="center">Fecha asistencia</th>
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


<script type="text/javascript">



	
$(document).ready(function(){
	

	
	var i =1; 
	var estado = "";
	var newRow="";
	var newRowModal="";
	
dataTable = $('#miTabla').DataTable( {
	ajax: {
		url: 'Controllers/alumnoController.php',
		type: 'POST',
		data: { 
			funcC : 'detalleAsis' 
		},
		beforeSend:function(){
			$('#mostrarDatosAsistencia').show();
		},
		error:function(respuesta3){
			console.log(respuesta3);
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
		{ data : 'RUT_PERSONA' },
		{ data : 'NOMBRE_PERSONA' },
		{ data : 'CANTIDAD_CLASES' },
		{ data : 'ASISTIDAS' },
		{ data : 'NOMBRE_CURSO' },
		{ data : 'boton' },
	],
	rowCallback: function (row,data, index){
		var totalC = data.CANTIDAD_CLASES - data.ASISTIDAS;
		if (totalC <= 0 ){
			$('td', row).css('background-color', '#ff9090');
		}else if(totalC>0 && totalC <=2){
			$('td', row).css('background-color', '#ffd632');
		}else {
			$('td', row).css('background-color', '#add65b');			
		}		
	},
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

	

	

});

function verDetalle(rut,curso){

	var j = 1;
	
	newRowModal="";
	
	$.ajax({
		type: 'post',
		url: 'Controllers/alumnoController.php',
		dataType: 'json',
		data:  {funcM: 'detalleHoras', alum: rut, id_c:curso},
		beforeSend:function(){
			$('#exampleModal').show();
		},
		success:function(respuesta5){
			$.each(respuesta5, function(index, value){
				newRowModal = 
				"<tr>"
				+"<td>"+j+"</td>"
				+"<td>"+value.FECHA_RESERVA+"</td>"
				+"</tr>";
				$(newRowModal).appendTo("#exampleModal tbody");
				j++;
			});
			
			
		},
		error:function(respuesta5){
			console.log('aaaaaa');
		}
		
	});
	$('#exampleModal tbody').html("");
	
}

</script>