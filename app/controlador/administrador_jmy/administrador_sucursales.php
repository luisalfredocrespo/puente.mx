<?php

$tabla=TABLA_SUCURSAL."_".$out['session']['body']['api_web']['ID_F'];
$columnas=['direccion','telefono','responsable'];
switch ($peticion[1]) {
    default:
        $out['sucursal'] = $jmy->ver([
            "TABLA"=>$tabla,
            "ID"=>$out['id'],
            "COL"=>$columnas,
            "SALIDA"=>'ARRAY',
            ]);
    break;
}