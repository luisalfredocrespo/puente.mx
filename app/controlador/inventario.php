<?php



$var ["guardar"]=$jmy->guardar([
    "TABLA"=>"vistaweb",
    "ID"=>"prueba",
    "A_D"=>TRUE,
    "GUARDAR"=>["Nombre"=>":)",],
]);

$var ["ver"]=$jmy->ver([
    "TABLA"=>"vistaweb",
    "ID"=>"prueba",
   
]);


$var["post"]=$_POST;



echo json_encode(
    $var 
);

?>