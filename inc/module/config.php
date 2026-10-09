<?php
if (!defined("ZM_PB_VER")) die('Direct access not allowed');
 
function zmchel_whmcs_multimodule_config($vars = NULL){
    $module_translates = ZM_PB_ADMINLANG->module;

    $config = array(
        "name" => $module_translates->main->title,
        "description" => $module_translates->main->description." <a href=\"https://t.me/nvv8896\" target=\"_blank\">zmchel</a>",
        "version" => ZM_PB_VER,
        "author" => "<a href=\"https://t.me/nvv8896\" target=\"_blank\">zmchel</a>",
        "language" => ZM_PB_ADMINLANGNAME,
        "fields" => array(
            "db_action" => array("FriendlyName" => $module_translates->db_action->title, "Type" => "yesno", "Size" => "25", "Description" => $module_translates->db_action->description),
        )
    );
    	
    return $config;
}
