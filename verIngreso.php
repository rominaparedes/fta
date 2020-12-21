<!--<form action="?controller=alumno&action=verTodos" method="post">-->
	<div class="bootstrap-iso">
		<h2>Ingresos</h2>
		<hr style="color: #0056b2;" />
		<table class="table table-striped" border ='0'>
			<thead>
				<tr>
				<th scope="col">#</th>
				<th scope="col">Fecha</th>
				<th scope="col">Hora</th>
				<th scope="col">Días</th>
				<th scope="col">Cupos</th>
				<th scope="col">Estado</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				echo $r = count($lc);
				foreach ($lc as $row4) {
					$fc = $row4['FECHA_INICIO'];
					$fh = $row4['FECHA_FIN'];
					$hd = $row4['HR_INICIO'];
					$hh = $row4['HR_FIN'];
					$d = $row4['DIAS'];
					$c = $row4['CUPOS'];?>

				<tr>
					<th scope="row">1</th>
					<td><? =$fc?> a <? echo $fh?></td>
					<td><? echo $hd?> a <? echo $hh?></td>
					<td><? echo $d?></td>
					<td><? echo $c?></td>
					<td>
						<div class="custom-control custom-switch">
						<input type="checkbox" class="custom-control-input" id="customSwitch1">
						<label class="custom-control-label" for="customSwitch1"></label>
						</div>
					</td>
				</tr>

				<?php } ?>	
			</tbody>
		</table>
	</div>
<!--</form>-->