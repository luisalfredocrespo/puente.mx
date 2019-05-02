
<?php

    $config=[
        "tabla"=>'productos'
    ];
    switch ($_GET['peticion']) {
        case 'instalar':
            if($jmyWeb->modoEditor()){
                $jmyWeb->pre(['p'=>$jmy->db([$config['tabla']]),'t'=>'Instalación DB']);
            }else{
                $out['error']='Sessión no iniciada';
            }        
            break;
        case 'marcas-lista':

            $tmp = $jmy->ver([	
                "TABLA"=>$config['tabla'],
                "COL"=>['nombre_marca']
            ]);
        
            $out['ver'] = $jmy->ver([	
                "TABLA"=>$config['tabla'],
                "ID_F"=>$tmp['otKey'], 
                "SALIDA"=>'ARRAY',
            ]);
            

        break;
        case 'marcas':
            if($jmyWeb->modoEditor()){
                if($_POST['nombre']!=''){
                    $out['id']=($_POST['id']!='')?$_POST['id']:uniqid();
                    $out['g']= $jmy->guardar([	"TABLA"=>$config['tabla'], 
                            "ID_F"=>$out['id'], 
                            "A_D"=>TRUE, 
                            "GUARDAR"=>['nombre_marca'=>$_POST['nombre']],
                        ]);
                }
                if($out['id']!='' ||  $_POST['id']!=''){
                    $out['ver'] = $jmy->ver([	
                        "TABLA"=>$config['tabla'],
                        "ID_F"=>($_POST['id']!='')?$_POST['id']:$out['id'], 
                    ]);
                }
            }else{
                $out['error']='Sessión no iniciada';
            }
        break;  
        case 'productos':
            if($jmyWeb->modoEditor()){
                if($_POST['nombre']!='' && $_POST['id_marca']!=''){
                    $out['id']=($_POST['id']!='')?$_POST['id']:uniqid();
                    $out['g']= $jmy->guardar([	"TABLA"=>$config['tabla'], 
                            "ID_F"=>$out['id'], 
                            "A_D"=>TRUE, 
                            "GUARDAR"=>[
                                'nombre_producto'=>$_POST['nombre'],
                                'id_marca'=>$_POST['id_marca'],
                            ],
                        ]);
                }
                if($out['id']!='' ||  $_POST['id']!=''){
                    $out['ver'] = $jmy->ver([	
                        "TABLA"=>$config['tabla'],
                        "ID_F"=>($_POST['id']!='')?$_POST['id']:$out['id'], 
                    ]);
                }
                if($_POST['nombre']=='' && $_POST['id_marca']!=''){
                    $tmp = $jmy->ver([	
                        "TABLA"=>$config['tabla'],
                        "COL"=>['id_marca'],
                        "V"=>$_POST['id_marca']
                        //"ID_F"=>($_POST['id']!='')?$_POST['id']:$out['id'], 
                    ]);
                
                    $out['ver'] = $jmy->ver([	
                        "TABLA"=>$config['tabla'],
                        "ID_F"=>$tmp['otKey'], 
                    ]);
                    
                }
            }else{
                $out['error']='Sessión no iniciada';
            }
            break;      
            
        case 'productos-lista':
            $out['ver'] = $jmy->ver([	
                "TABLA"=>$config['tabla'],
                "COL"=>['id_marca'] 
            ]);
            $out['ver'] = $jmy->ver([	
                "TABLA"=>$config['tabla'],
                "ID"=>$out['ver']['otKey'], 
                "SALIDA"=>'ARRAY', 
            ]);
        break;      
        case 'producto-editar':
            $out['hola']='mundo';
            if($jmyWeb->modoEditor()){
                $out['id']=($_POST['id_producto']!='')?$_POST['id_producto']:uniqid();
                if($_POST['guardar']['nombre']!=''){ 

                    if($_POST['id_marca']!='')
                        $_POST['guardar']['id_marca'] = $_POST['id_marca'];

                    $out['g']= $jmy->guardar([	
                            "TABLA"=>$config['tabla'], 
                            "ID_F"=>$out['id'],
                            "A_D"=>TRUE, 
                            "GUARDAR"=>$_POST['guardar'],
                        ]);
                }

                if($out['id']!=''){
                    $out['ver'] = $jmy->ver([	
                        "TABLA"=>$config['tabla'],
                        "ID_F"=>$out['id'], 
                    ]);
                }
           


            }else{
                $out['error']='Sessión no iniciada';
            }
        break;      
        case 'producto-borrar':
            $out['fn']='producto-borrar';
            if($jmyWeb->modoEditor()){
                $out['id']=$_POST['id_producto'];

                if($out['id']!=''){
                    $out['ver'] = $jmy->ver([	
                        "TABLA"=>$config['tabla'],
                        "ID_F"=>$out['id'], 
                    ]); 
                    if(is_array($out['ver']['ot'][$out['id']])){
                        $out['columnas'] = array_keys($out['ver']['ot'][$out['id']]);
                        $jmy->borrar([	
                            "TABLA"=>$config['tabla'], 
                            "ID_F"=>$out['id'],
                            "COLUMNAS"=>$out['columnas'], 
                        ]);
                    }
                }

                if($out['id']!=''){
                    $out['ver'] = $jmy->ver([	
                        "TABLA"=>$config['tabla'],
                        "ID_F"=>$out['id'], 
                    ]);
                }
           


            }else{
                $out['error']='Sessión no iniciada';
            }
        break;        
        default:
            # code...
            break;
    }



echo json_encode([  
    'POST'=>$_POST,
    'GET'=>$_GET,
    'out'=>$out
    ]);
    ?>
