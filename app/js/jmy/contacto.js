jQuery(function ($) { 
	console.log("contacto");


	$(".jmy_web_contacto_enviar").click(function(){
		event.preventDefault();
		jmyWebContactoCargar({
			formulario:$(this).data("formulario"),
			boton:$(this).attr("id")
		});
	});

	function jmyWebContactoCargar(d = []) {
		var frm=[];
		var t1="";
		var t2="";
		var t3="";
		var t4="";
		var t5=true;
		$(".jmy_web_contacto").each(function(e) {
		console.log('contacto enviar');
			t1=$(this).data("formulario");
			if(t1==d.formulario){
				t2=$(this).data("campo");
				if(t2!=undefined){
					t3=$(this).val();
					if(t3!=""){
						frm.push({campo:t2,valor:$(this).val()});
					}else{
						t4=$(this).attr('required');
						if(t3=="" && $(this).attr('required')=="required"){
							t5=false;
							$(this).css("border","2px solid red");
						}else{
							$(this).css("border","1px solid green");
							}
					}
				}
			}

		});
		console.log(t5);
		if(t5){
			$.post("/jmyWebContacto", {d:frm}, function(result){
            console.log(result);
			$("#"+d.boton).prop( "disabled", true );
			$("#"+d.boton).html( "" );
			$("#"+d.boton).html( "Mensaje Enviado" );
			$(".jmy_web_contacto").val("");
        	}, "json");
		}
			
	}

	

});