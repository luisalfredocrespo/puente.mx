
function jmywa_ws(d=[]) {
    jQuery(function ($) {  
    $.ajax({
        url: location.origin + '/administradorws/fn/'+d.api,
        type: 'POST',
        dataType: 'json',
        success: function(res) {
            if(d.log)
                console.log('jmywa_ws',res,d);
            if(d.fun!=''&&d.fun!=undefined)
                eval(d.fun+'('+JSON.stringify({d:d,r:res})+')');
        },
        error: function(res) {console.log(res); },
        data:d
    });
    });
}
function jmywajson_campos(d=[]) {
    console.log('jmywajson_campos');
    
    jQuery(function ($) {  
        $('.jmy_web_administrador').each(function(){
        let t = {
            type:$(this).attr("type"),
            id:$(this).attr("id"),//id campos
            tabla:$(this).data("tabla"),
            page:$(this).data("page"),// id usuario
        };
        console.log(t);
        if(t.type!=undefined&&t.type!=''&&t.id!=undefined&&t.id!=''&&t.tabla!=undefined&&t.tabla!=''&&t.page!=undefined&&t.page!=''){
            let f = t.type.split(',');
            $(this).html('');
            
            f.forEach(e => {
                switch (e) {
                    case 'json_campos':
                    $.ajax({
                        url: location.origin + '/administradorws/fn/json_campos/',
                        type: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            console.log(res);
                            let c_col = $(this).data('col-div');
                            console.log(t.id);
                            let r=res.vista;
                            r=(r!=undefined)?{
                                t:(r.titulo_formulario!=undefined)?r.titulo_formulario:'Título formulario',
                                d:(r.descripcion_formulario!=undefined)?r.descripcion_formulario:'Descripción del formulario y su funcionalidad',
                                ta:res.session.body.api_web.ID_F
                            }:{
                                t:'Título formulario',
                                d:'Descripción del formulario y su funcionalidad',
                                ta:res.session.body.api_web.ID_F
                            };
                            let json = (res.json_campos!=undefined&&res.json_campos!="")?JSON.parse(res.json_campos):[];
                            $("#"+t.id).html('');  
                            $("#"+t.id).append('<div class="col-xs-12 col-sm-'+((c_col!='')?c_col:'6')+' col-md-'+((c_col!='')?c_col:'6')+' col-lg-'+((c_col!='')?c_col:'4')+'"><div class="card"> <div class="card-header card-header-sm"><div class="jmy_web_div"  data-tabla="administrador_config_'+r.ta+'" data-page="json_campos_'+t.id+'" id="titulo_formulario">'+r.t+'</div><button class="btn btn-sm btn-round btn-primary pull-right" type="button" id="'+t.id+'_mas_op"><i class="fa fa-gear"></i></button></div><div class="card-body"><p class="card-text jmy_web_div" data-tabla="administrador_config_'+r.ta+'" data-page="json_campos_'+t.id+'" id="descripcion_formulario" data-editor="no">'+r.d+'</p><div class="card-text" id="'+t.id+'_json"><button type="button" id="'+t.id+'_g_config" class="btn btn-sm btn-primary btn-block">Guardar configuración</button></div><ul class="list-group" id="'+t.id+'_lista_campos"></ul></div></div></div>');  
                            $('#'+t.id+'_json').hide();
                            $('#'+t.id+'_mas_op').on('click',function(){
                                $('#'+t.id+'_json').toggle(60);
                            });
                            let container = document.getElementById(t.id+'_json');
                            let editor = new JSONEditor(container, {
                                mode: 'code',
                                modes: ['code', 'text', 'tree', 'view'], // allowed modes
                                onError: function (err) {
                                  console.log(err.toString());
                                }
                              });
                            editor.set(json);
                            $('#'+t.id+'_g_config').on('click',function(){
                                $('#'+t.id+'_json').toggle(60);
                                jmywa_ws({
                                    api:'json_campos',
                                    fun:'jmywa_cargar_formulario',
                                    i:t,
                                    t:{
                                        guardar:JSON.stringify(editor.get()),
                                        id:t.id,
                                        page:t.page
                                    },
                                });
                            });
                            jmywa_ws({
                                api:'json_campos',
                                fun:'jmywa_cargar_formulario',
                                i:t,
                                t:{
                                    id:t.id,
                                    page:t.page
                                },
                            });
                            jmy_web_div_click();
                        },
                        error: function(res) {
                            console.log(res);
                        },
                        data:{t:t}
                    });
                    break;
                    case 'comentarios':
                        
                    break;
                    case 'archivos':
                        
                    break;
                }    
            });
        }else{
            $(this).html('<div class="col-md-12"><h2>Ocurrió un error al cargar el Módulo</h2></div>');
            console.log('error: falta tabla, page, id o type');
        }
        });
    });
}
function jmywa_cargar_formulario(d=[]){ jQuery(function ($) {  
    console.log(d);
    
    const j = d.r.json_campos;
    let h = '';
    if(j!=undefined&&j!=''){
        let jo=JSON.parse(j);
        console.log(jo);
        let vr=d.r.ver;
        console.log(vr);
        
        jo.forEach(e => {
            let v =(vr!=undefined)? vr[e.id]:undefined;
            v = (v!=undefined)?v:'';
            switch (e.type) {
                case 'select':
                h+='<li class="list-group-item list-group-item-action list-group-item-light"><div class="d-flex w-100 justify-content-between"><div class="form-group w-80"><select type="select" class="form-control input-sm btn-mini  jmy_web_div" data-lista-id="'+e.lista_id+'" placeholder="'+((e.placeholder!=''&&e.placeholder!=undefined)?e.placeholder:'')+'" data-value="'+v+'"  data-tabla="'+d.d.i.tabla+'" data-page="'+d.d.i.page+'" id="'+e.id+'"  tabindex="60"></select></div><small><div class="jmy_web_recargar_select" data-lista-id="'+e.lista_id+'" data-id="'+e.id+'"> '+e.label+'</div></small>  </li>   ';
                break;
                case 'button':
                    h+='<li class="list-group-item list-group-item-action list-group-item-light"><div class="d-flex w-100 justify-content-between"><a href="'+ location.origin +'/'+e.url+d.d.i.page+'">'+e.label+'<a></div></li>';
                break;
                default:
                v=(v!=''&&v!=undefined)?v:'Sin información';
                h+='<li class="list-group-item list-group-item-action list-group-item-light"><div class="d-flex w-100 justify-content-between"><p class="mb-1 jmy_web_div" data-page="'+d.d.i.page+'" data-tabla="'+d.d.i.tabla+'" id="'+e.id+'" data-editor="no">'+v+'</p><small>'+e.label+'</small></div></div></li>';
                break;
            }
        });
    }
    $.when($("#"+d.d.t.id+"_lista_campos").html(h)).done(function(){
        jmy_web_div_click();
    });

});}
jQuery(function ($) {  
    function crear_submenu(d=[],id=''){
        let h = ' <div class="dropdown-menu" id="'+id+'" aria-labelledby="navbarDropdown">';
        d.forEach(e => {
            h=h+((e.nombre!='DIVIDER')?'<a class="dropdown-item '+e.class+'" href="'+e.url+'" '+e.data+'>'+e.nombre+'</a>':'<div class="dropdown-divider"></div>');
        });
        h+h+'</div>';
        return h;
    }
    
    function crear_menu(d=[]){
        let i=$.session.get('i');

        if(i!=undefined)
            i=$.session.get('i');

        console.log(i);
        let zi=(i!=''&&i!=undefined)?JSON.parse(i):[];
        $.ajax({
            url: location.origin + '/administradorws/usuarios/modulos/'+zi.u,
            type: 'POST',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                
                let mtmp=res.modulos.modulos_key;
                let utmp=res.usuarios.ot[zi.u];
                utmp=(utmp!=''&&utmp!=undefined)?utmp.modulos:'';
                utmp=(utmp!=''&&utmp!=undefined)?JSON.parse(utmp):[];
                let pem = [];
                utmp.forEach(e => {
                    pem[e.modulo]=e.permiso;
                });
                let h = '';
                if(mtmp!="" && mtmp!=undefined){
                    let co = 0;
                    mtmp.forEach(e => {
                        const m=res.menu[e];
                        if(m!=undefined && pem[e]>0)
                            h=h+' <li class="nav-item"><a class="nav-link '+((m.submenu!='' && m.submenu!=undefined)?'dropdown-submenu':'')+' '+m.class+'" href="'+m.url+'" data-submenu="nav-menu-'+co+'">'+m.nombre+'</a>'+crear_submenu(m.submenu,'nav-menu-'+co)+'</li>';
                        co++;
                    });
                }
                h=h+'<li class="nav-item"><a class="nav-link" href="'+location.origin+'/administrador/salir'+'" >Salir</a></li>';
                $("#nav_administrador").append(h);
                $(".dropdown-submenu").on('click',function () {
                    event.preventDefault();
                    $("#"+$(this).data('submenu')).toggle(50);
                });
                $(".navbar-toggler-bsk").on('click',function () {
                    $($(this).data('target')).toggleClass('collapse',50);
                    $(".dropdown-menu").hide();
                });                
                if($(window).width()>960){
                    $('#navbarSupportedContent').addClass('navbar-collapse ');
                    $('#navbarSupportedContent').removeClass('collapse');
                }else{
                    $('#navbarSupportedContent').addClass(' collapse');
                    $('#navbarSupportedContent').removeClass('navbar-collapse ');
                }
                $(window).resize(function(){
                    if($(window).width()>960){
                        $('#navbarSupportedContent').addClass('navbar-collapse ');
                        $('#navbarSupportedContent').removeClass('collapse');
                    }else{
                        $('#navbarSupportedContent').addClass(' collapse');
                        $('#navbarSupportedContent').removeClass('navbar-collapse ');
                    }
                });   
            },
            error: function(res) {
                console.log(res);
            },
            data:{data:d}
        });
    }
    $(document).ready(function() {
        $(document).ready(function(){
            crear_menu();    
            jmywajson_campos();
            if($("#url_redirect").data('redirect'))
                window.location = $("#url_redirect").val();
            //else
                //ver_id_proyecto();
            $("#copiar_proyecto").on('click',function(){copiar_proyecto()});

            
    } );
    } );
});