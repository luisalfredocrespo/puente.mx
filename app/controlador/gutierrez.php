<?php 
$jmyconect = new HiJMY();
$jmy = new JMY3MySQL();
$jmyWeb = new JMY3WEB();
$jmyWeb->cargar(["pagina"=>"gutierrez"]);
$jmyWeb ->cargar_vista(["url"=>"gutierrez.php"]);
?>