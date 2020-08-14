<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_system'] = function() {

    log_message("info", "hook called");

    $dotenv_values = apc_fetch("dotenv");

    if ($dotenv_values) {
        log_message("info", "cache hit");
        $_ENV = array_merge($_ENV, $dotenv_values);
    } else {
        log_message("info", "cache miss");  
        $dotenv = Dotenv\Dotenv::createMutable(FCPATH);    
        $entries = $dotenv->load();
        apc_store("dotenv", $entries);
    }
};