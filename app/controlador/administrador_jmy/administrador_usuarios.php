<?php

$tabla= TABLA_USUARIOS."_".$out['session']['body']['api_web']['ID_F'];
$columnas=['nombre','tipo','proveedor','foto_perfil'];
switch ($peticion[1]) {
    case 'modulos-guardar':
        $out['guardar'] =$_POST['data']['guardar'];
        $out['id'] =$_POST['data']['id_perfil'];
        if($out['id']){
            $out['guardar_out'] = $jmy->guardar([
                "TABLA"=>$tabla,
                "ID"=>$out['id'],
                "A_D"=>true,
                "FO"=>true,
                "GUARDAR"=>["modulos"=>json_encode( $out['guardar'])]
            ]);
        }
    case 'modulos':        


        $out['menu'] =(is_array($menu))?$menu:[ "administrador"=>[
                "nombre"=>"Administrdor",
                "url"=>"#",
                "class"=>"",
        ]];
        
        $out['id']=($out['id']!='')?$out['id']:$peticion[2];
        $out['modulos'] =$jmyWeb->modulos(['id'=>$out['id'],'modulos_permisos'=>false]);
        $out['usuarios'] = $jmy->ver([
            "TABLA"=>$tabla,
            "ID"=>$out['id'],
            "COL"=>['modulos'],
            "SALIDA"=>'ARRAY',
            ]);
        $moduloKey = (is_array($out['modulos']['modulos'])) ? array_keys($out['modulos']['modulos']):[];
        $out['modulos']['modulos_key'] =$moduloKey;
        for ($i=0; $i < count($moduloKey); $i++) { 
            if($out['modulos']['modulos'][$moduloKey[$i]]==1){
                $out['lista'][] = [
                    $moduloKey[$i],
                    0,// Tipo de permisos 0 oculto, 1 ver, 2 editor, 3 moderador , 4 admin
                ];
            }
        }
    break;
    case 'perfil':
        $id = ($_POST['id']!='')?$_POST['id']:$peticion[2];
        unset($_POST['id']);
        if($id!=''){
            $p=$_POST;
            if(is_array($p)){
                if(count($p)>0)
                    $jmy->guardar([
                        "TABLA"=>$tabla,
                        "A_D"=>true,
                        "ID"=>$id,
                        "GUARDAR"=>$p,
                    ]);
            }
            $out=$jmy->ver([
                "TABLA"=>$tabla,
                "ID"=>$id,
            ]);
            $out['usuario']=$out['ot'][$id];
            $out['ta_us'] = TABLA_USUARIOS;
            $out['t']=$jmyWeb->sesion(['return'=>'db']);
        }else{
                $out['error'] = 'Sin ID';
            }
    break;
    default:
        $out['usuarios'] = $jmy->ver([
            "TABLA"=>$tabla,
            "ID"=>$out['id'],
            "COL"=>$columnas,
            "SALIDA"=>'ARRAY',
            ]);
    break;
}