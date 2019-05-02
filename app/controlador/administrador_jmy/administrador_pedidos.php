<?php

$tabla=TABLA_PEDIDO."_".$out['session']['body']['api_web']['ID_F'];
$columnas=['dia_pedido','sucursal','proveedor','productos','estatus'];
switch ($peticion[1]) {
    default:
        $out['pedido'] = $jmy->ver([
            "TABLA"=>$tabla,
            "ID"=>$out['id'],
            "COL"=>$columnas,
            "SALIDA"=>'ARRAY',
            ]);
    break;
}