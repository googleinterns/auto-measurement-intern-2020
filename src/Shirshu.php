<?php
include 'MeasurementCodeInjector.php';

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

    /**
     * Single instance of the class
     *
     * @var Shirshu
     */
    protected static $instance = null;

    /**
     * Instance of the event injector
     *
     * @var MeasurementCodeInjector
     */
    protected $measureCodeInjector = null;

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
     * Shirshu constructor
     */
    private function __construct(){
        $this->supportedPlugins = array('Contact Form 7', 'Formidable Forms', 'Ninja Forms', 'WooCommerce', 'WPForms',
            'WPForms Lite');
        $this->measureCodeInjector = new MeasurementCodeInjector($this->supportedPlugins);
    }

    /**
     * Returns a list of plugins that Shirshu supports
     *
     * @return array of strings
     */
    protected function getSupportedPlugins(){
        return $this->supportedPlugins;
    }

}
