<?php 
$peticion = explode("/",$_GET['peticion']);
$session = $jmyWeb->session(); 

include(RUTA_APP.'controlador/PERMISOS.php');
$licencia_evolution  = licencia_evolution(["id"=>$session['user']['user_id']]);
//$jmyWeb ->pre(['p'=>$resultado,'t'=>'resultado']);
$carga_centro = '';
if($peticion[0]=='entrar'){
    $session = $jmyWeb->session([$peticion[1],$peticion[2]]);
    $jmyWeb->guardar_session();
}
$jmyWeb ->pre(['p'=>$session,'t'=>'SESSION']);
$idUsuario = $session['user']['user_id'];
if($idUsuario!=''){
    $perfiles['principal']=$jmy->ver([
        "TABLA"=>"clientes_".$session['body']['api_web']['ID_F'],
        "ID"=>$idUsuario,
    ]);
    $perfiles['principal'] = (is_array($perfiles['principal']['ot'][$idUsuario]))?$perfiles['principal']['ot'][$idUsuario]:["error"=>"No existe usuario"];
    //$jmyWeb ->pre(['p'=>$perfiles,'t'=>'perfiles']);


    switch ($peticion[0]) {
        case 'editar':    
            $jmyWeb->cargar_js(["url"=>$jmyWeb->url_templet(['return'=>1])."js/perfil.js?d=".date('U')]);
            $carga_centro = "header_perfil.php";
            $carga_centro = "perfil_detalle.php";
            break;
            case 'historial':
            $carga_centro = "perfil_historial.php";
            break;
            case 'preferencias-empleado':   
               // $jmyWeb ->pre(['p'=>$peticion,'t'=>'TITULO_ARRAY']);
                if($peticion[1]!=''){
                    $accesos = ['admin','empleado'];

                    $jmyWeb ->pre(['p'=>$licencia_evolution['tipo'],'t'=>'algo']);

                    $carga_centro="preferencias-empleado.php";
                    
                        $jmyWeb->cargar_js(["url"=>$jmyWeb->url_templet(['return'=>1])."js/preferencias-empleado.js?d=".date('U')]);

                }else{
                    //$jmyWeb ->pre(['Error'=>$out,'t'=>'No hay id']);
                }
            break;    
            default:
                $carga_centro = "perfil_dashboard.php";
            break;
        }
    $pagina_marco="perfil.php";
    //$carga_centro = "perfil_historial.php";
}else{
    $pagina_marco="login.php";
    $carga_centro = "error_perfil.php";
}
/*$jmy->guardar([ "TABLA"=>"juans", // STRING
    "ID_F"=>[$get['id']], // Array
    "A_D"=>TRUE, 
    "GUARDAR"=>$out['juans'][$i],
    ]);*/


//$jmyWeb ->pre(['p'=>$carga_centro,'t'=>'peticion']);


$jmyWeb->cargar(["pagina"=>"perfil"]);


$jmyWeb ->cargar_vista(["url"=>$pagina_marco,
                        "data"=>[
                                "carga_centro"=>$carga_centro,
                                "perfiles"=>$perfiles,
                                "user_id"=>$idUsuario,
                                "id_perfil"=>$peticion[1],
                                "licencia_evolution"=>$licencia_evolution,
                            ]
                        ]);
?>