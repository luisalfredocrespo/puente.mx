console.log('hola');

jQuery(function($){

    function cargarCarousel(carousel){
        console.log('cargarCarousel',carousel);
        
        $('.'+carousel).carouFredSel({
            responsive: true,
            auto: false,
            width: '100%',
            height: 'variable',
            prev: '.'+carousel+'-prev-arrow',
            next: '.'+carousel+'-next-arrow',
            scroll: 1,				
            items: {
            width: $(this).find('.column').width(),
            height: 'variable',
            visible: {
                min: 1,
                max: 2
            }
            }				
        });
    }

    function serviciosws(){
        let carousel = 'dt-sc-pricing-carousel'; // nom. class del inicio Carrusel
        $.ajax({
            url: location.origin + '/iniciows/servicios/',
            type: 'post',	
            dataType: 'json',
            success: function(res) {
                console.log(res);
                let salto_columnas=10;
                $('.'+carousel).html('');
                let columnas=Math.round(2+(salto_columnas/res.length));
                let html = '';
                console.log(columnas);
                let count = 0;
                let filas=Math.round(res.length/columnas);
                console.log(filas);
                
                for (let i = 0; i < columnas; i++) {
                    html = html + '<div class="column dt-sc-one-half"><ul class="menu-card check">'; // contenedor de las tablas
                    for (let o = 0; o < filas; o++) {
                        const resultado = res[count];
                        count++;
                        console.log(resultado);
                        if(resultado!=undefined)
                            html = html + '<li><div class="jmy_web_div" data-page="'+resultado.ID_F+'" data-tabla="catalogos" id="nombre__'+i+o+'" data-editor="no">'+resultado.nombre+'</div><span><div class="jmy_web_div" data-page="'+resultado.ID_F+'" data-tabla="catalogos" id="precio__'+i+o+'" data-editor="no">'+((resultado.precio!=undefined)?resultado.precio:'$75')+'</div></span></li>';

                    }
                    html = html + '</ul></div>';
                }
                $('.caroufredsel_wrapper').css('height',(filas*51));
                $('.'+carousel).html(html);
                jmy_web_div_click();
                console.log(html);
                
                cargarCarousel(carousel);

            },
            error: function(res) {
                console.log('Error de servidor, listas no cargadas',res);
            },
            data: {}
        });
    }
 
    function serviciosws1(){
        let carousel = 'dt-sc-offer-carousel-wrapper animate fadeIn animated';
        $.ajax({
            url: location.origin + '/iniciows/servicios1/',
            type: 'post',	
            dataType: 'json',
            success: function(res) {
                console.log(res);
                let salto_columnas=10;
                $('.'+carousel).html('');
                let columnas=Math.round(2+(salto_columnas/res.length));
                let html = '';
                console.log(columnas);
                let count = 0;
                let filas=Math.round(res.length/columnas);
                console.log(filas);
                
                for (let i = 0; i < columnas; i++) {
                    html = html + '<div class="dt-sc-offer"><figure class="gallery-thumb">';
                    for (let o = 0; o < filas; o++) {
                        const resultado = res[count];
                        count++;
                        console.log(resultado);
                        if(resultado!=undefined)
                            html = html + '<li><div class="jmy_web_div" data-page="'+resultado.ID_F+'" data-tabla="catalogos" id="nombre__'+i+o+'" data-editor="no">'+resultado.nombre+'</div><span><div class="jmy_web_div" data-page="'+resultado.ID_F+'" data-tabla="catalogos" id="precio__'+i+o+'" data-editor="no">'+((resultado.precio!=undefined)?resultado.precio:'$75')+'</div></span></li>';

                    }
                    html = html + '</figure></div>';
                }
                $('.caroufredsel_wrapper').css('height',(filas*51));  //nom cont prin
                $('.'+carousel).html(html);
                jmy_web_div_click();
                console.log(html);
                
                cargarCarousel(carousel);

            },
            error: function(res) {
                console.log(res);
            },
            data: {}
        });
    }

    function serviciosws2(){
    let carousel = 'author';
    $.ajax({
        url: location.origin + '/iniciows/servicios2/',
        type: 'post',	
        dataType: 'json',
        success: function(res) {
            console.log(res);
            let salto_columnas=10;
            $('.'+carousel).html('');
            let columnas=Math.round(2+(salto_columnas/res.length));
            let html = '';
            console.log(columnas);
            let count = 0;
            let filas=Math.round(res.length/columnas);
            console.log(filas);
            
            for (let i = 0; i < columnas; i++) {
                html = html + '<div class="dt-sc-testimonial-carousel-wrapper"><ul class="dt-sc-testimonial-carousel">';
                for (let o = 0; o < filas; o++) {
                    const resultado = res[count];
                    count++;
                    console.log(resultado);
                    if(resultado!=undefined)
                        html = html + '<li><div class="jmy_web_div" data-page="'+resultado.ID_F+'" data-tabla="catalogos" id="nombre__'+i+o+'" data-editor="no">'+resultado.nombre+'</div><span><div class="jmy_web_div" data-page="'+resultado.ID_F+'" data-tabla="catalogos" id="testimonio__'+i+o+'" data-editor="no"></div></span></li>';

                }
                html = html + '</ul></div>';
            }
            $('.caroufredsel_wrapper').css('height',(filas*51));
            $('.'+carousel).html(html);
            jmy_web_div_click();
            console.log(html);
            
            cargarCarousel(carousel);

        },
        error: function(res) {
            console.log(res);
        },
        data: {}
    });
    }


    $(document).ready(function(){
        serviciosws();
        serviciosws1();
        serviciosws2();
    });
});

 