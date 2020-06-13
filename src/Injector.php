<?php
include 'Detector.php';

/**
 * Injects Javascript based on the current active plugins
 *
 * Class Injector
 */
class Injector {
    /**
     * A list of user's current active plugins that Shirshu supports
     *
     * @var array of string
     */
    private $activePlugins = null;

    /**
     * Plugin Detector
     *
     * @var Detector
     */
    private $pluginDetector = null;

    /**
     * Injector constructor.
     * @param $supportedPlugins
     */
    public function __construct($supportedPlugins) {
        $this->pluginDetector = new Detector($supportedPlugins);
        add_action('plugins_loaded', array($this, 'setActivePlugins'));
    }

    /**
     * Determines active plugins once WordPress loads plugins
     */
    public function setActivePlugins() {
        $this->activePlugins = $this->pluginDetector->getActivePlugins();
    }

    public function printActivePlugins() {
        foreach($this->activePlugins as $activePlugin){
            echo $activePlugin . '<br>';
        }
    }
    
    //TODO: Inject Javascript to the pages and track the events
}