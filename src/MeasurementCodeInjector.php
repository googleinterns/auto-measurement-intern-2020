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
     * Holds a list of event configurations to be injected
     *
     * @var array
     */
    private $eventConfigurations;

    /**
     * Plugin PluginDetector
     *
     * @var PluginDetector
     */
    private $pluginDetector = null;

    /**
     * MeasurementEventFactory instance
     *
     * @var MeasurementEventFactory
     */
    private $eventFactory = null;

    /**
     * Injector constructor.
     * @param $supportedPlugins
     */
    public function __construct($supportedPlugins) {
        $this->eventConfigurations = array();
        $this->pluginDetector = new PluginDetector($supportedPlugins);
        $this->eventFactory = MeasurementEventFactory::getInstance();
        add_action('plugins_loaded', array($this, 'setActivePlugins'));
        add_action('wp_head', array($this, 'injectEventTracking'), 1);
    }

    /**
     * Determines active plugins once WordPress loads plugins
     */
    public function setActivePlugins() {
        $this->activePlugins = $this->pluginDetector->getActivePlugins();
    }

    /**
     * Creates list of measurement event configurations and javascript to inject
     */
    public function injectEventTracking() {
        foreach($this->activePlugins as $pluginName) {
            $measurementEventList = $this->eventFactory->createMeasurementEventList($pluginName);
            if($measurementEventList != null) {
                foreach ($measurementEventList->getEvents() as $measurementEvent) {
                    array_push($this->eventConfigurations, $measurementEvent);
                }
            }
        }
        ?>
        <script>
            let eventConfigurations = <?php echo json_encode($this->eventConfigurations); ?>;
            let config;
            for(config of eventConfigurations) {
                const thisConfig = config;
                document.addEventListener(config.on, function(e){
                    if(e.target.matches(thisConfig.selector)) {
                        alert('Got an event called: '.concat(thisConfig.action));
                    }else if(e.target.matches(thisConfig.selector.concat(' *'))){
                        alert('Got an event called: '.concat(thisConfig.action));
                    }
                }, true)
            }
        </script>
        <?php
    }
}
