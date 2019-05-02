<?php
 

 
$session = $jmyWeb->sesion(); 
//$out['session'] = $session;
$idUsuario = $session['user']['user_id'];

switch ($_GET['peticion']) {
    case 'personal':
       $out['respuesta_personal'][]=$jmy->ver([	
                "TABLA"=>"personal",
                //"ID_D"=>["servicios"], 
                "LIKE_V"=>[strtolower($_POST['servicios'])],
               // "SALIDA"=>'ID'
            ]);
          $out['respuesta_personal'][]=$jmy->ver([	
                "TABLA"=>"personal",
                "ID"=>$out['respuesta_personal']['otKey'], 
                "SALIDA"=>'ARRAY'
            ]);
        break;
    case 'servicios':
       $out=$jmy->ver([   
                "TABLA"=>"servicio",
                //"ID_D"=>["servicios"], 
                //"LIKE_V"=>[$_POST['servicios']],
                "SALIDA"=>'ARRAY' 
            ]);
         /* $out['respuesta_servicios']=$jmy->ver([    
                "TABLA"=>"servicio",
                "ID"=>$out['respuesta_servicios']['otKey'], 
                "SALIDA"=>'ARRAY'
            ]);*/
        break;
    case 'verPersonaHorario':
        //Filtro por tipo de usuario
        $out['empleados']=$jmy->ver([   
            "TABLA"=>TABLA_USUARIOS."_".$jmyWeb->sesion(['return'=>'db']),
            "COL"=>['tipo'], 
            "V"=>['empleado','administrador'], 
        ]);
        //Catálogo de servicios
        $out['catalogo_servicios']=$jmy->catalogos([
            "id"=>"lista_de_servicios",
            "ID_F"=>$_POST['servicios']
            ]);
        foreach ($out['catalogo_servicios']['otFm'] as $key => $value) {
            $out['catalogo_servicios_valor'][] = $value['value'];
        }
        //Fitro por catálogo de servicio 
        if(count($out['empleados']['otKey'])>0)
            $out['empleados']=$jmy->ver([   
                "TABLA"=>TABLA_USUARIOS."_".$jmyWeb->sesion(['return'=>'db']),
                "COL"=>['serviciosAgregados'], 
                "LIKE_V"=> $out['catalogo_servicios_valor'], 
            ]);
        //infomración de los empleados
        if(count($out['empleados']['otKey'])>0)
            $out['empleados']=$jmy->ver([   
                "TABLA"=>TABLA_USUARIOS."_".$jmyWeb->sesion(['return'=>'db']),          
                //"COL"=>["dias","diasActivos","horario","nombre"],
                "ID"=>$out['empleados']['otKey'], 
                "SALIDA"=>'ARRAY'
            ]);
        
        
        

        $out['dia_semana']=$_POST['fecha'];
        $out['dia_semana']=date('w',strtotime( $_POST['fecha']))-1;
        $out['dia_semana']=($out['dia_semana']<0)?6:$out['dia_semana'];
        $out['dia_semana_nombre']=str_replace([0,1,2,3,4,5,6], ["lunes","martes","miercoles","jueves","viernes","sabado","domingo"], $out['dia_semana']);

            foreach ($out['empleados']['otFm'] as $key => $value) {
                $dias_activos=json_decode($value['diasActivos'],1);
                
                $disponible=$dias_activos[$out['dia_semana_nombre']];
                if($disponible)
                    $empleado[] = [
                        "nombre"=>$value['nombre'],
                        "ID_F"=>$value['ID_F'],
                        "foto_perfil"=>$value['foto_perfil'],
                        "dias"=>json_decode($value['dias'],1),
                        "diasActivos"=>$dias_activos,
                        "horario"=>json_decode($value['horario'],1),
                        "dispoible"=>$disponible,
                        "serviciosAgregados"=>json_decode($value['serviciosAgregados'])
                    ];
            }


        $out['empleado']=$empleado;
        $out['error']=($empleado!="")?'':"No hay empleados disponibles para la fecha ".$_POST['fecha'];
        unset($out['catalogo_servicios_valor']);
        //unset($out['catalogo_servicios']);
        unset($out['dia_semana']);
       // unset($out['empleados']);

            
        /*
            $day_of_week = date('N', strtotime('Monday'));

            $out['dia_semana'] = 'lunes';
            $out['horas_disponibles'] = [0:0,1:0,2:0];

        */

        /*$out['verPersonaHorario']=$jmy->ver([   
            "TABLA"=>"personal",
            "ID"=>[$_POST['persona']], 
            "SALIDA"=>'ARRAY'
        ]);*/
       



    break;
    /*case 'verPersonaHorario':
        $out['verPersonaHorario']=$jmy->ver([   
            "TABLA"=>"personal",
            "ID"=>[$_POST['persona']], 
            "SALIDA"=>'ARRAY'
        ]);
        $out['verPersonaHorario'] = $out['verPersonaHorario']['ot'][$_POST['persona']];
        //CONSULTA DE SERVICIOS
        $out['servicio']=$jmy->ver([   
            "TABLA"=>"servicio",
            "ID"=>[$_POST['servicios']], 
            //"SALIDA"=>'ARRAY'
        ]);
        $out['servicio'] = $out['servicio']['ot'][$_POST['servicios']];
        $out['tiempo_servicio'] = $out['servicio']['tiempo_estimado']*60;
        /// VER CITAS SI EXISTEN
        $out['agendarcita']=$jmy->ver([   
            "TABLA"=>"agendarcita",
            "V"=>[$_POST['fecha']], 
            //"SALIDA"=>'ARRAY'
        ]); 
        $out['agendarcita2']=$jmy->ver([   
            "TABLA"=>"agendarcita",
            "ID"=>$out['agendarcita']['otKey'], 
            "V"=>[$_POST['persona']]
            //"SALIDA"=>'ARRAY'
        ]); 
        $out['quitarHora'] = [];
        if(count($out['agendarcita2']['otKey'])>0){
            $out['infoCitaExistente']=$jmy->ver([   
                "TABLA"=>"agendarcita",
                "COL"=>["horario"],
                "ID"=>$out['agendarcita2']['otKey'],
                "SALIDA"=>'ARRAY'
            ]);             
            $out['infoCitaExistente'] = $out['infoCitaExistente']['otFm'];
            for ($i=0; $i < count($out['infoCitaExistente']) ; $i++) { 
                
                $out['quitarHora'][] = $out['infoCitaExistente'][$i]['horario'];
            }
        }else{
            $out['infoCitaExistente'] = false;
        }

        // generar Horario
        for ($i=$out['verPersonaHorario']['horario_mat_ini']; $i<=$out['verPersonaHorario']['horario_mat_fin'] ; $i++) { 
            if(!in_array($i,$out['quitarHora']))
                $out['horario'][] = $i;
        }
        for ($i=$out['verPersonaHorario']['horario_ves_ini']; $i<=$out['verPersonaHorario']['horario_ves_fin'] ; $i++) { 
            if(!in_array($i,$out['quitarHora']))
                $out['horario'][] = $i;
        }



    break;*/

    case 'guardarCita':
           #$jmy->db(['agendarCita']);
            // CAMBIAR EL NOMBRE DE VARIABLE mostrarCitas al final del desarrollo
        $out['mensaje']='ola k ace?';


            $out['error']='';
            $guardar = true;
            $out['mostrarCitas_fil_1'] = $jmy->ver([
                "TABLA"=>"citas__agendarcita",
                "V"=>[$_POST['datosCita']['fecha']],
            ]);
    
            $out['mostrarCitas_fil_2'] = $jmy->ver([
                "TABLA"=>"citas__agendarcita",
                "COL"=>['horario'],
                "V"=>[$_POST['guardar']['horario']],
                "FO"=>true,

                "ID"=>$out['mostrarCitas_fil_1']['otKey']
            ]);
            $out["lo_que_sea"][] = $guardar;
            $guardar = ($out['mostrarCitas_fil_2']['otKey'][0]!="")?false:true;
            $out["lo_que_sea"][] = $guardar;
            if(!$guardar){
                $out['mostrarCitas'] = $jmy->ver([
                    "TABLA"=>"citas__agendarcita",
                    "COL"=>['empleado'],
                    "V"=>[$_POST['guardar']['empleado']],
                    "FO"=>true,
                    "ID"=>$out['mostrarCitas_fil_2']['otKey']
                    ]);   
                    
                $guardar = (count($out['mostrarCitas']['ot'])>0)?false:true;
                $out["lo_que_sea"][] = $guardar;
            }

            $out['resultado_guardar'] = $guardar;
            $out["lo_que_sea"][] = $guardar;
            if($guardar){
                $out['citas__agendarcita'] = $jmy->guardar([
                    "TABLA"=>"citas__agendarcita",
                    "A_D"=>TRUE,
                    "GUARDAR"=>["servicio"=>$_POST['guardar']['servicio'],
                                "empleado"=>$_POST['guardar']['empleado'],
                                "usuario"=>$idUsuario,
                                "id_perfil"=>$_POST['datosCita']['cliente'],
                                "horario"=>$_POST['guardar']['horario'],
                                "fecha"=>$_POST['datosCita']['fecha'],
                                "estatus"=>'espera'
                            ]
                    ]);
            }else{
                $out['error']='Ya existe una cita en este horario';
            }   
    break;

    default:
        # code...
        break;
}

echo json_encode(['POST'=>$_POST,'GET'=>$_GET,'out'=>$out,'respuesta'=>$respuesta]);
 #crear una funcion que filtre las fecha,hora y muestre 


?>