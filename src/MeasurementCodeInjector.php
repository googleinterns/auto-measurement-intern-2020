<?php
include 'PluginDetector.php';
include 'ContactFormInjector.php';
include 'FormidableFormInjector.php';
include 'NinjaFormInjector.php';
include 'WoocommerceInjector.php';
include 'WPFormInjector.php';

/**
 * Injects Javascript based on the current active plugins
 *
 * Class Injector
 */
class MeasurementCodeInjector {
    /**
     * A list of user's current active plugins that Shirshu supports
     *
     * @var array of string
     */
    private $activePlugins = null;

    /**
     * Plugin PluginDetector
     *
     * @var PluginDetector
     */
    private $pluginDetector = null;


    private $codeInjectorMap = null;


    private $codeInjectorList = null;


    /**
     * Injector constructor.
     * @param $supportedPlugins
     * @param $codeInjectorMap
     */
    public function __construct($supportedPlugins, $codeInjectorMap) {
        $this->pluginDetector = new PluginDetector($supportedPlugins);


        $this->codeInjectorMap = $codeInjectorMap;


        add_action('plugins_loaded', array($this, 'setActivePlugins'));

    }

    /**
     * Determines active plugins once WordPress loads plugins
     */
    public function setActivePlugins() {
        $this->activePlugins = $this->pluginDetector->getActivePlugins();
        
        //create codeInjectorList
        $this->codeInjectorList = $this->createCodeInjectorList($this->activePlugins);

        //inject the Javascript to the webpage
        add_action('wp_footer', array($this, 'injectMeasurementCode'));

    }

    public function printActivePlugins() {
        foreach($this->activePlugins as $activePlugin){
            echo $activePlugin . '<br>';
        }
    }
    

    public function createCodeInjectorList($activePlugins) {
        $injectorList = array();
        foreach ($activePlugins as $activePlugin) {
            $currentInjector = clone $this->codeInjectorMap[$activePlugin];
            array_push($injectorList, $currentInjector);
        }
        return $injectorList;
    }

    public function injectMeasurementCode() {
        foreach ($this->codeInjectorList as $codeInjector) {
            $codeInjector->injectCode();
        }
    }




}
