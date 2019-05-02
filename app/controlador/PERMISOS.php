<?php 
function licencia_evolution($d=[]){
    global $jmyWeb;
    global $jmy;
    $s =$jmyWeb->session();
    $jmyWeb ->pre(['p'=>$s,'t'=>'licencia_evolution']);
    $jmyWeb ->pre(['p'=>$d,'t'=>'licencia_evolution d']);
    if($d['id']!=''){
        $out['tipo'] = $jmy->ver([
            "TABLA"=>TABLA_USUARIOS."_".$s['body']['api_web']['ID_F'],
            "ID"=>$d['id'],
            "COL"=>['tipo'],
            //"SALIDA"=>'ARRAY',
            ]);
            $out['tipo']=$out['tipo']['ot'][$d['id']]['tipo'];
        }else{
            $out['error'] = 'Sin ID';
        }
        
   // $jmyWeb ->pre(['p'=>$out,'t'=>'licencia_evolution o']);
    return $out;
}

/* licencia_evolution(["id"=>"25"]); */