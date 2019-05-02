<?php

$menu =  [
    "administrador"=>[
        "nombre"=>"Administrador",
        "url"=>"#",
        "class"=>"",
        "submenu"=>[
            [
                "nombre"=>"Dashboard",
                "url"=>$jmyWeb->url_inicio(['return'=>true])."administrador",       
                "class"=>"",         
            ],[
                "nombre"=>"Usuarios",
                "url"=>$jmyWeb->url_inicio(['return'=>true])."administrador/usuarios",       
                "class"=>"",         
            ],[
                "nombre"=>"DIVIDER"
        ]]
    ],
    "citas"=>[
        "nombre"=>"Citas",
        "url"=>$jmyWeb->url_inicio(['return'=>true])."administrador/citas",       
        "class"=>"",
    ],
    "proveedores"=>[
        "nombre"=>"Proveedores",
        "url"=>$jmyWeb->url_inicio(['return'=>true])."administrador/proveedores",
        "class"=>"",
    ],
    "productos"=>[
        "nombre"=>"Productos",
        "url"=>$jmyWeb->url_inicio(['return'=>true])."administrador/productos",
        "class"=>"",
    ],
    "sucursales"=>[
        "nombre"=>"Sucursales",
        "url"=>$jmyWeb->url_inicio(['return'=>true])."administrador/sucursales",
        "class"=>"",
    ],
    "pedidos"=>[
        "nombre"=>"Pedidos",
        "url"=>$jmyWeb->url_inicio(['return'=>true])."administrador/pedidos",
        "class"=>"",
    ]


];


$modulos =  [
    "citas"=>[
        "nombre"=>"Citas",
        "url_marco"=>"administrador_evo/calendario.php",
        "controlador"=>"app/controlador/administrador_evo/cita_calendario.php",    
        "controlador_ws"=>"app/controlador/administrador_evo/cita_calendariows.php",    
    ],
    "proveedores"=>[
        "nombre"=>"Proveedores",
        "url_marco"=>"administrador_evo/proveedores.php",
        "controlador"=>"app/controlador/administrador_evo/proveedores.php",    
        "controlador_ws"=>"app/controlador/administrador_evo/proveedoresws.php",
    ],
    "productos"=>[
        "nombre"=>"Productos",
        "url_marco"=>"administrador_evo/productos.php",//vista esto esta en templet 
        "controlador"=>"app/controlador/administrador_evo/productos.php",    
        "controlador_ws"=>"app/controlador/administrador_evo/productosws.php",
    ],
    "sucursales"=>[
        "nombre"=>"Sucursales",
        "url_marco"=>"administrador_evo/sucursales.php",//vista esto esta en templet 
        "controlador"=>"app/controlador/administrador_evo/sucursales.php",    
        "controlador_ws"=>"app/controlador/administrador_evo/sucursalesws.php",
    ],
    "pedidos"=>[
        "nombre"=>"Pedidos",
        "url_marco"=>"administrador_evo/pedidos.php",//vista esto esta en templet 
        "controlador"=>"app/controlador/administrador_evo/pedidos.php",    
        "controlador_ws"=>"app/controlador/administrador_evo/pedidosws.php",
    ],
    "perfil-empleado"=>[
        "nombre"=>"Perfil empleado",
        "url_marco"=>"error404.php", 
        "controlador"=>"app/controlador/administrador_evo/perfil-empleado.php",
    ]
];