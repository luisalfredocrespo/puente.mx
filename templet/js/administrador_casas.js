jQuery(function ($) { 
    console.log('----------------------------------------*/*/*/*/*/*/*/*/');
    $(".opciones_extra").hide();
    $("#opciones_generales").on('click',function(){
        $(".opciones_extra").toggle(70);
    });
    function cargar_json_generales(){
        let j = $("textarea#json_ninos_generales").val();
        j= (j!=''&&j!=undefined)?JSON.parse(j):[];
        console.log(j);
        let col = [];
        j.forEach(e => {
            col.push(e.id);
        });
        const g = {
            id:$("#data-page").val(),
            tabla:$("#data-tabla").val(),
            col:col,
        };
        $.ajax({
            url: location.origin + '/administradorws/casas/',
            type: 'post',	
            dataType: 'json',
            success: function(res) {
                console.log(res);
                const v = (res.ver!=''&&res.ver!=undefined)?res.ver:[];
                let h = '';
                j.forEach(e => {
                    
                    switch (e.type) {
                        case 'select':
                        h=h+'<li class="list-group-item list-group-item-action list-group-item-light"><div class="d-flex w-100 justify-content-between"><div class="form-group w-80"><select type="select" class="form-control input-sm btn-mini  jmy_web_div" data-lista-id="'+e.lista_id+'" placeholder="'+((e.placeholder!=''&&e.placeholder!=undefined)?e.placeholder:'')+'" data-value="'+((v[e.id]!=''&&v[e.id]!=undefined)?v[e.id]:e.value)+'"  data-tabla="'+g.tabla+'" data-page="'+g.id+'" id="'+e.id+'"  tabindex="60"></select></div><small><div class="jmy_web_recargar_select" data-lista-id="'+e.lista_id+'" data-id="'+e.id+'"> '+e.label+'</div></small>  </li>   ';
                        break;
                        default:
                        let x=(v[e.id]!=''&&v[e.id]!=undefined)?v[e.id]:e.value;
                        x=(x!=''&&x!=undefined)?x:'Sin información';
                        h=h+'  <li class="list-group-item list-group-item-action list-group-item-light"><div class="d-flex w-100 justify-content-between"><p class="mb-1 jmy_web_div" data-page="'+g.id+'" data-tabla="'+g.tabla+'" id="'+e.id+'" data-editor="no">'+x+'</p><small>'+e.label+'</small></div></div></li>';
                        break;
                    }
                });
                $.when($("#lista_campos").html(h)).done(function(){
                    console.clear();
                    jmy_web_div_click();
                });
            },
            error: function(res) {
                console.log(res);
            },
            data: g
        });
    }
    function lista(){
        $('#listado_ninos').DataTable( {
            //data: {},
            ajax: location.origin + '/administradorws/casas/lista',
            columns: [
                { title: "Nombre" },
                { title: "Apellido P." },
                { title: "Apellido M" },
                { title: '<i class="fa fa-link"></i>' }
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
        } );    
    }
    $(document).ready(function() {
        if($("#json_ninos_generales").length)
            cargar_json_generales();

        if($("#listado_ninos").length)
            lista();

      /*  swal({
            type: "success",
            title: "Â¡Cita agendada!",
            showConfirmButton: true,
            confirmButtonText: "Cerrar",
            closeOnConfirm: true
            }).then((result)=>{
            if(result.value){
               window.location = "cita";
               }
           });*/
    });

 });