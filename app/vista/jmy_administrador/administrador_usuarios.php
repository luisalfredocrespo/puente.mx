<div class="container">
    <div class="row">
        <div class="col-md-12">
        <h1>Usuarios Administrador</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-6" >
        <div class="card w-100">
            <div class="card-body">
                <h5 class="card-title">Lista de usuarios</h5>
                <table id="listado_usuario_tabla" class="w-100 display"></table>
            </div>
        </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6" id="datos">
            <h2 onclick="ver_perfil()">Editar usuario</h1>

            <style>
                .btn_tabs {width:50%;}
            </style>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group btn-block" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn_tabs btn-secondary active" data-div="perfil">Perfil</button>
                        <button type="button" class="btn btn_tabs btn-secondary" data-div="modulos">Módulos</button>
                    </div>
                </div>
            </div>
            <div class="row">


                <div class="container div_tabs" id="div_perfil">
                    <input type = "hidden" id="id_perfil" value="<?php echo $data['id_perfil']; ?>">
                    <div id="formulario_perfil">
                   </div>
                </div>
                <div class="container div_tabs" id="div_modulos">
                    <div class="card w-100">
                        <div class="card-body">
                            <h5 class="card-title">Módulos</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Accesos a los módulos de este sitio</h6>
                            <p class="card-text">Edite los permisos que dese darle al usuario.</p>
                            <div id="listado_modulo_tabla"></div>
                        </div>
                    </div>
                </div>
                <div class="hr-invisible"></div>

            </div>
        </div>
    </div>
</div>

