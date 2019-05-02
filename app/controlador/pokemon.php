<?php 
$jmyconect = new HiJMY();
$jmy = new JMY3MySQL();
$jmyWeb = new JMY3WEB();
$jmyWeb->cargar(["pagina"=>"pokemon"]);
$jmyWeb ->cargar_vista(["url"=>"pokemon.php"]);
?>