<?php 
// $jmy->db(['reservacion_hotel']);

if ($peticion[1]=='') {
    switch ($_GET['peticion']) {
        case 'verHabitacion':
            $out['tipo_hab'] = $jmy->ver([
                "TABLA"=>"habitacion",
                "SALIDA"=>"ARRAY",
            ]);
        break;
        case 'mostrarHabitacion':
                $out['t_habitacion'] = $jmy->ver([
                    "TABLA"=>"habitacion",
                    "COL"=>["habitacion"],
                    "V"=>[$_POST['datoHabitacion']["habitacion"]], 
                ]);
                $out['ti_habitacion'] = $jmy->ver([
                    "TABLA"=>"reservacion_hotel",
                    "COL"=>["fechaInicio","fechaFin"],
                    // "ID"=>$out['t_habitacion']['otKey'],
                    // "V"=>[$_POST['datoHabitacion']["fechaI"],$_POST['datoHabitacion']["fechaF"]],
                    "SALIDA"=>"ARRAY",
                ]);
                $out['fechasInicio'] = strtotime($_POST['datoHabitacion']["fechaI"]);
                $out['fechasFin'] = strtotime($_POST['datoHabitacion']["fechaF"]);
                $out['fechaMayor'] = ($out['fechasInicio']<$out['fechasFin'])?$out['fechasFin']:$out['fechasInicio'];
                $out['fechaNormal'] = date('m-d-y',$out['fechaMayor']);
                // $out['ti_habitacion'] = $jmy->ver([
                //     "TABLA"=>"habitacion",
                //     // "COL"=>["habitacion"],
                //     "V"=>[$_POST['datoHabitacion']["habitacion"]],
                //     // "SALIDA"=>"ARRAY",
                // ]);
                // $out['t_habitacion'] = $jmy->ver([
                //     "TABLA"=>"reservacion_hotel",
                //     
                //     "COL"=>["habitacion"],
                //     "V"=>[$_POST['datoHabitacion']["habitacion"]],
                //     "FO"=>true,
                //     // "SALIDA"=>"ARRAY",
                // ]);

                // $out['t_habitacion'] = $jmy->ver([
                //     "TABLA"=>"reservacion_hotel",
                //     "COL"=>["fechaInicio","fechaFin","habitacion"],
                //     "V"=>[$_POST['datoHabitacion']["fechaI"],$_POST['datoHabitacion']["fechaF"],$_POST['datoHabitacion']["habitacion"]],
                //     "SALIDA"=>"ARRAY",
                // ]);


        break;
        case 'datos_habitacion':
            $out['dato_habitacion']= $jmy->ver([
                "TABLA"=>"habitacion",
                "ID"=>[$_POST['idHab']["idH"]],
                "COL"=>["num_habitacion","habitacion","complementos","precio"],
                "SALIDA"=>"ARRAY",
            ]);
        break;
        case 'guardarReservacion':
            $out['reservacion'] = $jmy->guardar([
                "TABLA"=>"reservacion_hotel",
                "A_D"=>true,
                "GUARDAR"=>['fechaInicio'=>$_POST["datosReservacion"]["fechaI"],
                            'fechaFin'=>$_POST["datosReservacion"]["fechaF"],
                            'adulto'=>$_POST["datosReservacion"]["adultos"],
                            'niño'=>$_POST["datosReservacion"]["nino"],
                            'habitacion'=>$_POST["datosReservacion"]["habitacion"],
                            'id_habitacion'=>$_POST["datosReservacion"]["identificador"]
                ]
            ]);
        break;
        
        default:
        break;
    }
    
}


echo json_encode(['POST'=>$_POST,'GET'=>$_GET,'out'=>$out]);



?>