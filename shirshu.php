<?php
/**
 * Plugin Name: Shirshu
 */

include(__DIR__ . "/src/Shirshu.php");

function SS(){
    return Shirshu::getInstance();
}

if(!function_exists('get_plugins')){
    require_once ABSPATH . 'wp-admin/includes/plugin.php';
}

function check(){
    $plugins = get_plugins();
    $plugin_keys = array_keys($plugins);
    for($i = 0;$i < count($plugin_keys);$i++){
        echo $plugins[$plugin_keys[$i]]['Name'];
        echo '<br>';
    }
    //fail('fail');
}
add_action('plugins_loaded', 'check');

$GLOBALS['shirshu'] = SS();
