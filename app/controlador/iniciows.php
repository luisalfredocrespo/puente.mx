<?php

$peticion = explode('/',$_GET['peticion']);

switch ($peticion[0]) {
    case 'servicios':
        $salida=$jmy->catalogos(["id"=>"lista_de_servicios"]);
        $salida= $salida['otFm'];
    break;
    case 'servicios1':
        $salida=$jmy->catalogos(["id"=>"lista_de_servicios"]);
        $salida= $salida['otFm'];
    break;
    case 'servicios2':
        $salida=$jmy->catalogos(["id"=>"lista_de_testimonios"]);
        $salida= $salida['otFm'];
    break;
    default:
    
    break;
}

echo json_encode($salida);
