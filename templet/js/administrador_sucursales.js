let id = '';


function editar(d=[]) {
    jQuery(function ($) {  

        $.ajax({
            url: location.origin + '/administradorws/sucursales',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                id=res.var.ID;
                
                let campos = res.var.ver.ot[id];
                console.log(campos);
                
                $("#direccion").val(campos.direccion);
                $("#telefono").val(campos.telefono);
                $("#responsable").val(campos.responsable);
            },
            error: function(res) {
                console.log(res);
            },
            data: {
                ID:id,
                direccion:$("#direccion").val(),
                telefono:$("#telefono").val(),
                responsable:$("#responsable").val(),
            }
        });

    });    
}
jQuery(function ($) {  
    function urlFr(a){return a.toLowerCase().replace(/[^a-z0-9]+/g, "-").replace(/^-+|-+$/g, "-").replace(/^-+|-+$/g, '')};
    function lista_sucursales(){        
        $.ajax({
            url: location.origin + '/administradorws/sucursales',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                let lista = res.var.ver.otFm;
                console.log(lista);               
                let data = [];                
                lista.forEach(element => {
                    data.push([
                        element.ID_F,
                        element.direccion,
                        element.telefono,
                        element.responsable,
                        '<a href="'+location.origin+'/administrador/usuarios/sucursal/'+element.ID_F+'" class="color_g"> <i class="fa fa-eye"></i> ver </a>',
                        '<button class="btn btn-sm btn-flat ver_sucursal" data-id="'+element.ID_F+'"> <i class="fa fa-eye"></i> editar</botton>'
                    ]);
                });
                console.log(data);
               /* https://datatables.net/manual/index */
                $.when($('#lista').DataTable( {
                    data: data,
                    columns: [
                        { title: "Id" },
                        { title: "Dirección" },
                        { title: "Telefono" },
                        { title: "Responsable"},
                        { title: " "},
                        { title: "  Editar Responsable"}
                        
                    ],
                    deferRender: true,
                    scrollY:     300,
                    scroller: {
                    loadingIndicator: true
                    },
                    language:idioma_espanol
                    } )).done(function () {
                    console.log('id_sucursal');
                    $(".ver_sucursal").on('click', function () {
                        let id_sucursal = $(this).data('id');
                        console.log('id_sucursal',id_sucursal);
                        limpiar_campos();
                        if(id_sucursal!=undefined && id_sucursal!=''){
                            
                            id= id_sucursal;
                            editar(); 
                        }
                    });
                });        
            },
            error: function(res) {
                console.log(res);
            },
            data: {}
        });
    }
    let idioma_espanol = 
            {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
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
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
    function limpiar_campos() {
        $("#direccion").val("");
        $("#telefono").val("");
        $("#responsable").val("");
    }

    $(document).ready(function() {
        lista_sucursales();  
        $("#formulario").hide();
        $("#cerrar_form").hide();
        $("#cerrar_form").on('click', function () {
        $("#agregarNuevo").show("slow");
        $("#cerrar_form2").hide("slow");
        $("#cerrar_form").hide("slow");
            
        });
        $("#agregarNuevo").on('click', function () {
            $("#cerrar_form2").show("slow");
            $("#agregarNuevo").hide("slow");
            $("#cerrar_form").show("slow");
            $("#formulario").show("slow");
            id='';
            //console.log('id',id);
            limpiar_campos();
            editar();
        });
        $("#guardar").on('click', function () {
            console.log('hola');
            event.preventDefault();
            editar();
            //console.log('id',id);
        });  
    } );
});