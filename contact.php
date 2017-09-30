<?php
	

	// Cuerpo del mensaje
	$mensaje = "------------------------------------------------------------------ \n";
	$mensaje.= "                    Formulario General               \n";
	$mensaje.= "------------------------------------------------------------------ \n";
	
	$mensaje.= "\n\n";
	$mensaje.= "\nDe: ". $_POST['nombre'];
	$mensaje.= "\nTelefono: ". $_POST['telefono'];
	$mensaje.= "\nE-mail: ". $_POST['email'];
	
	$mensaje.= "\n\n";
	$mensaje.= $_POST['mensaje']."\n\n";
	$mensaje.= "------------------------------------------------------------------ \n";
	$mensaje.= "Enviado desde http://sanjorgesuspension.com.ar\n";
	
	
	$destino= "info@sanjorgesuspension.com.ar";
	$remitente= 'From:'.$_POST['email'];
	$asunto= "Contacto General: ".$_POST['nombre'];
	mail($destino,$asunto,$mensaje,$remitente);
	
	
	
	//Mensaje que se mostrara al realizar el envio
	
	echo "Mensaje enviado. Gracias por contactarse.";

?>