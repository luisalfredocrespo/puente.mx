
let eventos = [];
    jQuery(function($){
        $(document).ready(function () {
           lista();
        });
    });

function lista(d=[]) {
    jQuery(function ($) {    
        $.ajax({
            url: location.origin+"/administradorws/citas",
            type:"post",
            dataType:"json",
            data:{dato:"dato"},
            success:function(respuesta){
                let eventosJson = respuesta.propiedad;
                eventosJson.forEach(ele => {
                  if(ele.color=="espera"){
                    ele.color = '#0080FF';
                  }
                  if(ele.color=="cancelado"){
                    ele.color = '#FE2E2E';
                  }
                  if(ele.color=="finalizado"){
                    ele.color = '#2EFE2E';
                  }
                });
                var idioma = 'es';
                var calendarEl = document.getElementById('calendar');
                var f = new Date();
                var calendar = new FullCalendar.Calendar(calendarEl, {
                  header:{
                     left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                  },
                  defaultDate:f,
                  locale:idioma,
                  navLinks: true,
                  editable: false,
                  eventLimit: true,
                  events: eventosJson,
                  eventClick: function(info) {
                    detalles({
                      id:info.event.id
                    });
                    info.el.style.borderColor = 'red';
                  },
                });          
                calendar.render();
            },error:function (e) {
              swal({
                type:"error",
                text:"Upss a pasado algo",
                 confirmButtonText: 'Cerrar'
              })
            }
        });
        
    });
}

function detalles(d=[]){
  jQuery(function ($) {    
    $.ajax({
        url: location.origin+"/administradorws/citas/"+((d.id!=undefined)?d.id:''),
        type:"post",
        dataType:"json",
        data:{dato:"dato"},
        success:function(respuesta){
            let datos = respuesta;
            let i = 0;
            console.log('dato',datos);
            console.log('Detalles de la cita',respuesta);
            
            let fecha = respuesta.detalles[0]["fecha"];
            console.log(fecha);

            $.when(swal({
                  title: '<h1><b>Detalles de la cita.</b></h1>',
                  html:'<p>Fecha: '+respuesta.detalles[0]["fecha"]+'</p><p>Servicio: '+respuesta.detalles[0]["servicio"]+'</p><p>Horario: '+respuesta.detalles[0]["horario"]+':00:00</p><p>Cliente: '+respuesta.detalles[0]["usuario"]+'</p><p>Empleado: '+respuesta.detalles[0]["empleado"]+'</p><div type="json_campos" class="jmy_web_administrador col-md-12" id="estado" data-idregistro="cambio_estado" data-tabla="citas__agendarcita" data-page="'+d.id+'" >Error al cargar Módulo</div>',
                  confirmButtonColor: '#3885d6',
                  confirmButtonText: 'Cerrar',
                }).then((result) => {
                      if (result.value) {
                        lista();
                        $("#calendar").html("");
                      }
                    }
                  )
                ).done(function(){
                  
                });

                 jmywajson_campos();
                 
        },error:function (e) {  
        }
    });
    
  });
}

