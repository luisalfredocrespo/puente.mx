<?php 
if(file_exists('config_administrador.php'))
    require_once('config_administrador.php');
$peticion = explode('/',$_GET['peticion']);
//$jmyWeb ->pre(['p'=>$peticion,'t'=>'peticion']);
$out['session'] =$jmyWeb->session();
$out['error'] = '';
$out['post'] = $_POST;
function obtener_estructura_directorios($ruta){
    $arbol = [];
    $directorio = opendir($ruta); //ruta actual
    while ($archivo = readdir($directorio)) {
            if (!is_dir($archivo))
                $arbol[] =  $archivo;
        }
    return $arbol;
}
switch($peticion[0]):
    case 'instalar':
        $jmyWeb ->pre(['p'=>$jmy->db(["administrador_config_".$out['session']['body']['api_web']['ID_F'],TABLA_USUARIOS."_".$out['session']['body']['api_web']['ID_F']]),'t'=>'INSTALADOR Administrador']);        
    break;
    case 'sesion':
        $p=$_POST['data'];
        if($p['u']!='' && $p['t']!=''){
            $session = $jmyWeb->session([$p['u'],$p['t']]);
            $jmyWeb->guardar_session();
        }
        $out['post'] =$_POST;
        $out['session'] =[
            "u"=>$out['session']["user"]["user_id"],
            "t"=>$out['session']["user"]["token"]
        ];
    break;
    case 'importar':
        require(BASE_APP.'controlador/administrador_jmy/administrador_importar.php');
    break;
    case 'fn':
        require(BASE_APP.'controlador/administrador_jmy/administrador_fn.php');
    break;
    case 'usuarios':
        require(BASE_APP.'controlador/administrador_jmy/administrador_usuarios.php'); 
    break;
    default:
        if(file_exists('config_administrador.php')){
            require_once('config_administrador.php');                
            if(file_exists($modulos[$peticion[0]]['controlador_ws']))
                require_once($modulos[$peticion[0]]['controlador_ws']);
        }
endswitch;
if(is_array($out))
    echo json_encode($out);