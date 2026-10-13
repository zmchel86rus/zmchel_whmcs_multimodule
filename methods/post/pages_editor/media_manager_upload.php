<?php
if (!defined('ZM_PB_VER')) die('Direct access not allowed');

use Illuminate\Database\Capsule\Manager as Capsule;

        header('Content-Type: application/json; charset=utf-8');
        exit(json_encode(zm_pb_media_manager_upload($_FILES['file'] ?? null)));
