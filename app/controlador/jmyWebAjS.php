<?php 
if($jmyWeb->sesion()){
    $t="catalogos";
    $po=$_POST;
	$p=$jmyWeb->modulos();
	$ps=0;
	for($i=0; $i < count($p['modulos_permisos']); $i++){
		if(!$ps)
			$ps=($p['modulos_permisos'][$i]['permiso']>3)?true:false;
	}    
    $o=["error"=>""];
    if($po['id']!='' && $po['nombre'] && $po['value']){
        $o['i'] = uniqid();
        $o['guardar'] = $jmy->guardar([
            "TABLA"=>$t,
            "A_D"=>true,
            "ID"=>$o['i'],
            "GUARDAR"=>[
                "nombre"=>$po["nombre"],
                "value"=>$po["value"],
                "id_catalogo"=>$po["id"],
            ]
        ]);
    }else{
        $o['lista'] = $jmy->ver([
            "TABLA"=>$t,
            "COL"=>['id_catalogo'],
            "V"=>[$po['l']],
        ]);
        $o['lista'] = $jmy->ver([
            "TABLA"=>$t,
            "ID_F"=>$o['lista']['otKey'],
            "SALIDA"=>"ARRAY"
        ]);
    }
	$o['POST']=$po;
	$o['p']=$p;
	$o['ps']=$ps;
}else{
	$o=["error"=>"No hay sesión activa"];
}
echo json_encode($o);
?>