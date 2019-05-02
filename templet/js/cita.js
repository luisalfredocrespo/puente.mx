jQuery(function ($) {  
    //console.log('hola');
    let fecha = "";
    let servicios = [];
    let personal = [];
    let ServicioPersonal = [];
    $(".hidden").hide(0);
    $(".paso1").css("color","green");
 

    function select_lista_perfiles(){
        let id_perfil = $("#id_perfil").val();
        console.log(id_perfil);
        if(id_perfil!=undefined && id_perfil!=''){
            $.ajax({
                url: location.origin + '/perfilws/lista_perfiles/',
                type: 'post',
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    
                    let lista = res.perfil.otFm;
                    console.log(lista);
                    let selec = $("#cita_id_perfil").val();
                    let h = '<option value="sinSeleccion" selected>Selecciona...</option>';
                    lista.forEach(e => {
                        let s = (selec==e.ID_F)?'selected':'';
                        h = h + '<option  value="'+e.ID_F+'" '+s+'>'+e.nombre+'</option>';
                    });
                    $("#select_lista_perfiles").html(h);

                
                },
                error: function(res) {
                    console.log(res);
                },
                data: {}
            });
        }else{
            swal({
                type: "error",
                title: "Error al solicitar perfiles",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: true
                }).then((result)=>{
                if(result.value){
                   window.location = "cita";
                   }
               });
        }
    }
    select_lista_perfiles();


    $("#btn_paso_1").click(function(){
        $(".paso1").css("color","");
        $(".paso2").css("color","#006400");
        console.log('paso 2');
        let valor = $("#select_lista_perfiles option:selected").val();
        console.log(valor);

        if (valor !== 'sinSeleccion') {
           
            mostrarServicios();
            $("#div_paso_1").hide(50);
            $("#div_paso_2").show(200);
        }else{
            swal(
              'Debes seleccionar para quien es el servicio!',
              'Pulsa el botón para continuar!',
              'warning'
            )

            }
    });

    $("#btn_paso_r1").click(function(){
        $(".paso2").css("color","");
        $(".paso1").css("color","#006400");
        console.log('regresar al paso 1');
        $("#div_paso_2").hide(50);
        $("#div_paso_1").show(200);
        
    });

    $("#btn_paso_2").click(function(){
        $(".paso2").css("color","");
        $(".paso3").css("color","#006400");
        console.log('paso 3');
        let fecha = $("#dpt").val();
        console.log(fecha);
        informacion_servicios = [];
        let servicios_seleccionados = [];
        $('.servicios_seleccionados').each(function(){
            let opcion = $("option:selected",this).val();
            if(opcion!=""){
                servicios_seleccionados.push(opcion);
            }
        });
        let sinRepetidos = servicios_seleccionados.filter((valor, indiceActual, arreglo) => arreglo.indexOf(valor) === indiceActual);
        servicios_seleccionados = sinRepetidos;
        console.log('servicios_seleccionados',servicios_seleccionados);
            
        if(fecha!=''){
            mostrarPersonal({
                servicios:servicios_seleccionados,
                fecha:fecha
            });
            $("#div_paso_2").hide(50);
            $("#div_paso_3").show(200);
        }else{
            swal({
                type: "warning",
                title: "Selecione una fecha",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: true
                }).then((result)=>{
               
               });
        }
        
    });

    $("#btn_paso_r2").click(function(){
        $(".paso3").css("color","");
        $(".paso2").css("color","#006400");
        console.log('regresar al paso 2');
        $("#div_paso_3").hide(50);
        $("#div_paso_2").show(200);
    });



    function mostrarServicios(){
        var fn_select = function (d=[]) {
            $(".servicios_p").each(function(e){
                let h = $(this).html();
                if(h.trim()===''){
                    $(".servicios_p").html('<select class="servicios_seleccionados"><option value="">Seleccionar</option></select>');
                    for (var i = 0 ; i < d.servicios.length ; i++) {
                        let selected  = (d.id==d.servicios[i].ID_F) ? true:false;
                        $(this).find('select').append(new Option(d.servicios[i].nombre, d.servicios[i].ID_F,0,selected));
                    }  
                    $(".servicios_p").addClass('servicios_final');
                    $(".servicios_final").removeClass('servicios_p');
                }
            });
        }
        $.ajax({
            url: location.origin + '/serviciows/',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $("#servicios").html('');
                servicios = res.out.lista.otFm;
                console.log(servicios);
                if(servicios!=null){
                    $("#lista_servicios").html('<div id="listado"><p class="servicios_p"></p></div><p><button class="btn btn-info btn-sm btn-flat" id="agregar_servicio">Agregar servicio</button></p>');
                    
                    $("#agregar_servicio").on('click', function(){
                        $.when($("#listado").append('<p class="servicios_p"></p>')).done(function () {
                            fn_select({servicios:servicios,id:id});
                        });   

                    });
                    let id = $("#cita_nombre").val();
                    fn_select({servicios:servicios,id:id});
                }else{ 
                    swal({
                        type: "warning",
                        title: "Selecione una fecha",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: true
                        }).then((result)=>{
                       
                       });
                }

            },
            error: function(res) {
                console.log(res);
            },
            data: {}
        });
    }
 


  /*  function selectHorario(inicio,fin){
        for ( i = inicio ; i < fin; i++) {
            $("#horario").append(new Option(i+"Hrs",i));
           console.log(i+"Hrs");
           //personal[i];
       }
    }*/

    function listaDias(d=[]) {
        let dias =d.dia;
        let empleado = d.empleados;
        let ID_F =d.ID_F;
        let horas_dia =[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23];
        let horasOcupadas ={0:0,1:0,2:0,3:0,4:0,5:0,6:0,7:0,8:0,9:0,10:0,11:0,12:0,13:0,14:0,15:0,16:0,17:0,18:0,19:0,20:0,21:0,22:0,23:0};
        let total_horas = 0;
        let temp_horas = 0;
        let hora_entrada = 0;
        let hora_salida = 0;
        let ciclo = 0;
        /*let porcentaje = 100 / 24;
        
        let hora_ocupada = '<div class="progress-bar bg-success" role="progressbar" style="width: '+porcentaje+'%" aria-valuenow="'+porcentaje+'" aria-valuemin="0" aria-valuemax="100"></div>';
        let hora_libre = '<div class="progress-bar bg-dark" role="progressbar" style="width: '+porcentaje+'%" aria-valuenow="'+porcentaje+'" aria-valuemin="0" aria-valuemax="100"></div>';*/

        dias.forEach(e => {
            //if(diasActivos[e]==1){
                $("#listado_dias").append(
                ' <div class="row ser_list" id="'+ID_F+'" data-idf="'+ID_F+'"><div id="nombre_'+ID_F+'" class="col-md-4">SERVICIO:<p >'+d.nombre+'</p></div><div class="col-md-4"><div class="" data-delay="100" data-animation="fadeIn"><p>Quien quieres que te atienda:</p><p><select id="personal_'+ID_F+'"></select></p></div></div><div class="col-md-4"><div class="" data-delay="300" data-animation="fadeIn"><p>Horario: <select id="horario_'+ID_F+'"><option value="sin_elegir">Elige un empleado</option></select></p></div></div></div><hr>');
                
                //console.log('horario_general['+e+']',horario_general);
                if(horario_general[e]!=''&&horario_general[e]!=undefined){
                    let turnos = horario_general[e].length;
                    console.log('turnos '+e+':',turnos);
                    if(turnos==1){
                        hora_entrada = horario_general[e][0].h_entrada;
                        //console.log('hora_entrada['+e+']',hora_entrada);
                        hora_salida = horario_general[e][0].h_salida;
                        //console.log('hora_salida['+e+']',hora_salida);
                        temp_horas = hora_salida - hora_entrada;
                        horas_dia.forEach(element => {
                            //console.log(horasOcupadas[element]);
                            if(horas_dia[element]<hora_entrada-1){
                                horasOcupadas[element] = 0;
                            }else if(horas_dia[element]>hora_salida-1){
                                horasOcupadas[element] = 0;
                            }else{
                                horasOcupadas[element] = 1;
                            }
                            //let progress = (horasOcupadas[element]==1)?hora_ocupada:hora_libre;
                            //$('#progress_horas_'+e).append(progress);
                        });
                        //console.log('horas ocupadas '+e+'',horasOcupadas);
                    }else{
                        for(ciclo = 0 ; ciclo < turnos ; ciclo++){
                            hora_entrada = horario_general[e][ciclo].h_entrada;
                           // console.log('hora_entrada['+e+']',hora_entrada);
                            hora_salida = horario_general[e][ciclo].h_salida;
                           // console.log('hora_salida['+e+']',hora_salida);
                            temp_horas = hora_salida - hora_entrada;
                            total_horas += temp_horas;
                            horas_dia.forEach(element => {
                                //console.log(horasOcupadas[element]);
                                if(horas_dia[element]<hora_entrada-1){
                                    //horasOcupadas[element] = 0;
                                }else if(horas_dia[element]>hora_salida-1){
                                    //horasOcupadas[element] = 0;
                                }else{
                                    horasOcupadas[element] = 1;
                                }
                            });
                        }
                        horasOcupadas = {};
                    }
                    console.log("d",d);
                    console.log('horas ocupadas '+e+'',horasOcupadas);
                    horas_dia.forEach(element => {
                        if(horasOcupadas[element]==1){
                            $("#horario_"+ID_F).append('<option value="'+(element+1)+'">'+(element+1)+' hrs</option>');
                            //$("#horario_"+ID_F).append('<option value="'+element+'">'+element+' hrs</option>');
                        }
                    });
                    //let t_horas = (turnos==1)?temp_horas:total_horas;
                   // $("#totalHoras_"+e).append('<small>'+t_horas+' horas en total</small>');
                    //total_horas = 0;
                
                }
            //}
        });
        $('#personal_'+ID_F).append('<option>Seleccionar</option>');
        //console.log('empleado',empleado);
        let i = 0;
        if(empleado!=undefined){
            empleado.forEach(e => {
                //console.log('e.servicios',e.serviciosAgregados);
                e.serviciosAgregados.forEach(elem => {
                    //console.log('Servicios de empleado '+e.nombre+':',elem.nombreServicio);
                    if(elem.nombreServicio == d.nombre){
                        $('#personal_'+ID_F).append('<option value="'+e.ID_F+'">'+e.nombre+'</option>');
                        i++;
                        //console.log('Empleado que da el servicio de '+elem.nombreServicio+':',e.nombre);
                    }
                });
            });
        }
        if(i==0){
            $('#personal_'+ID_F).html('<option value="sin_personal">No hay personal disponible</option>');
            $('#personal_'+ID_F).attr('disabled',true);
            $('#horario_'+ID_F).html('<option value="sin_horario"></option>');
            $('#horario_'+ID_F).hide();
        }
        $('#personal_'+ID_F).change(function(){
            if($('#personal_'+ID_F).val()!="Seleccionar"){
                let empleado_elegido = $('#personal_'+ID_F).val();
                console.log("empleado_elegido",empleado_elegido);
                if(empleado_elegido!=""&&empleado_elegido!=undefined){
                    empleado.forEach(e => {
                        if(e.ID_F == empleado_elegido){
                            let resul = [];
                            $('#horario_'+ID_F).html('');
                            $('#horario_'+ID_F).append('<option value="sin_elegir">Seleccionar</option>');
                            e.dias[dias].forEach(element => {
                                resul.push(element);
                                //console.log("element de empleado_elegido",resul);
                                resul.forEach(el => {
                                    hora_entrada = element.h_entrada;
                                    hora_salida = element.h_salida;
                                    horas_dia.forEach(ho => {
                                        if(horas_dia[ho] < hora_entrada){
                                        }else if(horas_dia[ho] > hora_salida-1){
                                        }else{
                                            $('#horario_'+ID_F).append('<option value="'+ho+'">'+ho+' hrs</option>');
                                        }
                                    });
                                });
                            });
                        }
                    });
                }
            }else{
                $('#horario_'+ID_F).html('');
                $('#horario_'+ID_F).append('<option value="sin_elegir">Elige un empleado</option>');
            }
        });
        $('#horario_'+ID_F).change(function(){
            if($('#horario_'+ID_F)!="Seleccionar"){
                //console.log("tamaño del arreglo de informacion_servicios",informacion_servicios.length);
                if(informacion_servicios.length==0){
                    informacion_servicios.push({
                        servicio:d.nombre,
                        empleado:$('#personal_'+ID_F+' option:selected').val(),
                        hora:$('#horario_'+ID_F+' option:selected').val()
                    });
                }else{
                    let indice = 0;
                    informacion_servicios.forEach(element => {
                        console.log(element.servicio,d.nombre)
                        if(element.servicio == d.nombre){
                            informacion_servicios.splice(indice,1);
                        }
                        indice = indice + 1;
                        //console.log(indice);
                    });
                    informacion_servicios.push({
                        servicio:d.nombre,
                        empleado:$('#personal_'+ID_F+' option:selected').val(),
                        hora:$('#horario_'+ID_F+' option:selected').val()
                    })
                }
                console.log("informacion_servicios",informacion_servicios);
            }
        });

    }

    let diasActivos = [];
    let horario_general = [];
    let informacion_servicios = [];
    function mostrarPersonal(data){
        let servicios_ele = data.servicios;
        console.log(servicios_ele);

    	$.ajax({
            url: location.origin + '/citaws/verPersonaHorario',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $("#personal").html('');
                $("#listado_dias").html('');
                let empleado = res.out.empleado;
                let servicios = res.out.catalogo_servicios.otFm;
                //console.log(servicios,empleado);

                //console.log("info_empleados",info_empleados);
                if(servicios!=undefined&&servicios_ele!=undefined){
                    servicios_ele.forEach(el => {
                        servicios.forEach(e => {
                            //console.log(e.ID_F,el);
                            if(e.ID_F==el){
                                //console.log(e.ID_F,el,"COINCIDIO...!!!!");
                                listaDias({
                                    ID_F:e.ID_F,
                                    nombre:e.nombre,
                                    servicio:e,
                                    dia:[res.out.dia_semana_nombre],
                                    empleados:empleado
                                });
                            }
                        });
                    });
                    
                }

                /*diasActivos =res.out.empleado[0].diasActivos;
                horario_general =res.out.empleado[0].dias;
                let servicios = res.out.catalogo_servicios.otFm;
                console.log(diasActivos);
                console.log(horario_general);
                console.log(servicios);
                $("#listado_dias").html('');
                if(servicios!=undefined)
                    servicios.forEach(e => {
                        listaDias({
                            ID_F:e.ID_F,
                            nombre:e.nombre,
                            servicio:e,
                            foto_perfil:e.foto_perfil,
                            dia:[res.out.dia_semana_nombre],
                            respuesta:res.out
                        });
                    });*/
                
             /*   personal = res.out.ResultadoNombre.otFm;
                ServicioPersonal = res.out.resultado.otFm;

                console.log(personal);
                console.log(ServicioPersonal);
                if(personal!=undefined)
                    for (var i = 0 ; i < personal.length ; i++) {
                        $("#personal").append(new Option(personal[i].nombre, personal[i].perfil_principal));
                        //console.log(personal[i]);
                        //personal[i];
                    }
                    */
            },
            error: function(res) {
                console.log(res);
            },
            data: data
        });
    }
    function verPersonaHorario(data){
    	/*$.ajax({
            url: location.origin + '/citaws/verPersonaHorario',
            type: 'post',
            dataType: 'json',
            success: function(res) {
                console.log(res);
                
                let horario = res.out.horario;
                console.log(horario);
                $("#horario").html('');
                
                for ( let i = 0 ; i < horario.length; i++) {
                    $("#horario").append(new Option(horario[i]+" Hrs",horario[i]));
                    //console.log(i+"Hrs");
                }                
            },
            error: function(res) {
                console.log(res);
            },
            data: data
        });*/
    }

    $( "#personal" ).click(function() {
        //console.log('hola');
      
        verPersonaHorario({
            servicios:$("#servicios option:selected").val(),
            fecha:$("#dpt").val(),
            persona:$("#personal").val(),
        });

    });

    $( "#dpt" ).change(function() {
        console.log('hola');
        
    });

    function guardarCita(d=[]){
        console.log('datos a guardar');
        let datosCita = {
            cliente: $("#select_lista_perfiles option:selected").val(),
            fecha:$("#dpt").val()
        };
        let guardar = d;
        if(guardar!=undefined){
            console.log("guardar",guardar);
            guardar.forEach(element => {     
                let id_servicio = element.servicio;
                $.ajax({
                    url: location.origin + '/citaws/guardarCita',
                    type: 'post',
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        if(res.out.error!=''){
                            /*swal({
                                type: "error",
                                title: res.out.error,
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: true
                                }).then((result)=>{
                                if(result.value){
                                    verPersonaHorario({
                                        servicios:$("#servicios option:selected").val(),
                                        fecha:$("#dpt").val(),
                                        persona:$("#personal").val(),
                                    });
                                   //window.location = "cita";
                                   }
                               });*/
                                swal({
                                    type: "error",
                                    title: "Ya existe una cita en esta hora",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: true
                                    }).then((result)=>{
                               
                                });
                                    console.log(id_servicio);
                                $('#horario_'+id_servicio).css("border","1.5px solid red");
                                $('#horario_'+id_servicio).click(function(){
                                    $('#horario_'+id_servicio).css("border","");
                                });
                        }else{
                            $.when(swal({
                                type: "success",
                                title: "¡Cita agendada!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: true
                                }).then((result)=>{
                                    if(result.value){
                                       //window.location = "cita";
                                    }
                               })).done(function (){
                                  
                               });
                               let div_idServicio = element.servicio;
                               console.log("guardar element",div_idServicio);
                               $('#'+div_idServicio).remove();
                               let contador = 0;
                                $('.ser_list').each(function(){
                                    console.log("Hola");
                                    contador++;
                                });
                                //console.log("contador",contador);
                                if(contador==0){
                                    window.location = "cita";
                                }
                                $(".servicios_seleccionados").each(function(){
                                    let s = $("option:selected",this).val();
                                    //console.log("Servicios select-valor",s);
                                    if(s==div_idServicio){
                                        $(this).remove();
                                    }
                                });
                        }
                    },
                    error: function(res) {
                        console.log(res);
                    },
                    data: {
                        datosCita:datosCita,
                        guardar:element
                    }
                });
            });
            
        }
        
        
        let ServiciosElegidos = [];
        $(".ser_list").each(function(){
            let r = $(this).data("nom");
            //console.log("Servicios seleccionados:",r);
            ServiciosElegidos.push(r);
        });
        console.log(ServiciosElegidos);
            let data = { servicios:ServiciosElegidos,
                persona:$("#personal option:selected").val(),
                horario:$("#horario option:selected").val(),
                id_perfil:$("#select_lista_perfiles option:selected").val(),
                fecha:$("#dpt").val()}
    	return true;
    }



	/*$("#dpt").datepicker({
        minDate:0,
    });*/
   


    $("#btn_guardar").click(function(){
        let numero = 0;
        let error = 0;
        let guardar = [];
        $(".ser_list").each(function(e){
            let id = $(this).data('idf');
            let ver ={
                empleado:$("#personal_"+id).val(),
                horario:$("#horario_"+id).val(),
                servicio:id,
            };
            console.log('info ',ver);            
            if(ver.empleado!='sin_personal'){
                if(ver.empleado!='sin_elegir' && ver.horario!='sin_elegir'){
                    guardar.push(ver);
                }else{
                    error++;
                }
            }
        });
        
        console.log('guardar',guardar);

        if(error!=0)
            swal({
                type: "warning",
                title: "Complete todos los campos",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
                closeOnConfirm: true
                }).then((result)=>{
                       
           });
        else{
            //datosCita();
            $.when(guardarCita(guardar)).done(function(){
                swal({
                    type: "success",
                    title: "Cita agendada",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: true
                    }).then((result)=>{
               });
            });
            
            
        }
        
        //

    });

    function alerta(d=[]){
        //window.location:cita;
         swal({
             type: "success",
             title: "¡Cita agendada!",
             showConfirmButton: true,
             confirmButtonText: "Cerrar",
             closeOnConfirm: true
             }).then((result)=>{
             if(result.value){
                window.location = "cita";
                }
            });
    }






    /*("#dpt").datepicker({
        dateFormat: "D, M d, yy",
        altField: "#altField",
        altFormat: "yy-mm-dd"
    });
    $('#dpt').on('change', function() {
        fecha =  $("#altField").val(); 
    });*/
});