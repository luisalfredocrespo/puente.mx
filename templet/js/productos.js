jQuery(function ($) { 
    console.log('js productos');
    $('.editor_ventana').hide();
    $('.cel_formulario').hide();

    $('#marcas_ventana').hide();

    $('#editor_cerrar').on('click', function(){
        event.preventDefault();
        $('.editor_ventana').hide(500);
    });

    function btn_producto_borrar(d=[]) {
        $("#producto_borrar").on('click',function(){
            event.preventDefault();
            let id_producto = $(this).data('idproducto');
            console.log('id_producto',id_producto);
            swal({
                type: "warning",
                title: "¿Esta seguro de borrar este producto?",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: true
                }).then((result)=>{
                if(result.value){
                    ws({
                        peticion:'producto-borrar',
                        id_producto:$(this).data('idproducto'),
                        fn:'producto_borrar'
                    });
                   }
               });
           
        });
    }
    function producto_borrar(d=[]) {
        console.log('producto_borrar',d);
        producto_lista();
        $("#productos_ventana").hide(100);
          
    }

    function cargar_producto_id(){
        let id = $('#ver_id_producto').val();
        if(id!='' && id!=undefined){
            editor_abrir(id);
        }
    }
    cargar_producto_id();
    function editor_abrir(id){
        $('.editor_ventana').show(200);
        ws({
            peticion:'producto-editar',
            id_producto:id,
            fn:'cargar_campos_productos'
        });
        $("#editor_guardar").on('click',function(){
            guardar_producto({
                id_producto:id
            });
        });
        $("#producto_borrar").attr('data-idproducto',id);
        btn_producto_borrar();
    }
    function btn_editor_abrir(){
        
        $('.editor_abrir').on('click', function(){
            event.preventDefault();
            let id = $(this).data('idproducto');
            console.log(id);
            editor_abrir(id);
        });
    }

    $('#marca_cerrar').on('click', function(){
        event.preventDefault();
        $('#id_marca').val('');
        $('#nombre_marca').val('');
        $('#marcas_ventana').hide(500);       
    });
    function marca_abrir() {
        $('.marca_abrir').on('click', function(event){
            console.log('marca_abrir');
            event.preventDefault();
            $('#marcas_ventana').show(200);
            document.getElementById("#marca_guardar").disabled = false;
    
        });    
    }
    marca_abrir();
    
    $('#marca_guardar').on('click', function(){
        event.preventDefault();
        let data = {
            id:$("#id_marca").val(),
            nombre:$("#nombre_marca").val(),
            foto:'',
            peticion:'marcas',
            accion:'marca'
        };
        ws(data);
        document.getElementById("#marca_guardar").disabled = true;
        $('#marcas_ventana').show(200);
    });

    

    function marca(d){
        console.log(d);
        let v = d.out.id;
        console.log(v);
        
        $('#id_marca').val(v);
        lista_marcas();
    }

    function lista_marcas(){
        ws({
            id:$("#id_marca").val(),
            nombre:$("#nombre_marca").val(),
            foto:'',
            peticion:'marcas-lista',
            accion:'listar_marcas'
        });
    }
    function listar_marcas(d){
        console.log(d);
        let lista = d.out.ver.otFm;
        let modoEditor = $("#modoEditor").val();
        $("#botones_marcas").html('');
        $("#botones_marcas").append( '<a data-filtro="toda_lista_productos" href="#" class="btn-eff3 btn_menu_productos marca_abrir jmy_web_div" data-page="productos" id="btn_toda_lista_productos" data-editor="no"><i class="fa fa-plus"></i></a>' ); 
        marca_abrir();////toda_lista_productos
        if(lista!=undefined){
        for (let i = 0; i < lista.length; i++) {
            const element = lista[i];
            let boton_editar = (modoEditor) ? '<i class="fa fa-edit editar_marca" data-idmarca="'+element.ID_F+'"></i>  <i class="fa fa-plus editar_producto" data-idmarca="'+element.ID_F+'"></i></a>':'';

            $("#botones_marcas").append( '<a data-filtro="tab_'+element.ID_F+'" href="#" class="btn-eff3 btn_menu_productos jmy_web_div" data-page="productos" id="'+element.ID_F+'" data-editor="no">'+element.nombre_marca+' '+boton_editar+'</a>' );
        }
        comportamiento_producto();
        editar_marca();
        editar_producto();}
    }
    lista_marcas();
    
    
    function comportamiento_producto(){
        $(".btn_menu_productos").on('click',function(){
            event.preventDefault();
            let filtro =$(this).data('filtro');
            $(".toda_lista_productos").hide(200);
            $("."+filtro).show(250);
        });
    }
    function editar_producto(d=[]){
        console.log('editar_producto',d);

        $(".editar_producto").on('click',function(){
            $(".productos_detalles_editar").hide();
            let anuncio = 'Nuevo producto';
            $('#productos_ventana').show(200);
            let id_marca = $(this).data("idmarca");
            let id_producto = $(this).data("idproducto");
            $("#id_marca").val(id_marca);
            console.log('ID MARCA',id_marca);
            if(id_producto!=undefined && id_producto!=''){
                let tmp = producto_ver({
                    id:id_producto,
                    id_marca:id_marca
                });
                anuncio = 'Editando el producto ...';
                console.log('tmp',tmp);
            }

            $("#pnt_nombre_producto").html(anuncio);
            $("#editor_guardar").on('click',function(){
                guardar_producto({
                    id_producto:id_producto,
                    id_marca:id_marca
                });
            });
            
            btn_producto_borrar();
        });
        
    }
    
    function guardar_producto(d=[]){
        let guardar = {};
        let nombre = $("#NomP").val();
        if(nombre!=undefined && nombre!=''){
            $(".productos_detalles_editar").show(100);
            guardar.nombre = nombre;
            guardar.nombreEstado = $('input[name=NomPestado]:checked').val();
            guardar.codigo = $("#CodP").val();
            guardar.codigoEstado = $('input[name=CodPestado]:checked').val();
            guardar.precio = $("#PreP").val();
            guardar.precioEstado = $('input[name=PrePestado]:checked').val();
            guardar.descripcion = $("#DesP").val();
            guardar.descripcionEstado = $('input[name=DesPestado]:checked').val();
            guardar.foto_producto = $("#foto_producto").attr('src');
            
            d.guardar = guardar ;
            d.peticion = 'producto-editar';
            d.fn='cargar_campos_productos';


            console.log('guardar_producto',d);
            /* .... CELINA */



            
            console.log(ws(d));
        }
    }
    
    
    function cargar_campos_productos(d=[]){
        console.log('cargar_campos_productos',d);
        let editarID = d.out.ver.otKey[0];
        let page = (editarID!='' && editarID!=undefined)?editarID:d.out.id;
        let datos = d.out.ver.ot[page];
        console.log('datos',datos);
        if(datos!=undefined){
            let foto = (datos.foto_producto!=undefined && datos.foto_producto!='')?datos.foto_producto:'http://local.evolution.mx/templet/images/portfolio-images/portfolio-img1.jpg';
            $("#foto_producto").attr('src',foto);
            $("#NomP").val(datos.nombre);
            $("#CodP").val(datos.codigo);
            $("#PreP").val(datos.precio);
            $("#DesP").val(datos.descripcion);
            $("#pnt_nombre_producto").html('Editando el producto '+datos.nombre);
            /* ...... CELINA */
        }
        let opciones = [{
            type:"imagen",
            id:"foto_producto",
            idadd:"foto_producto",
            width:"490",
            height:"720",
        }];
        let imagen = '<div class="jmy_web_slider"  data-page="'+page+'"   data-tabla="productos"  id="marco_editar_producto"  data-marco="marco_editar_producto" data-var=\''+JSON.stringify(opciones)+'\'></div>';
       $("#pnt_foto_producto").html(imagen);
       cargaSlider();
              
       producto_lista();

    }
    /*
<div class="jmy_web_slider"  data-page="<?php echo $page; ?>"   data-tabla="vistaweb"  id="marco"  data-marco="marco"  <?php 
                          $va[] = [ "type"=>"imagen",
                            " id"=>"tab_imagenes_",
                        "class"=>"tab_imagenes_",
                    "idadd"=>"tab_imagenes_",
                 "width"=>"385",
                "height"=>"252",
            "url"=>$this->url_templet(["return"=>true]).' images/slides/sv1.jpg'  ];  ?>  data-var='<?php echo json_encode($va); ?>'></div>
    */
    function editar_marca(){

        $(".editar_marca").on('click',function(){
            $('#marcas_ventana').show(200);
            let id_marca = $(this).data("idmarca");
            console.log('ID MARCA',id_marca);
            
           marca_ver({
                id:id_marca
            });

            
        });
        
    }
    function marca_ver(d){ // producto_ver({id:5})
        return ws({ id:d.id, peticion:'marcas', accion:'marca_ver_accion' });
    }

    function producto_ver(d){ // producto_ver({id:5})
        console.log('producto_ver',d);
        
        return ws({ id:d.id,id_marca:d.id_marca, peticion:'productos', accion:'producto_ver_accion' });
    }

    function marca_ver_accion(d){ // producto_ver({id:5})
        const resultado = d.out.ver.ot[d.out.ver.otKey[0]];
        const id =d.out.ver.otKey[0];
        console.log("resultado",resultado);
        console.log("id",id);
        $("#id_marca").val(id);
        $("#idproducto").attr("data-idproducto",id);
        btn_producto_borrar();
        $("#nombre_marca").val(resultado.nombre_marca);
        //return ws({ id:d.id, peticion:'marcas' });
    }

    $(".actualizar_productos").on('click',function(){
        console.log('actualizar_productos');        
        producto_lista();
    });
    producto_lista();
    function imprimir_lista(d=[]){ 
        
        let lista = d.out.ver.otFm;
        console.log('imprimir_lista',lista);
        let h = '';

        let url = '';
        if(lista!=undefined){
            lista.forEach(e => {
                h = h+'<div class="portfolio dt-sc-one-fourth column no-space toda_lista_productos tab_'+e.id_marca+'"><figure><img src="'+((e.foto_producto!='' && e.foto_producto!=undefined)?e.foto_producto:location.origin+'/templet/images/portfolio-images/portfolio-img1.jpg')+'" alt="portfolio1" title=""><figcaption><div class="fig-content"><ul class="cart-whislist" style="width: 100%;"><li><a href="'+((e.foto_producto!='' && e.foto_producto!=undefined)?e.foto_producto:'templet/images/portfolio-images/portfolio-img1.jpg')+'" data-gal="prettyPhoto[gallery]" class="button wpshop-cart-button add_to_cart_button product_type_simple"><i class="fa fa-search-plus"></i></a></li><li style="width: 215px;"><a href="'+url+'"  style="width: 100%;">'+((e.nombre!='' && e.nombre!=undefined)?e.nombre:'Errro al cargar nombre')+' </a></li><li><a href="portfolio-details.html" ><i class="fa fa-external-link"></i></a></li><li><a href="" class="editor_abrir" data-idproducto="'+e.ID_F+'" ><i class="fa fa-edit"></i></a></li></ul></div></figcaption></figure></div>';
                
            });
            //console.log(h);
            
            $("#listado_productos").html(h);
            btn_editor_abrir();
            btn_producto_borrar();
        }
    }
    function producto_lista(){ // producto_nuevo({id_marca:5,nombre:"Nombre de"})
        ws({ 
            peticion:'productos-lista',
            fn:'imprimir_lista'
         });
    }


    function ws(d){
        console.log(d);
        $.ajax({
            url: location.origin + '/wsproductos/'+d.peticion,
            type: 'post',
            dataType: 'json',
            success: function(res) {
                //console.log(res);
                d.fn = (d.fn!='' && d.fn!=undefined) ?d.fn:d.accion;
                if(d.fn!=undefined)
                    eval(d.fn+'('+JSON.stringify(res)+')'); 
            },
            error: function(res) {
                console.log(res);
            },
            data: d
        });
    }

    
        $('#file-input').change(function(e) {
            addImage(e); 
            });

            function addImage(e){
            var file = e.target.files[0],
            imageType = /image.*/;
        
            if (!file.type.match(imageType))
            return;
        
            var reader = new FileReader();
            reader.onload = fileOnload;
            reader.readAsDataURL(file);
            }
        
            function fileOnload(e) {
            var result=e.target.result;
            $('#imgSalida').attr("src",result);
            }
   
 });

