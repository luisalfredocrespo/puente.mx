<?php
$peticion = explode("/",$_GET['peticion']);
$session = $jmyWeb->session();
$idUsuario = $session['user']['user_id'];

if($peticion[0]=='entrar'){
	$session = $jmyWeb->session([$peticion[1],$peticion[2]]);
	$jmyWeb->guardar_session();//$jmyWeb->guardar_session(["instalar"=>true]);

	$usuario = $jmy->ver([
		"TABLA"=>"clientes_".$session['body']['api_web']['ID_F'],
		"ID"=>$idUsuario
		]);
	if($usuario['ot'][$idUsuario]['perfil_principal']==''){
		$jmy->guardar([
			"TABLA"=>"clientes_".$session['body']['api_web']['ID_F'],
			"ID"=>$idUsuario,
			"A_D"=>true,
			"GUARDAR"=>['perfil_principal'=>$idUsuario],
		]);
	}
}
if ($idUsuario != ''){
	$jmyWeb->cargar(["pagina"=>"habitacion"]);
	$jmyWeb->cargar_js(["url"=>BASE_TEMPLET."js/habitacion.js?d=".date('U'),"unico"=>true]);
	$jmyWeb ->cargar_vista([	
		"url"=>"habitacion.php",
		"data"=>[
			"id_perfil"=>($peticion[1]!='')?$peticion[1]:$idUsuario,
			"editar"=>$editar,
		]
	]);
}else{
	$jmyWeb->cargar(["pagina"=>"iniciohabitacion"]);
	$jmyWeb ->cargar_vista(["url"=>"iniciohabitacion.php"]);
}