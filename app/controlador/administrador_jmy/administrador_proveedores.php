<?php

$tabla=TABLA_PROVEEDOR."_".$out['session']['body']['api_web']['ID_F'];
$columnas=['nombre','telefono','direccion','dia_pedido'];
switch ($peticion[1]) {
    default:
        $out['proveedor'] = $jmy->ver([
            "TABLA"=>$tabla,
            "ID"=>$out['id'],
            "COL"=>$columnas,
            "SALIDA"=>'ARRAY',
            ]);
    break;
}