<input type="hidden" id="cita_fecha" value="<?php echo $data['editar']['fecha']; ?>" >
<input type="hidden" id="cita_horario" value="<?php echo $data['editar']['horario']; ?>" >
<input type="hidden" id="id_perfil" value="<?php echo $data['id_perfil']; ?>" >
<input type="hidden" id="cita_id_perfil" value="<?php echo $data['editar']['id_perfil']; ?>" >
<input type="hidden" id="cita_persona" value="<?php echo $data['editar']['persona']; ?>" >
<input type="hidden" id="cita_nombre" value="<?php echo $data['editar']['nombre']; ?>" >

<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
      
<script type="text/javascript">
    $(document).ready(function() {
        $("#dpt").datepicker({minDate:0});
    });
</script>

<div id="main"><!-- Main -->
        	<div class="hr-invisible-small"></div>
        	<section class="fullwidth-background">
        		<div class="breadcrumb-wrapper">
                    <div class="container">
                        <h4> Salon evolution </h4>
                        <h6><a href="index.html">Inicio</a></h6>
                    </div>
                </div>  
              
            </section>
            <div class="hr-invisible-very-small"></div>
            <div class="clear"></div>
            <section id="primary" class="content-full-width"><!-- Primary Section -->
            	<h2 class="border-title aligncenter"> Realiza tu cita </h2>
                <div class="clear"></div>
                <div class="hr-invisible-medium"></div>
                <div class="container">
                    
                    <div class="column dt-sc-one-third first">
                        <h3 class="border-title" id="alerta">  </h3>
                        <h3 class="border-title"> Pasos <span>ha seguir:</span> </h3>
                        <ul class="opening-time branch_details">
                            <li><span class="paso1">Paso 1</span><h5 class="paso1">Elige para quien es el servicio</h5></li><hr>
                            <li><span class="paso2">Paso 2</span><h5 class="paso2">Elige la fecha y el servicio</h5></li><hr>
                            <li><span class="paso3">Paso 3</span><h5 class="paso3">Elige el empleado y la hora</h5></li><hr>
                          
                        </ul>
                    </div>

<!-- Parte uno -->


                    <div class="column dt-sc-two-third form-group" id="div_paso_1">
                    	<h3 class="border-title">Paso <span>Uno</span></h3>
                    	<div class="box" >
                            <div class="column dt-sc-one-half first ">
                            	<div class="" data-delay="100" data-animation="fadeIn">
                                    <p>Para quien es el servicio:</p>                      
                               
                                    <p><select id="select_lista_perfiles">
                                         
                                        </select></p>
                                </div>
                            </div>                                                                                             
                            <div class="form-row aligncenter " data-delay="7 00" data-animation="fadeIn">
                                <button type="button" id="btn_paso_1">Paso 2</button>
                            </div>
                        </div>
                    	<div id="ajax_contactform_msg"> </div>
                    </div>

<!-- Parte dos -->
                    <div class="column dt-sc-two-third hidden" id="div_paso_2">
                    	<h3 class="border-title">Paso <span>Dos</span></h3>
                    	<div class="contact-form" >
                            <div class="column dt-sc-one-half first">
                                <div class="" data-delay="100" data-animation="fadeIn">
                                    <p>Selecciona la fecha:</p>                                     
                                    <p>
                                        <input id="altField" type="hidden" />
                                        <input id="dpt" type="text" placeholder="Fecha de la cita" value="" name="dpt"><span class="icons fa fa-calendar"></span></p>
                                                                                                
                                </div>
                            </div>
                            <div class="column dt-sc-one-half">
                                <p>Selecciona el servicio:</p>
                                <div class="" data-delay="300" data-animation="fadeIn" id="lista_servicios">
                                    
                                </div>
                            </div>                                                                                             
                            <div class="form-row aligncenter " data-delay="7 00" data-animation="fadeIn">
                                <div class="column dt-sc-one-half first">
                                    <div class="" data-delay="100" data-animation="fadeIn">
                                        <button type="button" id="btn_paso_r1">Regresar</button>  
                                    </div>
                                </div>
                                <div class="column dt-sc-one-half">
                                    <div class="" data-delay="300" data-animation="fadeIn">
                                        <button type="button" id="btn_paso_2">Paso 3</button>                
                                    </div>
                                </div>
                            </div>
                        </div>
                    	<div id="ajax_contactform_msg"> </div>
                    </div>
<!-- Parte tres -->


                    <div class="column dt-sc-two-third hidden" id="div_paso_3">
                        <h3 class="border-title">Paso <span>Tres</span></h3>
                        <div class="contact-form" >
                            <div id="listado_dias"></div>
                            <div id="horarios_disponibles">
                               
                            </div>


                            <div class="form-row aligncenter " data-delay="7 00" data-animation="fadeIn">
                                <div class="column dt-sc-one-half first">
                                    <div class="" data-delay="100" data-animation="fadeIn">
                                        <button type="button" id="btn_paso_r2">Regresar</button> 
                                    </div>
                                </div>
                                <div class="column dt-sc-one-half">
                                    <div class="" data-delay="300" data-animation="fadeIn">
                                        <button type="button" id="btn_guardar">Agendar cita</button>                
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="ajax_contactform_msg"> </div>
                    </div>


                </div>
                <div class="clear"></div>
                <div class="hr-invisible-medium"></div>
                <div class="fullwidth-section dt-sc-parallax-section appointment-parallax dark-bg" style="background-position: 20% 3px;">
                    <div class="fullwidth-bg">
                    	<div class="parallax-spacing">
                    		<div class="container">
                            	<h3 class="border-title">Lorem ipsum dolor sit amet, consectetur <span>Adipiscing elit</span></h3>
                                <div class="aligncenter">
                                	<a href="#" class="appointment-btn btn-eff2">Book an <span>Appointment</span></a>
                              	</div>
                            </div>
                        </div>
                   	</div>
             	</div>                
                <div class="clear"></div>                
            </section> <!-- End of Primary Section -->   
        </div><!-- End of Main -->
