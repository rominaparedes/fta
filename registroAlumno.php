<form action="?controller=alumno&action=guardar" method="post">

	<div class="container">	
		<div class="bootstrap-iso">
			<h2>Ingreso de Alumnos</h2>
			<table class="table table-striped">				
				<tr>
					<td>
						<div class="form-group row">
						  <label for="rut" class="col-4 col-form-label">Rut Alumno</label>
						  <div class="col-3">
							<input class="form-control" type="text" id="rut" name="rut_alumno">
						  </div>
						</div>
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<div class="form-group row">
						  <label for="nombre" class="col-4 col-form-label">Nombre Alumno</label>
						  <div class="col-5">
							<input class="form-control" type="text" id="nombre" name="nom_alumno">
						  </div>
						</div>				
					</td>
					<td>
						<div class="form-group row">
						  <label for="paterno" class="col-4 col-form-label">Apellido Paterno</label>
						  <div class="col-5">
							<input class="form-control" type="text" id="apellido_p" name="pat_alumno">
						  </div>
						</div>				
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group row">
						  <label for="materno" class="col-4 col-form-label">Apellido Materno</label>
						  <div class="col-5">
							<input class="form-control" type="text" id="apellido_m" name="mat_alumno">
						  </div>
						</div>				
					</td>
					<td>
						<div class="form-group row">
						  <label for="nacimiento" class="col-4 col-form-label">Fecha de Nacimiento</label>
						  <div class="col-5">
							<input class="form-control" type="date" value="2020-12-09" id="nacimiento" name="nac_alumno">
						  </div>
						</div>				
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group row">
						  <label for="fono" class="col-4 col-form-label">Fono</label>
						  <div class="col-4">
							<input class="form-control" type="text" id="fono" name="fono_alumno">
						  </div>
						</div>				
					</td>
					<td>
						<div class="form-group row">
						  <label for="email" class="col-4 col-form-label">Email</label>
						  <div class="col-7">
							<input class="form-control" type="text" id="email" name="email_alumno">
						  </div>
						</div>				
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group row">
						  <label for="direccion" class="col-4 col-form-label">Dirección</label>
						  <div class="col-8">
							<input class="form-control" type="text" id="direccion" name="dir_alumno">
						  </div>
						</div>				
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>
						<div class="form-group row">
						  <label for="edad" class="col-4 col-form-label">Edad</label>
						  <div class="col-2">
							<input class="form-control" value="0" type="text" id="edad" name="edad_alumno">
						  </div>
						</div>				
					</td>
					<td>
						<div class="form-group row">
						  <label for="peso" class="col-4 col-form-label">Peso</label>
						  <div class="col-2">
							<input class="form-control" value="0" type="text" id="peso" name="peso_alumno">
						  </div>
						</div>				
					</td>
				</tr>
				<tr>
					<td>
						<div class="form-group row">
						  <label for="estatura" class="col-4 col-form-label">Estatura</label>
						  <div class="col-3">
							<input class="form-control" value="0" type="text" id="estatura" name="est_alumno">
						  </div>
						</div>				
					</td>
					<td>
						<div class="form-group row">
							<label for="sexo" class="col-4 col-form-label">Sexo</label>
							<div class="col-7">
								<input type="radio" id="sexo_f" name="sexo_f_alumno" value="f">
								<label for="sexo_f"> 	Femenino</label><br>
								<input type="radio" id="sexo_m" name="sexo_m_alumno" value="m">
								<label for="sexo_m"> 	Masculino</label>
							</div>
						</div>

					</td>
				</tr>
			</table>
		</div>
		
		<div class="bootstrap-iso">
			<button type="submit" class="btn btn-primary">Ingresar Alumno</button>
		</div>	
	</div>
</form>

