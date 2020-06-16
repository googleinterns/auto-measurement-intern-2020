<?php
include 'PluginDetector.php';
include 'MeasurementEventFactory.php';

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

    private $eventFactory = null;

    /**
     * Injector constructor.
     * @param $supportedPlugins
     */
    public function __construct($supportedPlugins) {
        $this->pluginDetector = new PluginDetector($supportedPlugins);
        $this->eventFactory = MeasurementEventFactory::getInstance();
        add_action('plugins_loaded', array($this, 'setActivePlugins'));
        add_action('wp_footer', array($this, 'injectEventTracking'));
        add_action('wp_footer', array($this, 'ajax_wc_review_cart_hacked_solution'), 999);
    }

    public function ajax_wc_review_cart_hacked_solution(){
        ?>
            <script>
                jQuery(function($){
                    $(document.body).on("added_to_cart", function(){
                        alert("Got an event: review_cart");
                    });
                });
            </script>
        <?php
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
    
    public function injectEventTracking() {
        foreach($this->activePlugins as $pluginName) {
            $measurementEventList = $this->eventFactory->createMeasurementEventList($pluginName);
            foreach($measurementEventList->getEvents() as $measurementEvent) {
                $measurementEvent->toJavascript();
            }
        }
    }
}
