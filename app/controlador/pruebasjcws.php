<?php 
if($_POST['testjc']!=''){
    $var ["testjc"]=$jmy->ver([
        "TABLA"=>"testjc",
        "ID"=>$_POST['testjc'],
        "COL"=>["nombre","precio","proveedor","cantidad","fecha_compra","fecha_venta"], 
    ]);
}


if(count($_POST)>0){
    $var["ID"]=($_POST['ID']!='')?$_POST['ID']:uniqid();
    if($_POST['nombre']!='' && $_POST['precio']!=''&& $_POST['proveedor']!=''){
        //$var ["guardar"]=
        $jmy->guardar([
            "TABLA"=>"testjc",
            "ID"=>$_POST['ID'],
            //"A_D"=>TRUE,
            "FO"=>TRUE,
            "GUARDAR"=>$_POST 
                    
            ]);
        }else{
            $var['error'][]="Faltan campos nombre, precio,proveedor para guardar";
        }
    }

$var ["ver"]=$jmy->ver([
    "TABLA"=>"testjc",
    "ID"=>$_POST['ID'],
   // "COL"=>["nombre","precio","proveedor","cantidad","fecha_compra","fecha_venta"],   
]);
 

$var["post"]=$_POST;


echo json_encode(
    ["POST"=>$_POST,"GET"=>$_GET,"var"=>$var]
);


?>