<?php



$var ["guardar"]=$jmy->guardar([
    "TABLA"=>"vistaweb",
    "ID"=>"prueba",
    "A_D"=>TRUE,
    "GUARDAR"=>["id"=>":)",],
]);

$var ["ver"]=$jmy->ver([
    "TABLA"=>"vistaweb",
    "ID"=>"prueba",
   
]);



$var["post"]=$_POST;



echo uniqid('id_',true);

?>