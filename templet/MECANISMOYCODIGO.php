       <div id="main"><!-- Main -->
        	<div class="hr-invisible-small"></div>
        	<section class="fullwidth-background">
        		<div class="breadcrumb-wrapper">
                    <div class="container">
                        <h4 class="jmy_web_div display-1"  data-page="servicios" id="hola78"data-editor="no">
<?php $this->pnt('hola78','Mecanismo del puente  '); ?>
</h4>
                        
                    </div>
                </div>                
            </section>
            <div class="hr-invisible-very-small"></div>
            <div class="clear"></div>
            <section id="primary" class="content-full-width"><!-- Primary Section -->
            	<div class="fullwidth-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-ms-10">
                            <h4 class="border-title aligncenter jmy_web_div" data-page="servicios" id="hola79"data-editor="no">
                                <?php $this->pnt('hola79','
                                El puente tiene un mecanismo automanito que se mueve por unos motoreductore instalados en la parte inferior del mismo puente . En el hay cuatro cables pegados que sostiene la plataforma del puente .
                                Desde los dichos extremos sale una cuerda, la cual cambia de dirección con la ayuda de poleas.
                                En cada torre hay dos poleas. Las poleas situadas en la parte superior de cada torre reciben las cuerdas en sentido horizontal y le da un cambio de 90º, dirigiéndolo a la base.
                                Debajo de las torres se encuentra las otras poleas que dan un cambio de 90º, dirigiéndolo hacia el manivela.
                                En resumen se utilizan máquinas que permiten el movimiento de la carretera. La carretera va unida a las torres con un palo de balso, el cual hace de eje para el movimiento de esta. 

                                tiene un boton de encendido del circuito y un boton de paro de emergencia por si la plataforma tiene un problema el boton de emargencia nos sirve para poder reparar cualquier falla .
                                <br>
                                '); ?>
                            </h4>
                            </div>
                        </div>
                    </div>
                   
<br>
<br>
<br>

<html>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10">
            <h4 style="font-size:300%;">

                <h1>Código</h1><br>
                int triger = 9, echo = 8, led=4, grado=0;
                float tiempo=0.0, distancia=0.0;


                codigo<br>
                int triger = 9, echo = 8, led=4, grado=0;<br>
                float tiempo=0.0, distancia=0.0;<br>

                void setup(){<br>
                // put your setup code here, to run once:<br>
                pinMode(led, OUTPUT);<br>
                pinMode(triger,OUTPUT);<br>
                pinMode(echo,INPUT);<br>
                Serial.begin(9600);<br>
                }<br>
                void loop() {<br>
                // put your main code here, to run repeatedly:<br>
                digitalWrite(triger,LOW);<br>
                delayMicroseconds(2);<br>
                digitalWrite(triger,HIGH);<br>
                delayMicroseconds(10);<br>
                for(grado=0;grado=360;grado++)<br>
                tiempo=pulseIn(echo,HIGH);<br>
                distancia=(tiempo/2)/29.1;<br>
                Serial.print(distancia);<br>
                Serial.println("distancia centimetros");<br>
                Serial.print(tiempo);<br>
                Serial.println("tiempo");<br>
                Serial.print(grado);<br>
                Serial.println("Grado:");<br>
                delay(500);<br>

                digitalWrite(led, HIGH);   // turn the LED on (HIGH is the voltage level)<br>
                delay(250);                       // wait for a second<br>
                digitalWrite(led, LOW);    // turn the LED off by making the voltage LOW<br>
                delay(250);                       // wait for a second<br>
                }


                }</h4>


            </div>
        </div>
    </div>

</body>
</html>

</h4>
       <!-- <div class="dt-sc-tabs-container">
            <div class="clear"></div>
            <div class="hr-invisible-small"></div>
        <ul class="dt-sc-tabs-frame">	
            <li class="btn-eff3 current jmy_web_div" data-page="servicios" id="hola80"data-editor="no">
            <?php $this->pnt('hola80','cortes y barbas '); ?>
            </li>
            <li class="btn-eff3 jmy_web_div" data-page="servicios" id="hola81"data-editor="no">
            <?php $this->pnt('hola81','secados y planchados '); ?>
            </li>
            <li class="btn-eff3 jmy_web_div" data-page="servicios" id="hola82"data-editor="no">
