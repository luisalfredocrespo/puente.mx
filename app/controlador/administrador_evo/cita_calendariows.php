<?php
$session = $jmyWeb->session(); 

if($peticion[1]!=''){ // si viene con ID despliega detalles
    $citas["detalles"] = $jmy->ver([
        "TABLA"=>"citas__agendarcita",
        "ID"=>$peticion[1],
    ]);
     $citas['lista']=$jmy->ver([	
	    "TABLA"=>"catalogos",
	    "COL"=>["id_catalogo"],
	    "V"=>"lista_de_servicios"
	    //"SALIDA"=>"ARRAY"
	]);
if(count($citas['lista']['otKey'])>1)
    $citas['lista']=$jmy->ver([	
        "TABLA"=>"catalogos",
        "ID"=>$citas['lista']['otKey'],
        "SALIDA"=>"ARRAY"
    ]);

    // $citas['perfil']=$jmy->ver([   
    //     "TABLA"=>TABLA_USUARIOS."_".$jmyWeb->sesion(['return'=>'db']),
    //     "COL"=>['tipo'], 
    //     "V"=>['empleado','administrador'], 
    // ]);
	
	$citas['filtro'] = $jmy->ver([
                "TABLA"=>"clientes_".$session['body']['api_web']['ID_F'],
                "COL"=>["perfil_principal"],
                "V"=>$idUsuario
            ]);
    $citas['perfil'] = $jmy->ver([
    "TABLA"=>"clientes_".$session['body']['api_web']['ID_F'],
   	"ID_F"=>$citas['filtro']['otKey'],
    "SALIDA"=>"ARRAY"
    ]);

    // $cita['cambiarestatus'] = $jmy->guardar([
    //     "TABLA"=>"citas__agendarcita",
    //     "GUARDAR"=>["estatus"=>$_POST['estatus']]
    // ]);

    // $num = "";
	$detalles = array();
    $d_detalles = array();
    if ($citas["detalles"]["ot"][$peticion[1]]) {
    	foreach ($citas["detalles"]["ot"] as $key) {
    		$n_ser = "";
    		$n_emp = "";
    		$n_usr = "";
			foreach ($citas['lista']["otFm"] as $val) {
				if($key["servicio"] == $val["ID_F"]){
					$n_ser = $val["nombre"];
				}
			}
	    	foreach ($citas['perfil']["otFm"] as $valp) {
	    		if ($key["usuario"] == $valp["perfil_principal"]) {
	    			$n_usr = $valp["nombre"];
	    		}
	    		if ($valp["tipo"] === "empleado") {
	    			$n_emp = $valp["nombre"]; 
	    		}
	    	//$num = $key["perfil_principal"];
	    	}

    		$d_detalles["fecha"] = $key["fecha"];
    		$d_detalles["servicio"] = $n_ser;
    		$d_detalles["empleado"] = $n_emp;
    		$d_detalles["horario"] = $key["horario"];
    		$d_detalles["usuario"] = $n_usr;
     		array_push($detalles, $d_detalles);
    	}
    }

}else{ // Si no tiene ID depliega lista


    $citas["cita"] = $jmy->ver([
        "TABLA"=>"citas__agendarcita",
        "SALIDA"=>"ARRAY",
    ]);

    $citas["estatus"] = $jmy->ver([
        "TABLA"=>"citas__agendarcita",
        "COL"=>["estatus"],
        "SALIDA"=>"ARRAY",
    ]);

    $citas['lista']=$jmy->ver([	
	    "TABLA"=>"catalogos",
	    "COL"=>["id_catalogo"],
	    "V"=>"lista_de_servicios"
	    //"SALIDA"=>"ARRAY"
	]);
if(count($citas['lista']['otKey'])>1)
    $citas['lista']=$jmy->ver([	
        "TABLA"=>"catalogos",
        "ID"=>$citas['lista']['otKey'],
        "SALIDA"=>"ARRAY"
    ]);
}


$propiedad = array();
$array = array();
foreach ($citas["cita"]["ot"] as $contador) {
	$ser = "";
	foreach ($citas['lista']["otFm"] as $key) {
		if($contador["servicio"]==$key["ID_F"]){
			$ser = $key["nombre"];
		}
	}
	$hora = strlen($contador["horario"]);
	$newDate = date("Y-m-d", strtotime($contador["fecha"]));
     $array["id"] = $contador["ID_F"];
	 $array["title"] = $ser;
	 $array["start"] = $newDate."T".(($hora==2)?$contador["horario"].":00:00":"0".$contador["horario"].":00:00");
     $array["color"] = $contador["estatus"];
	 array_push($propiedad, $array);
}
unset($out);
//$out['datos']= $citas["cita"];
$out['propiedad']= $propiedad;
$out['detalles']= $detalles;
$out['lista']= $citas["lista"]["otFm"];
$out['perfil'] =  $citas['perfil']["otFm"];
$out['estatus']= $citas["cita"];

//$out['peticion']= $peticion;

/* Vamos a continuar en lo que estoy en la llamada */