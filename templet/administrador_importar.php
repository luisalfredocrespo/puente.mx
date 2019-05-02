<input type="hidden" value="" id="id_importador">
<input type="hidden" value="" id="ruta">
<input type="hidden" value="" id="url">
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-9">
            <h2>Importador</h2>
            <p>Bienvenido al importador de datos por CSV</p>    
            <p>Para agregar una nueva importación devera contar con los archivos en formato CSV delimitado por algún caracter, y como nombre del campo en la primera columna</p>    
            <p>
            <div class="btn-group" role="group" >
            <button type="button" class="btn btn-secondary"><span class="glyphicon glyphicon-file"></span> Archivo de ejemplo</button>
            <button type="button" class="btn btn-info paso1" id=""><span class="glyphicon glyphicon-search"></span> Crear nueva importación</button>
            <button type="button" class="btn btn-info" id="btn_paso_4"><span class="glyphicon glyphicon-start"></span> Finalizar importación</button>
            </div>
            </p>
            <p></p>
        </div>
    </div>
    <div class="row" id="div_paso_paso1">
        <div class="col-md-12 col-lg-9">
            <div class="row">
                <div class="input-group mb-3">
                    <label for="nombre_importacion">Nombre de esta importación</label>
                    <input type="text" class="form-control" id="nombre_importacion" placeholder="Importación <?php echo date('Y/m/d');?>" aria-label="Importación <?php echo date('Y/m/d');?>" >
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary paso2" type="button" id="button-addon2">Continuar</button>
                        <button class="btn btn-outline-secondary btn-info paso3" type="button" id="button-addon2">Terminar de cargar arcivos y continuar </button>
                    </div>
                </div>
                <small id="emailHelp" class="form-text text-muted">Indique un nombre al cual le dara a esta importación.</small>        
            </div>
            <div class="row">
                <div id="archivos_importador">
                </div>  
            </div>  
        </div>
    </div>
    <div class="row" id="div_paso_paso2">
        <div class="col-md-12 ">
            <div class="row">
                <div class="col-md-12" id="tabs_impot">
                    
                </div>
                <div class="col-md-12" id="tablas">

                </div>
            </div>
        </div>
    </div>
</div>
