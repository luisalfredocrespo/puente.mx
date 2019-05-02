<?php

if(count($_POST)>0){
    $var["ID"]=($_POST['ID']!='')?$_POST['ID']:uniqid();
    if($_POST['direccion']!='' && $_POST['responsable']!=''){
        //$var ["guardar"]=
        $jmy->guardar([
            "TABLA"=>"sucursal",
            "ID"=>$var['ID'],
            "A_D"=>TRUE,
            "FO"=>TRUE,
            "GUARDAR"=>[
                "direccion"=>$_POST['direccion'],
                "telefono"=>str_replace(["-","_","#"],"",trim($_POST['telefono'])),
                "responsable"=>$_POST['responsable'],
            ],                        
        ]);
    }else{
        $var['error'][]="Faltan campos dirección, telefono; para guardar";
    }
}

$var ["ver"]=$jmy->ver([
    "TABLA"=>"sucursal",
    "ID"=>$var['ID'],
    "COL"=>["direccion","telefono","responsable"],
    "SALIDA"=>"ARRAY"
]);


$var["post"]=$_POST;




    $out= ["POST"=>$_POST,"GET"=>$_GET,"var"=>$var]


?>