
let id = '';


function editar(d=[]) {
    jQuery(function ($) {  

        $.ajax({
            url: location.origin + '/administradorws/productos',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                id=res.var.ID;
                
                let campos = res.var.ver.ot[id];
                console.log(campos);
                
                $("#nombre").val(campos.nombre);
                $("#precio").val(campos.precio);
                $("#proveedor").val(campos.proveedor);
                $("#cantidad").val(campos.cantidad);
                $("#fecha_compra").val(campos.fecha_compra);
                $("#fecha_venta").val(campos.fecha_venta);
            },
            error: function(res) {
                console.log(res);
            },
            data: {
                ID:id,
                nombre:$("#nombre").val(),
                precio:$("#precio").val(),
                proveedor:$("#proveedor").val(),
                cantidad:$("#cantidad").val(),
                fecha_compra:$("#fecha_compra").val(),
                fecha_venta:$("#fecha_venta").val(),
            }
        });

    });    
}

jQuery(function ($) {  
    function urlFr(a){return a.toLowerCase().replace(/[^a-z0-9]+/g, "-").replace(/^-+|-+$/g, "-").replace(/^-+|-+$/g, '')};
    function lista_productos(){        
        $.ajax({
            url: location.origin + '/administradorws/productos',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                let lista = res.var.ver.otFm;
                console.log(lista);               
                let data = [];        
                if(lista!=undefined)        
                lista.forEach(element => {
                    data.push([
                        element.ID_F,
                        element.nombre,
                        element.precio,
                        element.proveedor,
                        element.cantidad,
                        element.fecha_compra,
                        element.fecha_venta,
                        '<a href="'+location.origin+'/administrador/proveedores/producto/'+element.ID_F+'" class="color_g"> <i class="fa fa-eye"></i> ver </a>',
                        '<button class="btn btn-sm btn-flat ver_producto" data-id="'+element.ID_F+'"> <i class="fa fa-eye"></i> editar</botton>'
                    ]);
                });
                console.log(data);
               /* https://datatables.net/manual/index */
                $.when($('#lista').DataTable( {
                    data: data,
                    columns: [
                        { title: "Id" },
                        { title: "Nombre" },
                        { title: "Precio" },
                        { title: "Proveedor"},
                        { title: "Cantidad"},
                        { title: "Fecha de compra"},
                        { title: "Fecha de venta"},
                        { title: " "},
                        { title: "  Editar Productos"} 
                    ],
                    deferRender: true,
                    scrollY:     300,
                    scroller: {
                    loadingIndicator: true
                    },
                    language:idioma_espanol
                } )).done(function () {
                    console.log('id_producto');
                    $(".ver_producto").on('click', function () {
                        let id_producto = $(this).data('id');
                        console.log('id_producto',id_producto);
                        limpiar_campos();
                        if(id_producto!=undefined && id_producto!=''){
                            
                            id= id_producto;
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
        $("#nombre").val("");
        $("#precio").val("");
        $("#proveedor").val("");
        $("#cantidad").val("");
        $("#fecha_compra").val("");
        $("#fecha_venta").val("");
    }
    $(document).ready(function() {
        lista_productos();
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

    $('#fecha_compra').datepicker({
        dateFormat: 'dd/mm/yy',
        inline: true,
        firstDay: 0,
        showOtherMonths: true,
        dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
        

    });

    $('#fecha_venta').datepicker({
        dateFormat: 'dd/mm/yy',
        inline: true,
        firstDay: 0,
        showOtherMonths: true,
        dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
        

    });
});