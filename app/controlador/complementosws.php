<?php

// $jmy->db(['complemento']);
// 
switch ($_GET['peticion']) {
	case 'guardar':
		$out['complemento'] = $jmy->guardar([
			"TABLA"=>"complemento",
			"A_D"=>true,
			"GUARDAR"=>['complemento'=>$_POST["datosComplemento"]["complemento"]]
		]);
		break;
	case 'mostrar':
		$out = $jmy->ver([
			"TABLA"=>"complemento",
			"SALIDA"=>"ARRAY"
		]);
		break;
	
	default:
		# code...
		break;
}


echo json_encode(['POST'=>$_POST,'GET'=>$_GET,'out'=>$out,'respuesta'=>$respuesta]);

?>