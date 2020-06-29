<?php
include 'PluginDetector.php';
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
     * Instance of the plugin detector
     *
     * @var PluginDetector
     */
    protected $pluginDetector = null;

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
        $this->supportedPlugins = array('Contact Form 7' => 'contact-form-7',
            'Formidable Forms' => 'formidable',
            'Ninja Forms' => 'ninja-forms',
            'WooCommerce' => 'woocommerce',
            'WPForms' => 'wpforms',
            'WPForms Lite' => 'wpforms-lite');
        $this->pluginDetector = new PluginDetector($this->supportedPlugins);
        add_action('plugins_loaded', array($this, 'getActivePlugins'));
    }

    /**
     * Returns a list of plugins that Shirshu supports
     *
     * @return array of strings
     */
    protected function getSupportedPlugins(){
        return $this->supportedPlugins;
    }

    /**
     * Determines active plugins once WordPress loads plugins
     */
    public function getActivePlugins() {
        $activePlugins = $this->pluginDetector->getActivePlugins();
        $this->measureCodeInjector = new MeasurementCodeInjector($activePlugins);
    }

}
