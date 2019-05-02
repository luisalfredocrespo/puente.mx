<?php 
$jmyconect = new HiJMY();
$jmy = new JMY3MySQL();
$jmyWeb = new JMY3WEB();
$jmyWeb->cargar(["pagina"=>"crespo"]);
$jmyWeb ->cargar_vista(["url"=>"crespo.php"]);
?>