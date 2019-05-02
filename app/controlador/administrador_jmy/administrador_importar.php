<?php
if($s=$jmyWeb->sesion(['return'=>'permisos_api'])>3){
    $p =$_POST;
    $t='importar_'.$out['session']['body']['api_web']['ID_F'];
    $emp=$out['session']['body']['api_web']['ID_F'];
    switch ($peticion[1]) {
        case 'instalar':
            $jmyWeb ->pre(['p'=>$jmy->db([$t]),'t'=>'DB Instalar importador']);
        break;
        case 'guardar':
            $out['i'] = json_decode($_POST['importar'],1);
            $out['c'] = json_decode($_POST['columnas'],1);
            $out['co'] = json_decode($_POST['co'],1);
            $out['log']['actualizar_columnas']=$jmy->col($out['co'],1);
            foreach ($out['c'] as $k => $v) {
                if(!in_array($v['db'].'__'.$emp,$db))
                    $db[]=$v['db'].'__'.$emp;
            }
            $out['log']['db'] = $jmy->db($db);
            for($i=1; $i < count($out['i']); $i++){
                
                $e=$out['i'][$i];
                $g=[];
                for($o=0;$o<count($e);$o++){
                    if($e[$o]!=''&&$e[$o]!='NULA'&&$e[$o]!=NULL)
                        switch ($out['c'][$o]['type']):
                            case 'select':
                                $g[$out['c'][$o]['db']][$out['c'][$o]['id']]=$jmyWeb->URLFriendly(trim($e[$o]),'_');
                            break;
                            case 'numero-decimal2':
                                $g[$out['c'][$o]['db']][$out['c'][$o]['id']]=number_format($e[$o],2,'.','');
                            break;
                            default:
                                $g[$out['c'][$o]['db']][$out['c'][$o]['id']]=trim($e[$o]);
                            break;
                        endswitch;                            
                }                    
                if(count($g)>0){
                    foreach ($g as $k => $v) {
                        $id=uniqid();
                        $out['g'][$id]=$jmy->guardar([
                            "TABLA"=>$k.'_'.$emp,
                            "ID"=>$id,
                            "GUARDAR"=>$v,
                        ]); 
                    }                        
                }                    
            }
        break;
        case 'columnas':
            $out = [];
            $out ["comunas"]=1;
            $out['p'] = $_POST;
            $out['lista']=[];
            foreach ($out['p']['lista'] as $k => $v) {
                $out['lista'][]=$v['id'];
            }
            $out['ver'] = $jmy->col($out['lista'],0);
        break;
        default:
            if($p['url']!=''&&$p['ruta']!=''){ 
                $a = obtener_estructura_directorios(BASE_ARCHIVO.'importaciones/'.$p['ruta'].'/');
                $out['id']=($p['id']!='')?$p['id']:uniqid();
                $jmy->guardar([
                    "TABLA"=>$t,
                    "ID"=>$p['id'],
                    "A_D"=>true,
                    "GUARDAR"=>[
                        "url"=>$p['url'],  
                        "ruta"=>$p['ruta'],  
                        "archivos"=>$a
                    ]
                ]);
                $out['base']=BASE_ARCHIVO.'importaciones/'.$p['ruta'].'/';
                $out['a']=$a;
            }
        break;
    }
}else{$jmyWeb ->pre(['p'=>'Acceso restringido','t'=>'Error']);}