<?php 
	// $jmy->db(['habitacion']);

	switch ($_GET['peticion']) {
		case 'numeroHabitacion':
			$out['numero'] = $jmy->ver([
				"TABLA"=>"habitacion",
				"COL"=>["num_habitacion"],
				"V"=>[$_POST["NumeroHabitacion"]["habi"]],
				"SALIDA"=>"ARRAY"
			]);
		break;
		case 'guardar':

			$out['habitacion'] = $jmy->guardar([
			"TABLA"=>"habitacion",
			"A_D"=>true,
			"GUARDAR"=>['num_habitacion'=>$_POST["datohabitacion"]["num"],
						'habitacion'=>$_POST["datohabitacion"]["habitacion"],
						'complementos'=>$_POST["datohabitacion"]["complementos"],
						'precio'=>$_POST["datohabitacion"]["precio"],
						]
			]);
		break;
		
		default:
			
			break;
	}

echo json_encode(['POST'=>$_POST,'GET'=>$_GET,'out'=>$out]);

