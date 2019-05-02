<?php
$session = $jmyWeb->session(); 
$idUsuario = $session['user']['user_id'];
$peticion = explode("/",$_GET['peticion']);
if($idUsuario!='' && $peticion[0]!=''){
    $id=($peticion[0]=='nuevo')?uniqid():$peticion[0];
    $out['post']=$_POST;
    $out['guardar']=$jmy->guardar([	
        "TABLA"=>"servicio",
        "A_D"=>true,
        "ID"=>$id,
        "GUARDAR"=>[
            "nombre"=>$_POST['nombre'],
            "tiempo_estimado"=>$_POST['tiempo_estimado']
        ]
    ]);
}
$out['lista']=$jmy->ver([	
    "TABLA"=>"catalogos",
    "COL"=>["id_catalogo"],
    "V"=>"lista_de_servicios"
    //"SALIDA"=>"ARRAY"
]);
if(count($out['lista']['otKey'])>1)
    $out['lista']=$jmy->ver([	
        "TABLA"=>"catalogos",
        "ID"=>$out['lista']['otKey'],
        "SALIDA"=>"ARRAY"
    ]);

echo  json_encode(['out'=>$out]);
//$jmyWeb ->pre(['p'=>$out,'t'=>'TITULO_ARRAY']);