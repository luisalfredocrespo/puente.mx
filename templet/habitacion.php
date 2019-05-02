<div class="main">
    <div class="hr-invisible-small"></div>
    <section class="fullwidth-background">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <h4> Hotel X </h4>
                <h6><a href="index.html">Habitaciones</a></h6>
            </div>
        </div>
    </section>
    <div class="hr-invisible-very-small"></div>
    <div class="clear"></div>
    <section id="primary" class="content-full-width"><!-- Primary Section -->
        <h2 class="aligncenter">Especificaciones de habitación</h2>
        <div class="clear"></div>
        <div class="hr-invisible-medium"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                Número<input type="number" id="num_hab" placeholder="--" min="1" required>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <h5>Tipo de habitación</h5>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <select 
                                        type="select" 
                                        class="custom-select  jmy_web_div" 
                                        data-lista-id="lista_de_habitaciones" 
                                        placeholder="Seleccionar" 
                                        data-value="<?php $this->pnt('habitaciones'); ?>"   
                                        data-tabla="<?php echo $tabla; ?>" 
                                        data-page="<?php echo $page; ?>" 
                                        id="habitaciones" 
                                        tabindex="5" required></select>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Complementos de la habitación:</label>
                                <div id="chebox">
                                </div>
                                 <div id="mostrarEntrada">
                                 <label>Agregar complemento:</label>
                                    <input type="text" id="agregarTexto" placeholder="" required>
                                    <button type="button" id="agregarComplemento">Agregar</button>
                                </div>
                                <br>
                                <button type="button" class="btn btn-primary btn-sm valorCheck"><i class="fa fa-plus"></i></button>
                            </div> 
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                Precio<input type="number" id="precio_habitacion" placeholder="0.0" min="1" required>
                            </div>

                             
                        </div>
                    </div>
                <div class="col-sm-1">
                </div>
            </div>
        <div class="row">
            <div class="col-10"></div>
            <div class="col-2"> 
                <div class="float-right"><button type="button" id="enviarDato" class="btn float-right">Agregar</button>
                </div> 
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
</div>