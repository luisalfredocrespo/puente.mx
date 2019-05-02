jQuery(function ($) { 
	function init() {
		setInterval(function(){ est(); }, 5000);
	}	
	function est() {
		let tiket = $("#tiket").val();
		console.log(tiket);
		if(tiket!=''){
			 $.post("/JMYWEBCODE",{i:tiket}, function(result){
				let res = JSON.parse(result);			
				console.log(res);
				if(res.estado=='activo')
					redireccionar();
			});
		}else{
			console.log("no se genero codigo de sincronización");
		}
	}
	function redireccionar(){
		let u = $("#web").val();
		window.location = u;
	};
	$("#refrescar").click(function(){
		est();
	});
	init();
});