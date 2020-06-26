<?php
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
     * MeasurementEventFactory instance
     *
     * @var MeasurementEventFactory
     */
    private $eventFactory = null;

    /**
     * Injector constructor.
     * @param $activePlugins
     */
    public function __construct($activePlugins) {
        $this->activePlugins = $activePlugins;
        $this->eventFactory = MeasurementEventFactory::getInstance();
        $this->eventConfigurations = $this->buildEventConfigurations();
        add_action('wp_head', array($this, 'injectEventTracking'), 1);
    }

    /**
     * Sets the event configurations
     */
    public function buildEventConfigurations() {
        $eventConfigurations = array();
        foreach($this->activePlugins as $pluginName) {
            $measurementEventList = $this->eventFactory->createMeasurementEventList($pluginName);
            if($measurementEventList != null) {
                foreach ($measurementEventList->getEvents() as $measurementEvent) {
                    array_push($eventConfigurations, $measurementEvent);
                }
            }
        }
        return $eventConfigurations;
    }

    /**
     * Gets the event configurations
     */
    public function getEventConfigurations() {
        return $this->eventConfigurations;
    }

    /**
     * Creates list of measurement event configurations and javascript to inject
     */
    public function injectEventTracking() {
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
