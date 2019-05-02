<?php
$peticion = explode("/",$_GET['peticion']);
$session = $jmyWeb->session(); 
$carga_centro = '';

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
	//$jmyWeb ->pre(['p'=>$usuario,'t'=>'usuario']);
	
}


if($idUsuario!=''){

	if($peticion[0]=='editar'){
		$editar = $jmy->ver([
			"TABLA"=>"citas__agendarcita",
			"ID"=>$peticion[1],

		]);
		$editar = $editar['ot'][$peticion[1]];
		//$jmyWeb ->pre(['p'=>$editar,'t'=>'editar']);
	}

	//$jmyWeb ->pre(['p'=>$peticion[1],'t'=>'editar']);
	$jmyWeb->cargar(["pagina"=>"cita"]);
	$jmyWeb->cargar_js(["url"=>BASE_TEMPLET."js/cita.js?d=".date('U'),"unico"=>true]);
	
	$jmyWeb->cargar_css(["url"=>"http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css","unico"=>true]);
	$jmyWeb->cargar_css(["url"=>"http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css","unico"=>true]);
 

	$jmyWeb ->cargar_vista([
		"url"=>"cita.php",
		"data"=>[
			"id_perfil"=>($peticion[1]!='')?$peticion[1]:$idUsuario,
			"editar"=>$editar,
		]
	]);
}else{
	$jmyWeb->cargar(["pagina"=>"iniciocita"]);
	$jmyWeb ->cargar_vista(["url"=>"iniciocita.php"]);
}

?> 