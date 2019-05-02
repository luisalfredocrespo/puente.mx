jQuery(function($){
    $(document).ready(function () {
     // $("#txtCheckin").datepicker({minDate:0});
            $("#txtCheckin").datepicker({
                minDate:0,
                language: 'es',
                dateFormat: "dd-mm-yy",
                onSelect: function (date) {
                    var date2 = $('#txtCheckin').datepicker('getDate');
                    date2.setDate(date2.getDate());
                    $('#txtCheckout').datepicker('setDate', date2);
                    //sets minDate to dateofbirth date + 1
                    $('#txtCheckout').datepicker('option', 'minDate', date2);
                }
            });
            $('#txtCheckout').datepicker({
                dateFormat: "dd-mm-yy",
                onClose: function () {
                    var dt1 = $('#txtCheckin').datepicker('getDate');
                    console.log(dt1);
                    var dt2 = $('#txtCheckout').datepicker('getDate');
                    if (dt2 <= dt1) {
                        var minDate = $('#txtCheckout').datepicker('option', 'minDate');
                        $('#txtCheckout').datepicker('setDate', minDate);
                    }
                }
            });
    });
    mostrarHabitaciones();
    function mostrarHabitaciones(){
        var hab_unicas = [];
        $.ajax({
            url:location.origin + '/reservacionws/verHabitacion',
            type:'post',
            dataType:'json',
            success:function(respuesta){
                let hab = respuesta.out.tipo_hab.otFm;

                console.log(hab);
                if(hab!=undefined){
                    $('#habitaciones').html('');
                    $('#habitaciones').append('<option>Seleccionar</option>');
                    hab.forEach(element => {
                        hab_unicas.push(element.habitacion);  
                    });

                    let sinRepetir = hab_unicas.filter((valor, indiceActual, arreglo) => arreglo.indexOf(valor) === indiceActual);

                    sinRepetir.forEach(ele=>{
                         $('#habitaciones').append('<option>'+ele+'</option>');
                    });
                }else{
                    $('#habitaciones').html('');
                    $('#habitaciones').append('<option>No hay habitaciones</option>');
                }

            },error: function(res) {
                console.log(res);
            },
            data:{}
        });
    }

    $("#adultos").html('');
    $("#ninos").html('');
    for (var i = 0; i <= 8; i++) {
        if(i != 0){
            $("#adultos").append('<option value="'+i+'">'+i+'</option>');
        }
        if(i<4){
            $("#ninos").append('<option value="'+i+'">'+i+'</option>');
        }
    }

    $("#inf").hide(50);

    $("#reservacion_cita").click(function(){
        var adultos = $("#adultos option:selected").val();
        var ninos = $("#ninos option:selected").val();
        var habitacion = $("#habitaciones option:selected").val();
        console.log(adultos,ninos,habitacion);
        
        $("#inf").show(100);
        //$("#inf").toggle();
    });

    $(".enviar").click(function() {
       $(".filtro_habitacion").html('');
       mostrarTodasHabitaciones();
    });

    $(".cerrar").click(function(){
       $("#inf").hide(50); 
    })

    /*$(".agendar").on("click",function(){
        //console.log("hola");
        guardarReservacion();
        $("#reservacion_cita").val('1 Adulto - 0 Niños - 1 Habitación');
        $("#adultos option:selected").val("1");
        $("#ninos option:selected").val("0");
        $("#habitaciones option:selected").val("1");
        //$('#edad_ninos').html('');
        $("#txtCheckin").val('Fecha de Entrada');
        $("#txtCheckout").val('Fecha de Salida');   
    });*/

    $("#adultos").change(function(){
        $("#reservacion_cita").html('');
        seleccionar();
    });

    $("#ninos").change(function(){
        $("#reservacion_cita").html('');
        $('#edad_ninos').html('');
        seleccionar();
        var cantidad_ninos = Number($("#ninos option:selected").val());
        console.log(cantidad_ninos);
        for (var i = 1; i <= cantidad_ninos ; i++) {
            $('#edad_ninos').append('Menor '+i+'<select class="menores" id="menor_'+i+'" data-menor="menor'+i+'"></select>');
            for (var x = 0 ; x <= 17 ; x++) {
                $('#menor_'+i).append('<option>'+((x==0)?'<1':x)+'</option>');
            }
        }
    });

   /* $("#habitaciones").change(function(){
        $("#disponibilidad").html('');
        let hab = $('#habitaciones option:selected').val();
        let num_hab = 0;
        if(hab=="Individual"){
            num_hab = 5;
        }else if(hab=="Doble"){
            num_hab = 10;
        }else if(hab=="Suite"){
            num_hab = 3;
        }
        if(num_hab!=0){
            for (var i = 1; i <= num_hab; i++) {
                $("#disponibilidad").append('<div><label class="checkbox-inline"><input type="checkbox" value=""> Cuarto '+i+'</label></div>');
            }
        }
    });*/

    function seleccionar(){
        $("#reservacion_cita").html('');
        var adultos = $("#adultos option:selected").val();
        var ninos = $("#ninos option:selected").val();
        $("#reservacion_cita").val(adultos + ((adultos<2)?' Adulto - ':' Adultos - ') + ninos + ((ninos==1)?' Niño':' Niños'));
        console.log('adultos',adultos,"ninos",ninos);
    }

    function mostrarTodasHabitaciones(){
         let datoHabitacion = {
            fechaI: $("#txtCheckin").val(),
            fechaF: $("#txtCheckout").val(),
            habitacion: $("#habitaciones option:selected").val()
        }
        console.log(datoHabitacion);
         $.ajax({
            url:location.origin + '/reservacionws/mostrarHabitacion',
            type:'post',
            dataType:'json',
            success:function(respuesta){
                console.log("respuesta",respuesta);
                var datosHabitacion = respuesta.out.t_habitacion.otFm;
                if ($("#habitaciones option:selected").val() != "Seleccionar") {
                    datosHabitacion.forEach(ele=>{ 
                        $(".filtro_habitacion").append('<button class="text-capitalize validar" idHabitacion="'+ele.ID_F+'" style ="height: 50px; width: 40px;margin: 15px 10px; float:left; background: #03cbf8d1; border: none; border-radius:10px;">'+ele.habitacion+'</button>');
                    });
                }
               $(".validar").click(function() {
                    var fI= $("#txtCheckin").val();
                    var fF= $("#txtCheckout").val();
                    var as= $("#adultos option:selected").val();
                   var idHab = {
                        idH : $(this).attr("idHabitacion")
                    };
                    $("#ident_f").val($(this).attr("idHabitacion"));
                    
                    $.ajax({
                        url:location.origin + '/reservacionws/datos_habitacion',
                        type:'post',
                        dataType:'json',
                        success:function(respuesta){
                            console.log("hola",respuesta);
                            var res = respuesta.out.dato_habitacion.otFm;
                            res.forEach(ele=>{                                
                            $(".info_Reservacion").append('<div class="form-row">'+
                                    '<div class="col">'+
                                        '<label for="fi">Fecha de entrada</label>'+
                                        '<input type="text" id="" name="fi" class="form-control" value="'+fI+'" readonly>'+
                                    '</div>'+
                                    '<div class="col">'+
                                        '<label for="fi">Fecha de Salida</label>'+
                                        '<input type="text" class="form-control" id="" name="ff" value="'+fF+'" readonly>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="form-row">'+
                                    '<div class="col">'+
                                        '<label for="ad">Adultos</label>'+
                                        '<input type="text" id="" name="ad" class="form-control" value="'+as+'" readonly>'+
                                    '</div>'+
                                    '<div class="col">'+
                                        '<label for="ni">Niños</label>'+
                                        '<input type="text" class="form-control" id="" name="ni" readonly>'+
                                    '</div>'+
                                '</div>'+

                                '<div class="form-row">'+
                                    '<div class="col">'+
                                        '<label for="nh"># habitacion</label>'+
                                        '<input type="text" id="" name="nh" class="form-control" value="'+ele.num_habitacion+'" readonly>'+
                                    '</div>'+
                                    '<div class="col">'+
                                        '<label for="tp">Tipo de habitación</label>'+
                                        '<input type="text" class="form-control text-capitalize" value="'+ele.habitacion+'" id="" name="tp" readonly>'+
                                    '</div>'+
                                '</div>'+
                                '<hr>'+
                                '<div class="form-group">'+
                                    '<label for="">Servicios:</label><br>'+
                                    '<label>'+ele.complementos+
                                    '</label>'+
                                '</div>'+
                                '<div class="form-group text-right">'+
                                    '<label for="">Precio</label>'+
                                    '<label>$'+ele.precio+'</label>'+
                                '</div>'+
                                '<hr>'+
                                '<button class="agendar">Reservar</button>')
                            });
                        },error: function(res) {
                            console.log(res);
                        },
                        data:{"idHab":idHab}
                    });
                    $(".info_Reservacion").html('');
                });
            },error: function(res) {
                console.log(res);
            },
            data:{"datoHabitacion":datoHabitacion}
        }); 

    }

    $(".info_Reservacion").on('click', 'button.agendar', function() {
       console.log("enviando datos..");
       guardarReservacion();
       msj_success();
    });

    function guardarReservacion(){  
        console.log("Datos a guardar");
        let edad_menores = [];
        $(".menores").each(function(){
            let edadM = $("option:selected",this).val();
            let data = $(this).data("menor");
            //console.log(data,edad);
            let m = {menor:data,edad:edadM};
            edad_menores.push(m);
        });
        console.log(edad_menores);
         datosReservacion = {
            fechaI: $("#txtCheckin").val(),
            fechaF: $("#txtCheckout").val(),
            adultos: $("#adultos option:selected").val(),
            nino: ((edad_menores.length>0)?edad_menores:0),
            habitacion: $("#habitaciones option:selected").val(),
            identificador: $("#ident_f").val()
        }
        $.ajax({
            url:location.origin + '/reservacionws/guardarReservacion',
            type:'post',
            dataType:'json',
            success:function(respuesta){
                console.log(respuesta);  
            },error: function(res) {
                console.log(res);
            },
            data:{
                "datosReservacion":datosReservacion
            }
        });
        console.log(datosReservacion);
    }
    
    function msj_success(d=[]){
         swal({
             type: "success",
             title: "Habitación reservada!",
             showConfirmButton: true,
             confirmButtonText: "Cerrar",
             closeOnConfirm: true
             }).then((result)=>{
             if(result.value){
                window.location = "reservacion";
                }
            });
    }

});

