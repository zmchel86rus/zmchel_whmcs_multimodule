<?php
if (!defined('WHMCS')) die('Direct access not allowed');

add_hook('DailyCronJob', 10000, function () {
    try {
        zm_pb_lm_recheck_disabled();
        zm_pb_lm_restore_added_languages();
    } catch (Throwable $error) {
        error_log('zmchel language manager: ' . $error->getMessage());
    }
});
