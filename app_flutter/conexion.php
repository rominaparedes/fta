<?php

$connect = new mysqli("localhost", "root","","bd_fta");

if($connect){
	
}else{
	echo "Fallo en la conexion";
	exit();
}

?>