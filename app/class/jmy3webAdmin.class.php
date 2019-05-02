<?php
class JmyWebSession {
	public function session(){
		$sj=$_SESSION['jmyWebApp'];
		if($sj['t']==""){
			$o=$this->s(["api"=>JMY_API,"url"=>RUTA_ACTUAL]);
			$o2=$this->s(["token"=>$o['out']['session']['token'],"url"=>RUTA_ACTUAL]);
		}else{
			$o2 =$this->s(["token"=>$sj[$sj['t']],"url"=>RUTA_ACTUAL]);
		}
		$sj['t']=($sj['t']!="")?$sj['t']:$o['out']['session']['token'];
		$sj[$sj['t']]=$o2['out']['session'];
		$_SESSION['jmyWebApp']=$sj[$sj['t']];
		return ($o['out']['error']!='')?["o"=>$o,"o2"=>$o2]:$sj[$sj['t']];
	}
	public function s2($d){
		$postdata = json_encode($d);
		$opts = ['http' =>[
				'method'  => 'POST',
				'header'  => 'Content-type: application/json',
				'content' => $postdata
			]];
		$context  = stream_context_create($opts);
		$result = file_get_contents($d['url'], false, $context);
		return $result;
	}
	public function session_activa($d=[],$logout=0){ 
		if($logout){unset($_SESSION);}
		if($d[0]!=''&&$d[1]!=''){
		$d['id']=$d[0];$d['token']=$d[1];unset($d[0]);unset($d[1]);
		$d['api']="e2ad454bea7d919f0fc411a8b885580c";
		$d['api_web']=JMY_API;
		$d['datos_device']=true;
		$d['apis'][$d['api']]=["nombre"=>"JmyWeb","version"=>"1.0"];
		$d['url']='https://comsis.mx/api/auth/v1/token';
		$o=(is_array($_SESSION['jmysa']))?$_SESSION['jmysa']:json_decode($this->s2($d),1);		
		$_SESSION['jmysa']=(is_array($_SESSION['jmysa']))?$o:["user"=>$o['out']['userData'],"devices"=>$o['out']['devices'],"body"=>$o['out']['jmyapi']['body'],"permiso"=>$o['out']['jmyapi']['body']['permisos_api']['PERMISOS']];
		}$_SESSION['JMY3WEB'][DOY]=($_SESSION['jmysa']['permiso']>2)?1:0;
		return $_SESSION['jmysa'];
	}
	public function fn($d){ //fn(["fn"=>"codigo","token"=>"codigo",])
		$d['url']=RUTA_ACTUAL;
		$o = ($d['fn']!='' && $d['token']!='' )?$this->s($d):["out"=>["error"=>"sin asignar token ó fn (función)","d"=>$d]];
		return $o;
	}
	public function h(){
		return 'hola mundo';
	}
	private function s($s){
		$ch = curl_init();
		$sk = (is_array($s)) ? array_keys($s):false;$se = "";
		for ($i=0; $i <count($sk) ; $i++) { 
			$se=$se.$sk[$i]."=".$s[$sk[$i]]; $se=$se."&";	}
		curl_setopt($ch, CURLOPT_URL,JMY_SERVER);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,$se);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$out = json_decode(curl_exec ($ch),1);
		curl_close ($ch);
		return $out;
	}
}
