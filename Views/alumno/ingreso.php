<!DOCTYPE html>

<html lang="es">
<?php

?>
	<!--<form action="Views/diseno/login.php" method="post">-->
	<!--<div class="alert alert-success" id="alert" style="display: none;">&nbsp;</div>-->
		<!--<form method="post" id="validaUsuario">-->
				<div class="login" id="login" style="display: yes">
					<table>

						<h3 class="text-center text-info">Acceso a Sistema FTA</h3>
						<div class="form-group">
							<label class="text-info" for="rut2">Ingresa tu RUT:</label><br>
							<input type="text" class="form-control" id="rut" placeholder="sin puntos, guiones ni DV" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
						</div>
						<div class="form-group">
							<label for="password2" class="text-info">Ingresa tu contraseña:</label><br>
							<input type="text" id="password" class="form-control" required>
						</div>
						<div class="form-group">
							<input id = "consultar" name="consultar" class="btn btn-primary" value="Entrar" onclick="entrar()">
							<!--<button type="submit" id="botonenviar">Entrar</button>-->
						</div>

					</table>
				</div>	
	<!--</form>-->
</html>

 <script>
 
/*   $(document).ready(function() {
  //$("#validaUsuario").validate();
    $("#botonenviar").click( function() {
	  rut = $('#rut').val();
	  pass = $('#password').val();
		$.ajax({
			type: "POST",
			url:"diseno/login.php",
			data: "rut="+rut+"&pass="+password,
			success: function(msg){
				$("#alert").html(msg);
			 }
		});
	  
	});
});  */
	var rut=0;
	var pass='';



function entrar(){

	//$('#login').hide();
	rut = $('#rut').val();
	pass = $('#password').val();

	$.ajax({
		type: 'post',
		url: 'Controllers/alumnoController.php',
		dataType: 'json',
		data:  {func01: 'existeUsuario', rutUsuario:rut,passUsuario: pass},
		beforeSend:function(){				
		},
		success:function(respuesta){
			//alert(respuesta);
			if(respuesta > 0 ){
					
					$.ajax({
						type: 'post',
						url: 'Controllers/alumnoController.php',
						dataType: 'json',
						data:  {func02: 'obtPerfil', rutUsuario2: rut, passUsuario2: pass},
						beforeSend:function(res){		
						},
						success:function(res){	
							$(location).attr('href','Views/diseno/login.php?res='+res);
						},
						error:function(res){
							console.log(res);
						}
					});		
			}else {
				alert('Usuario no registrado o datos ingresados son incorrectos');
				//$('#login').show();
			}
			
		},
		error:function(respuesta){
			console.log(respuesta);
		}
	});

}





</script>