<?php $this->pnt('hola82','tintes,mechas y tratamientos '); ?>
</li>
            <li class="btn-eff3 jmy_web_div" data-page="servicios" id="hola83"data-editor="no">
<?php $this->pnt('hola83','uñas, manicure y pedicure '); ?>
</li>
        </ul>  
                <div class="clear"></div>
                <div class="hr-invisible"></div>
                <div class="fullwidth-section dt-sc-parallax-section appointment-parallax dark-bg" style="background-position: 20% 3px;">
                    <div class="fullwidth-bg">
                    	<div class="parallax-spacing">
                    		<div class="container">
                            	<h3 class="border-title jmy_web_div" data-page="servicios" id="hola84"data-editor="no">
<?php $this->pnt('hola84','Reserva tu cita con anticipación '); ?>
</h3>
                                <div class="aligncenter">
                                	<a href="<?php echo RUTA_ACTUAL; ?>contacto" class="appointment-btn btn-eff2 jmy_web_div" data-page="servicios" id="hola85"data-editor="no">
<?php $this->pnt('hola85','Reserva tu cita  '); ?>
</a>
                              	</div>
                            </div>
                        </div>
                   	</div>
             	</div> 						
                        <div class="hr-invisible"></div>                         
                        <div class="dt-sc-tabs-frame-content">
                        	<div class="alignleft">
                            	<div class="services-container alignright">
                                	<img src="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>images/service-tab-img1.jpg" alt="" title="" >
                                    <div class="dt-sc-view-btn">
                                    	<a href="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>#" class="btn-eff2 jmy_web_div" data-page="servicios" id="hola86" data-editor="no">
<?php $this->pnt('hola86',' ver galería'); ?>
</a>
                                    </div>
									<div class="alignright"></div>
									<ul class="dt-sc-fancy-list check">
									 </ul>
                                    <div class="text-align=alignright">
                                        <h3 class="alignright jmy_web_div" data-page="servicios" id="hola87" data-editor="no">
