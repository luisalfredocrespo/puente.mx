<div class="container">
  <div class="row">
    <div class="hr-invisible-very-very-small"></div>
      <div class="column dt-sc-one-fourth first">
          <div class="dt-sc-team type1">
              <div class="image" style="height: 170px !important; ">
                  <img src="<?php echo ($data['perfiles']['principal']['foto_perfil']!="")?$data['perfiles']['principal']['foto_perfil']:RUTA_ACTUAL.BASE_TEMPLET.'images/team-img4.jpg'; ?>" width="60%" alt="" title="">
                  <div class="image-overlay">
                      <div class="team-details-social-icons">
                          <a class="fa fa-user" href="<?php echo $this->url_inicio(['return'=>1]).'perfil/editar/'.$data['user_id']; ?>"> </a>
                      </div>
                  </div>
              </div>
              <h4><a href="<?php $this->url_inicio(['return'=>1]).'perfil/editar/'.$data['user_id']; ?>"> <?php echo $data['perfiles']['principal']['nombre']; ?> </a></h4>
              <h5><?php echo $data['perfiles']['principal']['email']; ?></h5>
          </div>
      </div>
      <div class="column dt-sc-three-fourth">
        <div class="dt-sc-special-services-carousel-wrapper">

          <div class="jmy_web_contador" data-page="perfil" id="numero_de_carrusel" data-value="<?php
        $this->pnt('numero_de_carrusel','3');?>" data-titulo='Minimo puedes ver 3 imagenes, máximo  números '></div>

            <div class="dt-sc-special-services-carousel">

           <?php 
         $paginas = $this->pnt('numero_de_carrusel','3',["return"=>true]); 
         
         $flechas =$paginas;                     
         
                $contador = 0;
                for($i=0;$i<$paginas;$i++){ ?>


                  <div class="column dt-sc-one-third">
                      <div class="dt-sc-service type2">
                          <figure class="gallery-thumb">
                              <a href="#">
                                  <img class="dt-sc-filter" title="" alt="" src="<?php echo RUTA_ACTUAL.BASE_TEMPLET; ?>images/service-img5.jpg">
                              </a>
                          </figure>
                          <div class="hr-invisible-very-small"></div>
                          <h3><a href="#"> Cutting & Styling </a></h3>
                          <h4>Lorem ipsum dolor sit amet consectetur adipiscing</h4>
                      </div>
                  </div>
                 <?php } ?>
                  
            </div><!--  
            <div class="bx-controls bx-has-controls-direction">
              <div class="bx-controls-direction">
                <a class="bx-prev" href="">Prev</a>
                <a class="bx-next" href="">Next</a>
              </div>
            </div>    --> 
        </div> <!-- Fotos -->
      </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="hr-invisible-very-very-small"></div>
    <div class="col-lg-2">
        <div class="column dt-sc-one-third">
            <div class="dt-sc-ico-content type1">
                <div class="icon">
                    <span class="fa fa-desktop"> </span>
                </div>
                <h5>
                    <a href="#"> Puntos <br/> Evolution  </a>
                </h5>
            </div>
        </div>
    </div>

    <div class="col-lg-2">
      
      <div class="dt-sc-ico-content type1">
        <div class="icon">
            <span class="fa fa-users"> </span>
        </div>
        <h5>
            <a href="<?php $this->url_inicio(); ?>perfil/editar"> Agrega <br/> perfiles  </a>
        </h5>
      </div>
    </div>

    <div class="col-lg-8">
      <nav class="navbar navbar-expand-lg navbar-dark bg-success">
          <a class="navbar-brand" href="#">Descubre</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item active">
                <a class="nav-link" href="#">Mis puntos <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Promociones</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Nuevo</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Hoy 
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Lavado gratis</a>
                  <a class="dropdown-item" href="#">uñas</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">corte</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
    </div>

  </div>
</div> 

<?php
//$this ->pre(['p'=>$data['carga_centro'],'t'=>'carga_centro']);
include $data['carga_centro']; ?>

<div class="hr-invisible"></div>