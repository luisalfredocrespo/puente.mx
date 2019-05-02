<?php
$comentario = strip_tags($_POST['comentario']);
$grabar = fopen("com.html","a");
fwrite ($grabar,"<p>$comentario</p>");
fclose($grabar);

include("inicio.php");

?>