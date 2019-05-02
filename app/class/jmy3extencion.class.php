<?php
Abstract class ExtencionDeClases{
    private $_exts = [];
    public $_this;
    function __construct(){
      $_this = $this;
    }
    public function addExt($o){
        $this->_exts=$o; 
        print_r($this);       
    }
    public function __get($v){
        foreach($this->_exts as $e){
            if(property_exists($e,$v))
                return $e->$v;
        }
    }
    public function __call($m,$a){
        foreach($this->_exts as $e){
            if(method_exists($e,$m))
                return call_user_func_array([$e,$m],$a);
        }
        throw new Exception("Este metodo {$m} no existe");
    } 
}