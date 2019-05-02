<?php


if(count($_POST)>0){
    $var["ID"]=($_POST['ID']!='')?$_POST['ID']:uniqid();
    if($_POST['cliente']!='' && $_POST['proveedor']!=''&& $_POST['estatus']!=''){
        
        //filtro  - Exista proveedor
        $var["ver_poveedor"]=$jmy->ver([
            "TABLA"=>"proveedor",
            "ID"=>$_POST['proveedor'],
        ]);

        //filtro  - Exista productos
        ////
        $var["ver_productos"]=$jmy->ver([
            "TABLA"=>"productos",
            "ID"=>$_POST['productos'],
        ]);

        $var["ver_sucursal"]=$jmy->ver([
            "TABLA"=>"sucursal",
            "ID"=>$_POST['sucursal'],
        ]);



        if($var["ver_poveedor"]['otKey'][0]!=''){
            $var['guardar'][]='se guardo';
            //$var ["guardar"]=
            $jmy->guardar([
                "TABLA"=>"pedido",
                "ID"=>$_POST['ID'],
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

                $var['error'][]="No existe proveedor";
            }
        }else{
            $var['error'][]="Faltan campos cliente,proveedor,estatus para guardar";
        }
    }

$var ["ver"]=$jmy->ver([
    "TABLA"=>"pedido",
    "ID"=>$_POST['ID'],
    "COL"=>["dia_pedido","cliente","proveedor","productos","estatus"],   
]);


$var["post"]=$_POST;



echo json_encode(
    ["POST"=>$_POST,"GET"=>$_GET,"var"=>$var]
);




?>