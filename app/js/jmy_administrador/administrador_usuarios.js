jQuery(function ($) {  
    $("#datos").hide();
    $(".div_tabs").hide();
    $("#btn_preferencias_empledo").hide();
    $(".btn_tabs").on('click',function(){
        let div = $(this).data('div');
        $(".btn_tabs").removeClass('active');
        $(this).addClass('active');
        $(".div_tabs").hide(150);
        $("#div_"+div).show(100);
    });
    $(".lista_usuarios").on('click',function(){
        lista_usuarios();
    });
    
    function guardar_modulos(d=[]){
        console.clear();
       // console.log('guardar_modulos',d.guardar);
        $.ajax({
            url: location.origin + '/administradorws/usuarios/modulos-guardar/'+d.id_perfil,
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                console.log('guardar_modulos',res);
            },
            error: function(res) {
                console.log(res);
            },
            data:{data:d}
        });
    };
    function lista_modulos(d=[],p=[]){
        console.log('lista_modulos',d);
        let pet_guardar = d.guardar;
        if(d.id_perfil!=''){
            
            
            $.ajax({
                url: location.origin + '/administradorws/usuarios/modulos/'+d.id_perfil,
                type: 'post',
                dataType: 'json',
                success: function(res) {
                    console.log(d);              
                    console.log(res);   
                    let u_permisos = res.modulos.modulos_permisos;
                    u_permisos=(u_permisos!='' && u_permisos!=undefined)?u_permisos:[];
                    console.log('u_permisos',u_permisos);
                    let m_niveles = res.modulos.modulos_niveles;
                    console.log('m_niveles',m_niveles);
                    let modulos = res.modulos.modulos;
                    console.log('modulos',modulos);
                    let modulos_key = res.modulos.modulos_key;
                    console.log(modulos_key);
                    let modulos_label = res.modulos.modulos_label;
                    console.log('modulos_label',modulos_label);
                    let permisos = [];
                    u_permisos.forEach(e => {
                        permisos[e.modulo]=e.permiso;
                    });
                    console.log('p',permisos);
                    
                    let h = '<div class="row"><div class="col-sm-6">Módulo</div><div class="col-sm-6">Permisos</div>';
                    modulos_key.forEach(e => {
                        let op = '';
                        for (let i = 0; i < m_niveles.length; i++) {
                            let se=(permisos[e]==i)?'selected':'';
                            op=op+'<option value="'+i+'" '+se+'>'+m_niveles[i]+'</option>' ;
                        }
                        h=h+'<div class="col-sm-6">'+modulos_label[e]+'</div><div class="col-sm-6"><select class="form-control form-control-sm modulos_select" data-modulo="'+e+'" >'+op+'</select></div>';
                    });
                    h = h+ '<div class="col-sm-8"></div><div class="col-sm-4"><button class="btn btn-sm btn-success btn-flat btn-block" id="guardar_modulos" data-id="'+d.id_perfil+'">Guardar</button></div></div>';
                    $("#listado_modulo_tabla").html(h);
                    $("#guardar_modulos").on('click',function(){
                        console.log('asd');
                        
                        let guardar = [];
                        $.when(
                            $(".modulos_select").each(function(){
                            guardar.push({
                                modulo:$(this).data('modulo'),
                                permiso:$('option:selected',this).val()
                            });
                        })).done(function (){
                            console.log('guardar',guardar);
                            
                            guardar_modulos({
                                id_perfil:d.id_perfil,
                                guardar:guardar
                            });
                        });
                    });
                   
                    
                    
                },
                error: function(res) {
                    console.log(res);
                },
                data: pet_guardar
            });
        }else{
            console.log("Falta Id de usuario");
            
        }
    }

    function lista_usuarios(){
        $.ajax({
            url: location.origin + '/administradorws/usuarios',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);              
                //imprimir_lista(res.usuarios.otFm);
               // console.log(lista);              
                let origen  = res.usuarios.otFm;
                if(origen!=undefined && origen!=''){

                    let lista = [];
                    origen.forEach(e => {
                        let link_editar = '<button class="btn btn-sm btn-flat btn-round ver_usuario" data-id="'+e.ID_F+'"><i class="fa fa-edit"></i></button>';
                        lista.push([
                            ((e.nombre!='' &&e.nombre!=undefined)?e.nombre:'--'),
                            '<img src="'+((e.foto_perfil!='' &&e.foto_perfil!=undefined)?e.foto_perfil:location.origin+'/templet/images/logoblanco3.fw.png')+'" width="20">',
                            ((e.tipo!='' &&e.tipo!=undefined)?e.tipo:'--'),
                            /*((e.proveedor!='' &&e.proveedor!=undefined)?e.proveedor:'--'),*/
                            link_editar
                        ]);

                    });

                    console.log(lista);
                    
                    
                    $.when($('#listado_usuario_tabla').DataTable( {
                        data: lista,
                        columns: [
                            { title: "Nombre" },
                            { title: "Foto" },
                            { title: "tipo" },
                            /*{ title: "Proveedor" },*/
                            { title: "Editar" }
                        ],
                        language: {
            
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ningún dato disponible en esta tabla",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     "Siguiente",
                                "sPrevious": "Anterior"
                            }
                        }
                    } )).done(function(){
                        $(".ver_usuario").on('click',function(){
                            event.preventDefault();
                            $("#datos").show(150);
                            $("#id_perfil").val($(this).data('id'));
                            ver_perfil();
                            
                        });
                    });   

                }
            },
            error: function(res) {
                console.log(res);
            },
            data: {}
        });
    }

    function imprimir_lista(d){
        let html = '';
        console.log(d);
        if(d!=null){
            for (let i = 0; i < d.length; i++) {
                const e = d[i];
                //html = html + '<li class="list-group-item ver_usuario" data-id="'+e.ID_F+'">'+e.nombre+'</li>';    
                
                let m = (e.proveedor==='JMYOAUTH')?'Usuario primario':'Usuario secundario';
                let s = (e.proveedor==='JMYOAUTH')?'list-group-item-info':'';
                html = html + '  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start '+s+' ver_usuario" data-id="'+e.ID_F+'" ><div class="d-flex w-100 justify-content-between"><h5 class="mb-1">'+e.nombre+'</h5><small>'+((e.tipo!=undefined)?e.tipo:'usuario')+'</small></div><p class="mb-1">'+m+'</p></small></a>';            
            }
            $("#listado_usuario").html(html);
            $(".ver_usuario").on('click',function(){
                event.preventDefault();
                $("#datos").show(150);
                $("#id_perfil").val($(this).data('id'));
                ver_perfil();
            });
        }else{
            $("#listado_usuario").html('No hay usuarios');
        }
    
        //boton_usuario(d);
    }

    function boton_usuario(d){
        $(".ver_usuario").on('click',function(){
            ver_usuario($(this).data('idf'));
        });
    }
    function ver_usuario(d){
        console.log('ver_usuario',d);   
        
        $("#datos").show(150);
        $("#id_perfil").val(d);
       // ver_perfil();
        
    }
    
    /* PARTE DE PERFIL.js */ 

    console.log('ola k ase');
    function guardar_perfil() {
        // AQUI VAN LAS REGLAS DE INGRESO
        let guardar = {
            nombre:$("#perfil_nombre").val(),
            telefono:$("#perfil_telefono").val(), // Filtrar por teléfono
        };
        
        let seguir = true;
        let error = '';

        /* caso por caso */
        if(guardar.telefono.length <= 10){
            seguir = true;            
        }else{
            seguir = false;
            error = error + " El teléfono no es válido ";
        }
        
        
        guardar.admin=true;
        console.log(guardar);
        if(seguir){
            let id_perfil = $("#id_perfil").val();
            $.ajax({
                url: location.origin + '/administradorws/usuarios/perfil/'+id_perfil,
                type: 'post',
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    let id = res.perfil.otKey[0];
                    $("#id_perfil").val((id!=undefined)?id:'');
                    history.pushState(null, "", location.origin+"/administrador/editar/"+id);
                    $("#select_lista_perfiles").show(100);
                    $("#boton_historial").show(100);
                    ver_perfil();
                },
                error: function(res) {
                    console.log(res);
                },
                data: guardar
            });
        }else{
            alert('datos incorrctos : '+error);
        }
    }
 
    function cambiar_tipo(d=[]) {
        console.log('cambiar_tipo',d);
        
            let id_perfil = $("#id_perfil").val();
            $.ajax({
                url: location.origin + '/perfilws/guardar/'+id_perfil,
                type: 'post',
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    let id = res.perfil.otKey[0];
                },
                error: function(res) {
                    console.log(res);
                },
                data: {tipo:d.tipo}
            });       
    }
 
    $("#boton_guardar").on('click',function(){
        guardar_perfil();
    });
    function ver_perfil(){
        let id_perfil = $("#id_perfil").val();
        console.log('id_perfil',id_perfil);
        if(id_perfil!=''){
            $("#div_perfil").show(100);
            $("#div_modulos").hide(40);
            //select_lista_perfiles();
            $.ajax({
                url: location.origin + '/administradorws/usuarios/perfil/'+id_perfil,
                type: 'post',
                dataType: 'json',
                success: function(res) {
                    console.log(res,res.ta_us); 

                    let form = '<div type="json_campos" class="jmy_web_administrador col-md-12" id="'+res.ta_us+'" data-idregistro="'+id_perfil+'" data-tabla="'+res.ta_us+'_'+res.t+'" data-page="'+id_perfil+'" >Error al cargar Módulo</div>';

                    $("#formulario_perfil").html(form);
                    jmywajson_campos();// Recargar DOM
		            







                    
                    let d = res.usuario;
                    let p = res.usuario.proveedor;
                    let m = (res.usuario.modulos!=''&&res.usuario.modulos!=undefined)?JSON.parse(res.usuario.modulos):[];
                    console.log(m);
                    console.log(d);
                    console.log(p);
                    lista_modulos({id_perfil:$("#id_perfil").val()},m);
                    if(p==='JMYOAUTH')
                        $("#div_    ").show(120);
                    else
                        $("#div_tipo_de_usuario").hide(100);
                        
                    $(".cambiar_tipo").removeClass('active');
                    $("#tipo_de_usuario").html('');
                    if(d.tipo!=''){
                        $("#btn_tipo_usuario_"+d.tipo).addClass('active');
                        $("#tipo_de_usuario").html(d.tipo);
                    }
                    if(d.tipo=='empleado'||d.tipo=='admin'){
                        $("#btn_preferencias_empledo").show(100);
                        $("#btn_preferencias_empledo").attr('href',location.origin+'/perfil/preferencias-empleado/'+d.perfil_principal);

                    }

                if(res.usuario.nombre!=undefined)    
                        $("#perfil_nombre").val(res.usuario.nombre);
                   
                },
                error: function(res) {
                    console.log(res);
                },
                data: {}
            });
        }else{
            console.log('agregar perfil');
            $("#select_lista_perfiles").hide();
            $("#boton_historial").hide();
            $('#pizzarra').html('  <div class="icon"> <span class="fa fa-users"> </span>  </div> <h5>Agrega<br>un usuario nuevo</h5>' );
        }
    }
    
    $(".cambiar_tipo").on('click',function(){
        $(".cambiar_tipo").removeClass('active');
        $(this).addClass('active');
        cambiar_tipo({tipo:$(this).data('tipo')});
    });
    function select_lista_perfiles(){
        let id_perfil = $("#id_perfil").val();
        console.log(id_perfil);
        
        $.ajax({
            url: location.origin + '/administradorws/usuarios/lista_perfiles/',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                
                let lista = res.perfil.otFm;
                console.log(lista);
                let h = '<option selected>Selecciona...</option>';
                if(lista!=undefined){
                    lista.forEach(e => {
                        h = h + '<option  value="'+e.ID_F+'">'+e.nombre+'</option>';
                    });
                }
                $("#select_lista_perfiles").html(h);
            },
            error: function(res) {
                console.log(res);
            },
            data: {}
        });
    }  $("#select_lista_perfiles").change( function () {
                    let id = $(this).val();
                    console.log(id);
                    $("#id_perfil").val(id);
                    ver_perfil();
                });

    $(document).ready(function() {
        ver_perfil(); 
        lista_usuarios();
    });
});