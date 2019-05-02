<?php

if(count($_POST)>0){
    $var["ID"]=($_POST['ID']!='')?$_POST['ID']:uniqid();
    if($_POST['dia_pedido']!='' && $_POST['proveedor']!=''&& $_POST['estatus']!=''){
        //$var ["guardar"]=
        $jmy->guardar([
            "TABLA"=>"pedido",
            "ID"=>$var['ID'],
            "A_D"=>TRUE,
            "FO"=>TRUE,
            "GUARDAR"=>[
                 "dia_pedido"=>$_POST['dia_pedido'],
                    "sucursal"=>$_POST['sucursal'], //sucursal
                    "proveedor"=>$_POST['proveedor'],
                    "productos"=>$_POST['productos'],
                    "estatus"=>$_POST['estatus'],
            ],                        
        ]);
    }else{
        $var['error'][]="Faltan campos dia de pedido, proveedor, estatus; para guardar";
    }
}

$var ["ver"]=$jmy->ver([
    "TABLA"=>"pedido",
    "ID"=>$var['ID'],
    "COL"=>["dia_pedido","sucursal","proveedor","productos","estatus"],
    "SALIDA"=>"ARRAY"
]);


$var["post"]=$_POST;




    $out= ["POST"=>$_POST,"GET"=>$_GET,"var"=>$var]


?>