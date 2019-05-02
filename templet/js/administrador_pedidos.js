
let id = '';


function editar(d=[]) {
    jQuery(function ($) {  

        $.ajax({
            url: location.origin + '/administradorws/pedidos',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                id=res.var.ID;
                
                let campos = res.var.ver.ot[id];
                console.log(campos);
                
                $("#dia_pedido").val(campos.dia_pedido);
                $("#sucursal").val(campos.sucursal);
                $("#proveedor").val(campos.proveedor);
                $("#productos").val(campos.productos);
                $("#estatus").val(campos.estatus);
            },
            error: function(res) {
                console.log(res);
            },
            data: {
                ID:id,
                dia_pedido:$("#dia_pedido").val(),
                sucursal:$("#sucursal").val(),
               proveedor:$("#proveedor").val(),
                productos:$("#productos").val(),
                estatus:$("#estatus").val(),
            }
        });

    });    
}
jQuery(function ($) {  
    function urlFr(a){return a.toLowerCase().replace(/[^a-z0-9]+/g, "-").replace(/^-+|-+$/g, "-").replace(/^-+|-+$/g, '')};
    function lista_pedidos(){        
        $.ajax({
            url: location.origin + '/administradorws/pedidos',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                //console.log('id',id);
                let lista = res.var.ver.otFm;
                console.log(lista);
                let data = [];
                if(lista!=undefined)
                lista.forEach(element => {
                    data.push([
                            element.ID_F,
                            element.dia_pedido,
                            element.sucursal,
                            element.proveedor,
                            element.productos,
                            element.estatus,
                            '<a href="'+location.origin+'/administrador/sucursales/pedido/'+element.ID_F+'" class="color_g"> <i class="fa fa-eye"></i> ver </a>',
                            '<button class="btn btn-sm btn-flat ver_pedido" data-id="'+element.ID_F+'"> <i class="fa fa-eye"></i> editar</botton>'
                    
                        
                        

                    ]);
                });
                console.log(data);
               /* https://datatables.net/manual/index */
               
                $.when($('#lista').DataTable( {
                    data: data,
                    columns: [
                        { title: "Id" },
                        { title: "Dia de pedido"} ,
                        { title: "Sucursal" },
                        { title: "Proveedor" },
                        { title: "Productos"},
                        { title: "Estatus"} ,
                        { title: " "},
                        { title: "  Editar Sucursal"} 
                    ],
                    deferRender: true,
                    scrollY:     300,
                    scroller: {
                    loadingIndicator: true
                    },
                    language:idioma_espanol
                } )).done(function () {
                    console.log('id_pedido');
                    $(".ver_proveedor").on('click', function () {
                        let id_pedido = $(this).data('id');
                        console.log('id_pedido',id_pedido);
                        limpiar_campos();
                        if(id_pedido!=undefined && id_pedido!=''){
                            
                            id= id_pedido;
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
        $("#dia_pedido").val("");
        $("#sucursal").val("");
        $("#proveedor").val("");
        $("#productos").val("");
        $("#estatus").val("");
    }

    $(document).ready(function() {
        lista_pedidos();  
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
        /* $("#ocultar").on('click', function () {
            console.log('hola');
            event.preventDefault();
            editar();
            //console.log('id',id);
        }); */
        $("#guardar").on('click', function () {
            console.log('hola');
            event.preventDefault();
            editar();
            //console.log('id',id);
        });
    } );


   
    $('#dia_pedido').datepicker({
        dateFormat: 'dd/mm/yy',
        inline: true,
        firstDay: 0,
        showOtherMonths: true,
        dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
        

    });

});