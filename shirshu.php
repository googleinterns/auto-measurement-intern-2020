<?php
/**
 * Plugin Name: Shirshu
 */

include(__DIR__ . "/includes/class-shirshu.php");

function SS(){
    return Shirshu::getInstance();
}

$GLOBALS['shirshu'] = SS();
