<?php 


$_POST=[
	"nombre"=>"juanito",
	"telefono"=>"55555",
	"email"=>"j.martinezperez@hotmail.com",

];

//$jmyWeb ->pre(["p"=>$_POST]);
$estado = "enviando";
if(	$_POST['nombre']!='' &&
	$_POST['telefono']!='' &&
	$_POST['email']!='' 
 ){
	/*
	$para = 'ventas@gurteltier.com.mx';
	$nombre = $_POST['nombre'];
	$mail = $_POST['email'];
	$mensaje = $_POST['mensaje'];
	$contenido = "Nombre: " . $nombre . "\nCorreo: " . $correo ."\nmensaje" . $mensaje;
	$cabeceras = 'From: ventas@gurteltier.com.mx' . "\r\n" .
    'Reply-To: ventas@gurteltier.com.mx' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	mail($destino,"Contacto desde la web - ".$_POST['nombre'],$contenido,$cabeceras);
	$mensaje = "Gracias por contactarnos";
	$estado = "enviado";
	*/
	
	$to      = 'juancarlos@comsis.mx';
	$subject = "asusnto" ;
	$message = "mensaje" ;
	$header = "From: noreply@templet.comsis.com\r\n"; 
	$header.= "MIME-Version: 1.0\r\n"; 
	$header.= "Content-Type: text/plain; charset=utf-8\r\n"; 
	$header.= "X-Priority: 1\r\n"; 

	mail($to, $subject, $message, $header);
	
	
	
}


$jmyWeb ->pre(['p'=>["mensaje"=>$mensaje,
					 "estado"=>$estado,
					 "POST"=>$_POST
					]


	]);
/*$jmyWeb ->cargar_vista(["url"=>"contacto.php",
						"data"=>[	"mensaje"=>$mensaje,
									"estado"=>$estado
									]
						]);
						*/
?>