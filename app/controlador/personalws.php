<?php
$session = $jmyWeb->session();
 
$out['busqueda']=$jmy->ver([	
    "TABLA"=>"personal",
    "LIKE_V"=>$_POST['servicios'],
]);

 $out['resultado']=$jmy->ver([	
    "TABLA"=>"personal",
    "ID_F"=>$out['busqueda']['otKey'], 
   // "LIKE_V"=>[strtolower($_POST['servicios'])],
    "SALIDA"=>'ARRAY'
]);

$out['ResultadoNombre']=$jmy->ver([	
    "TABLA"=>"clientes_".$session["body"]["api_web"]["ID_F"],
    //"COL"=>["tipo"],
    //"LIKE_V"=>["empleado"],
    "ID_F"=>$out["resultado"]['otKey'],
    "SALIDA"=>'ARRAY',
]);
echo  json_encode(['out'=>$out,'post'=>$_POST]);
//$jmyWeb ->pre(['p'=>$out,'t'=>'TITULO_ARRAY']);