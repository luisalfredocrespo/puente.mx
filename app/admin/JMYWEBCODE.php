<?php
if($_POST['i']!=''){
	require(BASE_APP.'class/jmy3webAdmin.class.php');
	$out = new JmyWebSession();
	$tkn = $out->session();
	$fn =  $out->fn(["fn"=>"revisarCodigo","token"=>$tkn['token'],"ID_F"=>$_POST['i'] ]);
	$_SESSION['JMY3WEB'][DOY]=($fn['out']['o']['estado']=='activo')?1:0;
	echo json_encode($fn['out']['o']);
}
?>