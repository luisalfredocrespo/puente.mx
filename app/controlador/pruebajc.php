<?php

$jmyWeb->cargar(["pagina"=>"pruebasjc"]);
$jmyWeb ->cargar_js(["url"=>$jmyWeb ->url_templet(["return"=>true])."js/pruebasjc.js"]);
$jmyWeb ->cargar_vista(["url"=>"pruebasjc.php"]);

?>