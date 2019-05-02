<?php
if(count($_POST)>0){
    $var["ID"]=($_POST['ID']!='')?$_POST['ID']:uniqid();
    if($_POST['nombre']!='' && $_POST['telefono']!=''){
        //$var ["guardar"]=
        $jmy->guardar([
            "TABLA"=>"proveedor",
            "ID"=>$var['ID'],
            "A_D"=>TRUE,
            "FO"=>TRUE,
            "GUARDAR"=>[
                "nombre"=>$_POST['nombre'],
                "telefono"=>str_replace(trim($_POST['telefono']),"",["-","_","#"]),
                "direccion"=>$_POST['direccion'],
                "dia_pedido"=>$_POST['dia_pedido'],
            ],                        
        ]);
    }else{
        $var['error'][]="Faltan campos nombre, telefono; para guardar";
    }
}

$var ["ver"]=$jmy->ver([
    "TABLA"=>"proveedor",
    "ID"=>$var['ID'],
    "COL"=>["nombre","telefono","direccion","dia_pedido"],
]);


$var["post"]=$_POST;



echo json_encode(
    ["POST"=>$_POST,"GET"=>$_GET,"var"=>$var]
);





?>