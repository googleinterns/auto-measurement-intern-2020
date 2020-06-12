<?php
/**
 * Plugin Name: Shirshu
 */

include(__DIR__ . "/src/Shirshu.php");

function SS(){
    return Shirshu::getInstance();
}

$GLOBALS['shirshu'] = SS();
