<?php
if($jmyWeb->sesion()){
    switch ($peticion[1]) {
        /*case 'json_campos':
            $t = 'administrador_config_'.$jmyWeb->sesion(['return'=>'db']);
        break;*/
        case 'json_campos':
            $t=$_POST['t'];
            $id="json_campos_".$t['id'];
            $in=$_POST['i'];
            $tabla='administrador__config'."_".$jmyWeb->sesion(['return'=>'db']);
            if($t['guardar']!='')
                $out['guardar']= $jmy->guardar([
                    "TABLA"=>$tabla,
                    "ID"=>$id,
                    "A_D"=>true,
                    "GUARDAR"=>["json_campos"=>$t['guardar']],
                ]);
            $out['json_campos']=$jmy->ver([
                "TABLA"=>$tabla,
                "ID"=>$id,
                //"COL"=>["json_campos"],
                "SALIDA"=>"ARRAY",
            ]);
            $out['vista']=$out['json_campos']['ot'][$id];
            $out['json_campos']=$out['vista']['json_campos'];
            $j=json_decode($out['json_campos'],1);
            if($in['page']!=''&&$in['tabla']!=''&&is_array($j)){
                $b=[];
                foreach($j as $k=>$v){$b[]=$v["id"];}
                $out['ver']=$jmy->ver([
                    "TABLA"=>$in['tabla'],
                    "ID"=>$in['page'],
                    "COL"=>$b,
                    //"SALIDA"=>"ARRAY",
                ]);
                $out['ver']=$out['ver']['ot'][$in['page']];
            }
        break;
        case 'ver':
            $p=$_POST['perfil'];
            $out=$jmy->ver([
                    "TABLA"=>$p['tabla'],
                    "ID"=>$p['page'],
                    "COL"=>$p['page'],
            ]);
        break;
        
        default:
            # code...
            break;
    }
}else{
    $out['error'] =['No hay sesión activa'];
}