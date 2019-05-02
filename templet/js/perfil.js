jQuery(function ($) {  
    console.log('ola k ase XXD:');

    function guardar_perfil() {
        // AQUI VAN LAS REGLAS DE INGRESO
        let guardar = {
            nombre:$("#perfil_nombre").val(),
            telefono:$("#perfil_telefono").val(), // Filtrar por teléfono
            edad:$("#perfil_edad").val(), // Filtrar por edad
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
         /* caso por caso */
         if(guardar.edad < 19){
            seguir = true;            
        }else{
            seguir = false;
            error = error + " Aceptas que se guarde informacion del menor ";
        }
        
        

        console.log(guardar);
        if(seguir){
            let id_perfil = $("#id_perfil").val();
            $.ajax({
                url: location.origin + '/perfilws/guardar/'+id_perfil,
                type: 'post',
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    let id = res.perfil.otKey[0];
                    $("#id_perfil").val((id!=undefined)?id:'');
                    history.pushState(null, "", location.origin+"/perfil/editar/"+id);
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
 
    $("#boton_guardar").on('click',function(){
        guardar_perfil();
    });
    function ver_perfil(){
        let id_perfil = $("#id_perfil").val();
        console.log('id_perfil',id_perfil);
        if(id_perfil!=''){
            
            select_lista_perfiles();
            $.ajax({
                url: location.origin + '/perfilws/ver/'+id_perfil,
                type: 'post',
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                if(res.perfil.nombre!=undefined)    
                        $("#perfil_nombre").val(res.perfil.nombre);
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
    function select_lista_perfiles(){
        let id_perfil = $("#id_perfil").val();
        console.log(id_perfil);
        
        $.ajax({
            url: location.origin + '/perfilws/lista_perfiles/',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                
                let lista = res.perfil.otFm;
                console.log(lista);
                let h = '<option selected>Selecciona...</option>';
                lista.forEach(e => {
                    h = h + '<option  value="'+e.ID_F+'">'+e.nombre+'</option>';
                });
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
    ver_perfil(); 
});