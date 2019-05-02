<?php

$tabla= TABLA_PRODUCTOS."_".$out['session']['body']['api_web']['ID_F'];
$columnas=['nombre','precio','proveedor','cantidad','fecha_compra','fecha_venta'];
switch ($peticion[1]) {
    default:
        $out['productos'] = $jmy->ver([
            "TABLA"=>$tabla,
            "ID"=>$out['id'],
            "COL"=>$columnas,
            "SALIDA"=>'ARRAY',
            ]);
    break;
}
?>