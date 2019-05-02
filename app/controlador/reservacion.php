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

if ($idUsuario != '') {
	$jmyWeb->cargar(["pagina"=>"reservacion"]);
	$jmyWeb->cargar_js(["url"=>BASE_TEMPLET."js/reservacion.js?d=".date('U'),"unico"=>true]);
	$jmyWeb ->cargar_vista([	
		"url"=>"reservacion.php",
		"data"=>[
			"id_perfil"=>($peticion[1]!='')?$peticion[1]:$idUsuario,
			"editar"=>$editar,
		]
	]);
}else{
	$jmyWeb->cargar(["pagina"=>"inicioreservacion"]);
	$jmyWeb ->cargar_vista(["url"=>"inicioreservacion.php"]);
}