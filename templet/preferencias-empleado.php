<style>
.preferencias-empledo, .form-group{
    width: 31%;
    float: left;
    margin: -0px 5%;
    min-width: 60px;
}
.borde-redondeado{
    border-radius:5px;
    padding:20px;
}
.fondo-amanecer{
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#e1ffff+0,e1ffff+7,e1ffff+12,fdffff+12,e6f8fd+30,c8eefb+54,bee4f8+75,b1d8f5+100;Blue+Pipe+%232 */
background: rgb(225,255,255); /* Old browsers */
background: -moz-linear-gradient(top, rgba(225,255,255,1) 0%, rgba(225,255,255,1) 7%, rgba(225,255,255,1) 12%, rgba(253,255,255,1) 12%, rgba(230,248,253,1) 30%, rgba(200,238,251,1) 54%, rgba(190,228,248,1) 75%, rgba(177,216,245,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(225,255,255,1) 0%,rgba(225,255,255,1) 7%,rgba(225,255,255,1) 12%,rgba(253,255,255,1) 12%,rgba(230,248,253,1) 30%,rgba(200,238,251,1) 54%,rgba(190,228,248,1) 75%,rgba(177,216,245,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(225,255,255,1) 0%,rgba(225,255,255,1) 7%,rgba(225,255,255,1) 12%,rgba(253,255,255,1) 12%,rgba(230,248,253,1) 30%,rgba(200,238,251,1) 54%,rgba(190,228,248,1) 75%,rgba(177,216,245,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e1ffff', endColorstr='#b1d8f5',GradientType=0 ); /* IE6-9 */
}
.fondo-atardecer{
    /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f1e767+0,feb645+100&0.5+0,0.5+100;Yellow+3D */
background: -moz-linear-gradient(top, rgba(241,231,103,0.5) 0%, rgba(254,182,69,0.5) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(241,231,103,0.5) 0%,rgba(254,182,69,0.5) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(241,231,103,0.5) 0%,rgba(254,182,69,0.5) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#80f1e767', endColorstr='#80feb645',GradientType=0 ); /* IE6-9 */
}

.btn-group-vertical-dias {
    width:100%;
}

.btn-group-vertical-servicios {
    width:60%;
}
.btn-group-vertical .btn{
    text-align: left;
}
.btn-group-vertical i{
    position: absolute;
    right: 10px;
    top: 12px;
}
.div_fechas{
    padding:  0;
    /* margin:  0 !important; */
    margin-left: -16%;
    width:  100%
}
.oculto{
    display:none;
}
.visible{
    display:block;
}
.verde {
    background-color:#006400;
    color:#fff;
}
.toogle_dias{
    border-bottom: 1px solid rgba(255,255,255,0.5);
}
.horarios {
    padding: 5px 8px;
    border-radius: 5px;
    width: 100%;
}
</style>

<div class="container">
    <input type = "hidden" id="id_perfil" value="<?php echo $data['data']['id_perfil']; ?>">
    <div class="row">
        <div class="col-lg-12">
            <h2>Horario y habilidades</h2>
        </div>
    </div>                      
    <div class="row">
        <div class="col-md-3">
            <div class="btn-group-vertical btn-group-vertical-dias " role="group" id="botones_dias" aria-label="Basic example">
            </div>
        </div>
        <div class="col-md-5">

        <!--

            

            let variable_x.lunes[X=13] = 0;

            foreach
                horario_general
                    if (horario_general==X)
                        variable_x.lunes[X=13] = 1;


            {
                lunes:{
                    1:0,
                    2:0,
                    3:0,
                    4:1,
                    5:1,
                    // horas
                }, 
                martes:{}....
            }
            -->


            <div class="list-group" id="listado_dias">
                <!--<a href="#" class="list-group-item list-group-item-action flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Lunes</h5>
                    <small>8 horas en total</small>
                    </div>
                    <p class="mb-1">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                            <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </p>
                </a>-->
               
            </div>        


            <div class="btn-group-vertical btn-group-vertical-dias " role="group" id="botones_horas" aria-label="Basic example">
            
            </div>
        </div>
        <div class="col-md-4">
            <h3>Servicios</h3>
            <div class=" col-md-12">
                <div class="input-group">
                <select 
                type="select" 
                class="custom-select  jmy_web_div" 
                data-lista-id="lista_de_servicios" 
                placeholder="Seleccione un servicio" 
                data-value="<?php $this->pnt('servicios'); ?>"   
                data-tabla="<?php echo $tabla; ?>" 
                data-page="<?php echo $page; ?>" 
                id="servicios" 
                tabindex="5" 
                >
                </select>
                <input type="text" class="form-control" id="tiempo_servicio" aria-label="" placeholder="Tiempo promedio de servico">
                    <div class="input-group-append">
                        <button class="btn btn-secondary " id="agregar_servicios" type="button" >Agregar</button>
                    </div>
                </div>
                <label for="servicios">Selecciona un servicio para agregarlo</label>
                
            </div>
            <div class="col-md-12">
                <h3>Servicios agregados:</h3>
                <ul class="list-group" id="mostrar_servicio">
                    
                </ul>
                
            </div>
        </div>
    </div>
    <button type="button" id="boton_guardar" class="btn btn-success">Guardar</button>
    <div id="ajax_contactform_msg"> </div>
</div>