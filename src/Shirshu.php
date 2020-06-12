<?php

/**
 * Main Shirshu class
 *
 * @class Shirshu
 */
final class Shirshu{

    /**
     * List of plugins Shirshu supports for event tracking
     *
     * @var array of strings
     */
    private $supportedPlugins;

    protected function getSupportedPlugins(){
        return $this->supportedPlugins;
    }

    /**
     * Single instance of the class
     *
     * @var Shirshu
     */
    protected static $instance = null;

    /**
     * Returns the main Shirshu instance
     *
     * @see SS()
     * @return Shirshu - Main instance
     */
    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Create array of supported plugins that Shirshu currently supports
     */
    private function defineSupportedPlugins(){
        $this->supportedPlugins = array('Contact Form 7', 'Formidable Forms', 'Ninja Forms', 'WooCommerce', 'WPForms', 'WPForms Lite');
    }

    private function __construct(){
        $this->defineSupportedPlugins();
    }

}
