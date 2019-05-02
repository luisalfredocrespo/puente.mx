<?php
require(BASE_APP.'class/jmy3webAdmin.class.php');
$out = new JmyWebSession();
$o = $out->session();
$o=[	//'post'=>$_POST,
	'out'=>$o,
	'error'=>$e,
];
echo json_encode($o);
/*
?>

<pre><?php print_r($o);?></pre>