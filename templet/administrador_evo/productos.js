function lista(d=[]) {
    jQuery(function ($) {    
        $.ajax({
            url: location.origin+"/administradorws/productos",
            type:"post",
            dataType:"json",
            data:{ola:"que hace :) 2 post"},
            success:function(respuesta){
                console.log(res);
                let lista = res.productos.otFm;
                let url = '';                
                let data = [];                
                lista.forEach(e => {
                    url = '<a href="'+location.origin+'/productos/'+e.ID_F+'/'+urlFr(e.nombre)+'" class="btn btn-round btn-sm btn-info"><i class="fa fa-link"></i></a>';       
                    data.push([e.ID_F,e.nombre,url]);
                });
                console.log(data);
               /* https://datatables.net/manual/index */
                $('#lista').DataTable( {
                    data: data,
                    columns: [
                        { title: "Id" },
                        { title: "Nombre" },
                        { title: "Precio" },
                        { title: "Proveedor"},
                        { title: "Cantidad"},
                        { title: "Fecha de compra"},
                        { title: "Fecha de venta"}
                        
                    ]
                } );        
                

            },error:function (e) {
               // console.log(e);
                
            }

        });
        
    });
}

function nuevo(d=[]) {
    console.log('hola');
    jQuery(function($){
        $("#agregarNuevo").on('click', function () {
          
            
            let html = '<div type="json_campos" class="jmy_web_administrador col-md-12" id="formulario_productos" data-idregistro="formulario_productos" data-tabla="productos" data-page="" >Error al cargar los datos</div>';
           
            $("#resultado").html(html);
            jmywajson_campos();// Recargar DOM   

        });
    });    
}

jQuery(function($){
    $(document).ready(function () {
        lista();
        nuevo();
    });
});