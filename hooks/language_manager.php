<?php
if (!defined('WHMCS')) die('Direct access not allowed');

add_hook('AfterCronJob', 10000, function () {
    try {
        zm_pb_lm_recheck_disabled();
    } catch (Throwable $error) {
        error_log('zmchel language manager: ' . $error->getMessage());
    }
});
