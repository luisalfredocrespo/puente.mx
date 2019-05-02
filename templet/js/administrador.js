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
        console.log(i);
        let zi=(i!=''&&i!=undefined)?JSON.parse(i):[];
        $.ajax({
            url: location.origin + '/administradorws/modulos/'+zi.u,
            type: 'POST',
            dataType: 'json',
            success: function(res) {
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
                if($(window).width()<960)
                    $('.navbar-collapse').addClass('collapse');
                else
                    $('.navbar-collapse').removeClass('collapse');
                
                $(window).resize(function(){
                    if($(window).width()<960)
                    $('.navbar-collapse').addClass('collapse');
                    else
                    $('.navbar-collapse').removeClass('collapse');
                });   
            },
            error: function(res) {
                console.log(res);
            },
            data:{data:d}
        });
    }
    $(document).ready(function() {
        crear_menu();    
        $(document).ready(function(){
            if($("#url_redirect").data('redirect'))
                window.location = $("#url_redirect").val();
            //else
                //ver_id_proyecto();
            $("#copiar_proyecto").on('click',function(){copiar_proyecto()});

            
    } );
    } );
});