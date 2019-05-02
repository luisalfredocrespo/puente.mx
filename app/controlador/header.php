<?php
    require_once(BASE_APP.'class/jmy3webAdmin.class.php');
    $SESSION = new JmyWebSession();
    $SESSION = $SESSION->session_activa();
    //$this ->pre(['p'=>$SESSION,'t'=>'Session']);