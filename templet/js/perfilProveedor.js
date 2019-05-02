jQuery(function ($) {  
    console.log('ola k ase');

    function guardar_perfil() {
        // AQUI VAN LAS REGLAS DE INGRESO
        let guardar = {
            nombre:$("#proveedor_nombre").val(),
            telefono:$("#proveedor_telefono").val(), // Filtrar por teléfono
            edad:$("#proveedor_direccion").val(), // Filtrar por direccion
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
         /* caso por caso 
         if(guardar.edad < 19){
            seguir = true;            
        }else{
            seguir = false;
            error = error + " Aceptas que se guarde informacion del menor ";
        }
        */
        

        console.log(guardar);
        if(seguir){
            let id_perfil = $("#id_proveedor").val();
            $.ajax({
                url: location.origin + '/provedorws/guardar/'+id_perfil,
                type: 'post',
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    let id = res.perfil.otKey[0];
                    $("#id_perfil").val((id!=undefined)?id:'');
                    history.pushState(null, "", location.origin+"/proveedor/editar/"+id);
                    $("#select_lista_proveedores").show(100);
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
        let id_proveedor = $("#id_proveedor").val();
        console.log('id_proveedor',id_proveedor);
        if(id_perfil!=''){
            
            select_lista_proveedores();
            $.ajax({
                url: location.origin + '/proveedorws/ver/'+id_proveedor,
                type: 'post',
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                if(res.provedor.nombre!=undefined)    
                        $("#provedor_nombre").val(res.proveedor.nombre);
                },
                error: function(res) {
                    console.log(res);
                },
                data: {}
            });
        }else{
            console.log('agregar perfil');
            $("#select_lista_proveedor").hide();
            $("#boton_historial").hide();
            $('#pizzarra').html('  <div class="icon"> <span class="fa fa-users"> </span>  </div> <h5>Agrega<br>un proveedor nuevo</h5>' );
        }
    }
    function select_lista_perfiles(){
        let id_perfil = $("#id_proveedor").val();
        console.log(id_perfil);
        
        $.ajax({
            url: location.origin + '/proveedorws/lista_proveedor/',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                
                let lista = res.perfil.otFm;
                console.log(lista);
                let h = '<option selected>Selecciona...</option>';
                lista.forEach(e => {
                    h = h + '<option  value="'+e.ID_F+'">'+e.nombre+'</option>';
                });
                $("#select_lista_proveedor").html(h);

               

            },
            error: function(res) {
                console.log(res);
            },
            data: {}
        });
    }  $("#select_lista_proveedor").change( function () {
                    let id = $(this).val();
                    console.log(id);
                    $("#id_proveedor").val(id);
                    ver_perfil();
                });
    ver_perfil(); 
});