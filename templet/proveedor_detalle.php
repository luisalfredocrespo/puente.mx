<div class="container">
	<input type = "hidden" id="id_proveedor" value="<?php echo $data['id_proveedor']; ?>">
	<div class="row">
		<div class="col-lg-2" id="pizzarra">
		</div>
		<div class="col-lg-6">
			<center>
			<form class="contact-form" method="post" name="enqform" action="php/send.php">
		        <div class="col-lg-10">
		        	<div data-delay="100" data-animation="fadeIn">
		                <p><input type="text" id="proveedor_nombre" name="username" placeholder="Nombre (requerido)" /> </p>
		            </div>
		        </div>
		        <div class="col-lg-10">
		        	<div  data-delay="300" data-animation="fadeIn">
		        		<p><input type="text" id="proveedor_telefono" name="txtname" placeholder="Telefono (requerido)"/></p>
		                <p><input type="text" id="proveedor_direccion"name="txtedad" placeholder="Dirección" required/></p>
		                <p><input id="datepicker" type="text" placeholder="Dia de pedido" value="" name="datepicker"><span class="icons fa fa-calendar"></span></p>
		            </div>
		        </div>
		    </form>
		    </center>
			<div id="ajax_contactform_msg"> </div>	
		</div>
		<div class="col-lg-4">
			<div class="container">
				<div class="row justify-content-end ">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
						<label class="input-group-text" for="inputGroupSelect01">Detalles</label>
						</div>
						<select class="custom-select" id="select_lista_proveedor">
						</select>
					</div>
						<button type="button" id="boton_historial" class="btn btn-success">Historial</button>
						<button type="button" id="boton_guardar" class="btn btn-success">Guardar</button>
	            	
	            </div>
	        </div> 
	        <div class="container"> 
	            <div class="row justify-content-end" >
	            	<div class="hr-invisible"></div>
	            	<div class="hr-invisible"></div>
	            	<div class="hr-invisible"></div>
	            </div>
	        </div>    
		</div>
	</div>
</div>

<div class="hr-invisible"></div>

