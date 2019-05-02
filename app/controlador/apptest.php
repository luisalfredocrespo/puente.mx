<?php
$peticion = explode('/',$peticion);
$id = '5ba3d6922361d';
$out=[

	"GET"=>$get,
	"_POST"=>$_POST,
	
	"db"=>$jmy->db(["productos_test"]),
	
					 
	"guardar"=>$jmy->guardar([	"TABLA"=>"productos_test", // STRING
								"ID"=>$id, // Array
								"A_D"=>TRUE, // Sirve para agregar columnas
								"GUARDAR"=>[
									"edad"=>"12",
									"nombre"=>"Juan",

								],
					]),
	
	"ver"=>$jmy->ver([	"TABLA"=>"productos_test", // STRING
						"COL"=>["edad","nombre"], // ARRAY OPCIONAL
						"ID"=>[$id], // STRING OPCIONAL
						//"V"=>[5,6], // ARRAY OPCIONAL
						//"ID_S"=>[0,1], // ARRAY OPCIONAL
						//"LIKE_V"=>["ola","k ase"], // ARRAY OPCIONAL
						//"LIKE_V_OPER"=>"AND" // STRING OPCIONAL
					]),				
				
	"borrar"=>$jmy->borrar([	"TABLA"=>"productos_test", // STRING
								"COL"=>["edad"], // ARRAY 
								"ID"=>[$id], // STRING 
					]),
	"ver2"=>$jmy->ver([	"TABLA"=>"productos_test", // STRING
						//"ID_D"=>["NOMBRE","APELLIDO","SEXO","SEXO"], // ARRAY OPCIONAL
						"ID"=>[$id], // STRING OPCIONAL
						//"ID_V"=>[5,6], // ARRAY OPCIONAL
						//"ID_S"=>[7,8], // ARRAY OPCIONAL
						//"LIKE_V"=>["angora","luciernaga"], // ARRAY OPCIONAL
						//"LIKE_V_OPER"=>"AND" // STRING OPCIONAL
					])
					
];
echo json_encode($out); 