<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>


<div id="main"><!-- Main -->
            <div class="hr-invisible-small"></div>
            <section class="fullwidth-background">
                <div class="breadcrumb-wrapper">
                    <div class="container">
                        <h4> Hotel X </h4>
                        <h6><a href="index.html">Inicio</a></h6>
                    </div>
                </div>  
              
            </section>
            <div class="hr-invisible-very-small"></div>
            <div class="clear"></div>
            <section id="primary" class="content-full-width"><!-- Primary Section -->
                <h2 class="aligncenter">Realiza tú reservación.</h2>
                <div class="clear"></div>
                <div class="hr-invisible-medium"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-10">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <p>Fecha de entrada<input type="text"  autocomplete="off" placeholder="Fecha de Entrada" id="txtCheckin" required /><span class="icons fa fa-calendar"></span></p>         
                                    </div> 
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <p>Fecha de salida<input type="text"  autocomplete="off" placeholder="Fecha de Salida" id="txtCheckout" required /><span class="icons fa fa-calendar"></span></p>              
                                    </div> 
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <p>Huespedes<input id="reservacion_cita" type="text" value="1 Adulto - 0 Niños" readonly><span class="icons fa fa-users"></span></p>
                                        <div id="inf" style="display:block;">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        Adultos <select id="adultos" required></select>
                                                        Niños <select id="ninos" required></select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div id="edad_ninos"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <button type="button" class="btn btn-primary cerrar">Aceptar</button>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <p><span>Tipo de habitación</span>
                                        <select id="habitaciones" class="text-capitalize" required>
                                            <!--<option>Seleccionar</option>
                                            <option>Individual</option>
                                            <option>Doble</option>
                                            <option>Suite</option>-->
                                        </select></p>
                                        <input type="hidden" id="ident_f">
                                    </div> 
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="container" id="disponibilidad">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary enviar">Buscar habitación</button>
                        </div>
                        <div class="col-sm-1">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7" >
                            <div class="filtro_habitacion style="background-color: #f1f2f3;"">
                                
                            </div>
                        </div>
                        <div class="col-sm-5" >
                            <div class="form-group info_Reservacion" style="background-color: #a3b2c4;">

                              <!--   <div class="form-row">
                                    <div class="col">
                                        <label for="fi">Fecha de entrada</label>
                                        <input type="text" id="" name="fi" class="form-control" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="fi">Fecha de Salida</label>
                                        <input type="text" class="form-control" id="" name="ff" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="ad">Adultos</label>
                                        <input type="text" id="" name="ad" class="form-control" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="ni">Niños</label>
                                        <input type="text" class="form-control" id="" name="ni" readonly>
                                    </div>
                                </div> 
                                <div class="form-row">
                                    <div class="col">
                                        <label for="nh"># habitacion</label>
                                        <input type="text" id="" name="nh" class="form-control" readonly>
                                    </div>
                                    <div class="col">
                                        <label for="tp">Tipo de habitación</label>
                                        <input type="text" class="form-control" id="" name="tp" readonly>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="">Servicios</label>
                                    <ul>
                                        <li>ll</li>
                                        <li>jjh</li>
                                    </ul>
                                </div>
                                <div class="form-group text-right">
                                    <label for="">precio</label>
                                </div>
                                <hr>
                                <button class="agendar">Reservar</button>  --> 
                            </div>
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
