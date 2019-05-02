<?php

$jmyWeb->cargar_css(["url"=>"https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"]);    
$jmyWeb->cargar_js(["url"=>"https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"]);    

$jmyWeb->cargar_js(["url"=>$jmyWeb->url_templet(['return'=>true]).'js/administrador_productos.js']);
/* 
$jmyWeb ->pre(['p'=>$out,'t'=>'TITULO_ARRAY']);
 */
?>