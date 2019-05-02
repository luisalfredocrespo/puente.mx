<?php
if(count($_POST)>0){
    $var["ID"]=($_POST['ID']!='')?$_POST['ID']:uniqid();
    if($_POST['nombre']!='' && $_POST['precio']!=''&& $_POST['proveedor']!=''){
        //$var ["guardar"]=
        $jmy->guardar([
            "TABLA"=>"productos",
            "ID"=>$var['ID'],
            "A_D"=>TRUE,
            "FO"=>TRUE,
            "GUARDAR"=>[
                "nombre"=>$_POST['nombre'],
                "precio"=>$_POST['precio'],
                "proveedor"=>$_POST['proveedor'],
                "cantidad"=>$_POST['cantidad'],
                "fecha_compra"=>$_POST['fecha_compra'],
                "fecha_venta"=>$_POST['fecha_venta'],
            ],                        
        ]);
    }else{
        $var['error'][]="Faltan campos nombre,precio,proveedor; para guardar";
    }
}

$var ["ver"]=$jmy->ver([
    "TABLA"=>"productos",
    "ID"=>$var['ID'],
    "COL"=>["nombre","precio","proveedor","cantidad","fecha_compra","fecha_venta"],
    "SALIDA"=>"ARRAY"
]);


$var["post"]=$_POST;




    $out= ["POST"=>$_POST,"GET"=>$_GET,"var"=>$var]





?>