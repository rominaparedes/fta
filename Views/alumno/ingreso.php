<!DOCTYPE html>

<html lang="es">
<?php

?>
	
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-secondary text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">

              <h2 class="fw-bold mb-2 text-uppercase">Acceso a Sistema FTA</h2>
              <p class="text-white-50 mb-5">Ingresa tu Rut y Contraseña</p>

              <div class="form-outline form-white mb-4">
                <input type="email" id="rut" class="form-control form-control-lg" onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>
                <label class="form-label" for="typeEmailX">Rut</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" id="password" class="form-control form-control-lg" />
                <label class="form-label" for="typePasswordX" >Contraseña</label>
              </div>

			  <input id = "consultar" name="consultar" class="btn btn-outline-light btn-lg px-5" value="Entrar" onclick="entrar()">

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
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
	
	if(rut ==''){
		alert("Debe ingresar rut");
		$("#rut").focus();
		return false;
	}else if (pass == ''){
		alert("Debe ingresar contraseña");
		$("#password").focus();
		return false;
	}

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
							if (res != 3){
								$(location).attr('href','Views/diseno/login.php?res='+res);
							}else{
								alert('Usted no tiene acceso al sistema');
								rut = $('#rut').val("");
								pass = $('#password').val("");
								return false;
							}
							
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