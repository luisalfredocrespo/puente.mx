<?php
 $out['respuesta_personal'][]=$jmy->ver([	
    "TABLA"=>"personal",
    //"ID_D"=>["servicios"], 
    "LIKE_V"=>[strtolower($_POST['servicios'])],
   // "SALIDA"=>'ID'
]);

$jmyWeb ->pre(['p'=>$out,'t'=>'TITULO_ARRAY']);