<?php $this->pnt('hola87','para ellos'); ?>
</h3>
										 <br>
										 <br>
										 <br>
                                       
                                        <ul class="alignright jmy_web_div" data-page="servicios" id="hola88"data-editor="no">
                 <?php $this->pnt('hola88','<li> Corte de cabello </li>
                                            <li> Barba </li>
                                            <li> Tinte </li>
                                            <li> Manicure</li>
                                            <li> Pedicure </li>
                                            <li> Rasurada </li>'); ?>

                                        
                                            
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="alignright">
                            	<div class="services-container alignright">
                                	<img src="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>images/service-tab-img2.jpg" alt="" title="" >
                                    <div class="dt-sc-view-btn">
                                    	<a href="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>#" class="btn-eff2 jmy_web_div" data-page="servicios" id="hola89"data-editor="no">
<?php $this->pnt('hola89','ver galería'); ?>
</a>
                                    </div>
                                    <div class="text-align=center">
                                        <h3 class="jmy_web_div" data-page="servicios" id="hola90"data-editor="no">
<?php $this->pnt('hola90','para ellas '); ?>
</h3>
                                        
                                        <ul class="alignleft jmy_web_div" data-page="servicios" id="hola91"data-editor="no">
<?php $this->pnt('hola91','  li> corte de cabello </li>
                                            <li> Depilaciones </li>
                                            <li> Maquillaje </li>
                                            <li> Peinados </li>
                                            <li> Manicure y pedicure  </li>
                                            <li> Tintes </li>
                                            <li> Rayos y mechas   </li>
                                            <li> Pestañas  </li>
                                            <li> uñas</li>
                                            <li> gelish  </li>
                                            <li> tratamientos capilares</li>'); ?>

                                            
                                        </ul>
                                    </div>
                                </div>	
                            </div>
                        </div>
                        <br>
									
                    </div>
                </div>
                <div class="clear"></div>
                <div class="hr-invisible"></div>
                <?php /* <div class="fullwidth-section dt-sc-parallax-section pricing-parallax dark-bg">
                    <div class="fullwidth-bg">
                        <div class="parallax-spacing">
                             <div class="container"><!-- Container -->
                        	<h2 class="border-title aligncenter"> Nuestras ofertas </h2>
                            <div class="hr-invisible-small"></div>
                            <div class="column dt-sc-one-fourth first">
                            	<div class="animate" data-delay="200" data-animation="fadeIn animated">
                                    <h3 class="border-title">Sal&oacuten<span>  Evolution</span></h3>
                                    <p>Aproveche las ofertas .</p>
                                    <div class="dt-sc-offer-text">
                                        <h2>50</h2>
                                        <span>%<span>off</span></span>
                                    </div>
                                    <div class="clear"></div>
                                    <ul class="dt-sc-offer-date">
                                        <li>
                                            <span class="fa fa-calendar"></span>
                                            Martes 24 de octubre 
                                        </li>
                                        <li>
                                            <span class="fa fa-map-marker"></span>
                                            ubicación
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="column dt-sc-three-fourth">
                            	<div class="dt-sc-offer-carousel-wrapper animate" data-delay="400" data-animation="fadeIn animated">
                                	<div class="dt-sc-offer-carousel">
                                    	<div class="column dt-sc-one-third">
                                        	<div class="dt-sc-offer">
                                                <figure class="gallery-thumb">
                                                    <a href="<?php echo RUTA_ACTUAL; ?>"><img src="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>images/offer-img1.jpg" alt="" title=""></a>
                                                </figure>
                                                <div class="gallery-details">
                                                	<h4><a href="<?php echo RUTA_ACTUAL; ?>">Mechas californianas</a></h4>
                                                    <div class="dt-sc-price">
                                                    	$ 600
                                                    </div>
                                                    <div class="hr-invisible-very-very-small"></div>
                                                    <a class="dt-sc-button btn-eff3" href="<?php echo RUTA_ACTUAL; ?>" data-text="View Details"><span>Detalles</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column dt-sc-one-third">
                                        	<div class="dt-sc-offer">
                                                <figure class="gallery-thumb">
                                                    <a href="<?php echo RUTA_ACTUAL; ?>"><img src="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>images/offer-img2.jpg" alt="" title=""></a>
                                                </figure>
                                                <div class="gallery-details">
                                                	<h4><a href="<?php echo RUTA_ACTUAL; ?>">corte en capas</a></h4>
                                                    <div class="dt-sc-price">
                                                    	2x1
                                                    </div>
                                                    <div class="hr-invisible-very-very-small"></div>
                                                    <a class="dt-sc-button btn-eff3" href="<?php echo RUTA_ACTUAL; ?>" data-text="View Details"><span>Detalles</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="column dt-sc-one-third">
                                        	<div class="dt-sc-offer">
                                                <figure class="gallery-thumb">
                                                    <a href="<?php echo RUTA_ACTUAL; ?>"><img src="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>images/blog-img2.jpg" alt="" title=""></a>
                                                </figure>
                                                <div class="gallery-details">
                                                	<h4><a href="<?php echo RUTA_ACTUAL; ?>">tratamientos</a></h4>
                                                    <div class="dt-sc-price">
                                                    	$ 1200
                                                    </div>
                                                    <div class="hr-invisible-very-very-small"></div>
                                                    <a class="dt-sc-button btn-eff3" href="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>#" data-text="View Details"><span>Detalles</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="column dt-sc-one-third">
                                        	<div class="dt-sc-offer">
                                                <figure class="gallery-thumb">
                                                    <a href="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>#"><img src="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>images/offer-img2.jpg" alt="" title=""></a>
                                                </figure>
                                                <div class="gallery-details">
                                                	<h4><a href="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>#">Hair Coloring</a></h4>
                                                    <div class="dt-sc-price">
                                                    	£ 200
                                                    </div>
                                                    <div class="hr-invisible-very-very-small"></div>
                                                    <a class="dt-sc-button btn-eff3" href="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>#" data-text="View Details"><span>View Details</span></a>
                                                </div>
                                            </div>
                                        </div>
	                                </div>
                                	<div class="carousel-arrows">
                                        <a href="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>#" class="prev-arrow"><i class="fa fa-angle-left"></i></a>
                                        <a href="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>#" class="next-arrow"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-invisible-small"></div>
                            <div class="hr-invisible-very-small"></div>
                        </div><!-- End of Container -->
                        </div>
                    </div>
            	</div>  */?>
                <div class="clear"></div>
                <div class="hr-invisible"></div>
                
                <div class="hr-separator type2"></div>
                
              
            </section><!-- End of Primary Section -->   
        </div><!-- End of Main -->
        -->