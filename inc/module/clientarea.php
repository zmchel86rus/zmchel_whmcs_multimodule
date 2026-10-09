<?php
if (!defined("ZM_PB_VER")) die('Direct access not allowed');

if( ! ZM_PB_PRETTY_URLS ){
    function zmchel_whmcs_multimodule_clientarea($vars) {
        
        $modulelink = $vars["modulelink"];
        $LANG = $vars["_lang"];
    
        return array(
            "pagetitle" => "Addon Module",
            "breadcrumb" => array("index.php?m=demo"=>"Demo Addon"),
            "templatefile" => "templates/client_page",
            "requirelogin" => false, # accepts true/false
            "forcessl" => false, # accepts true/false
            "vars" => array(
                "testvar" => "demo",
                "anothervar" => "value",
                "sample" => "test",
            ),
        );
    }
}
