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
        add_action('wp_footer', array($this, 'injectEventTracking'), 999);
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
                    $this->configureEvent($measurementEvent);
                }
            }
        }
        ?>
        <script>
            /**
             * Keeps track of Ninja forms that have already been tracked
             *
             * @type Array of elements
             */
            let ninjaFormsAddedNodes = [];

            /**
             * Adds event listener to element that corresponds to the event
             *
             * @param config - configuration for a trackable event
             */
            function addListeners(config) {
                let nodeList = document.querySelectorAll(config.selector);
                console.log(config);
                for(node of nodeList) {
                    if(!ninjaFormsAddedNodes.includes(node)) {
                        node.addEventListener(config.on, function () {
                            alert('Got an event called: '.concat(config.action));
                        });
                        if(config.pluginName == 'Ninja Forms') ninjaFormsAddedNodes.push(node);
                    }
                }
            }

            /**
             * Adds first or second layer event listeners on DOM loaded
             */
            jQuery(function($){
                let eventConfigurations = <?php echo json_encode($this->eventConfigurations); ?>;
                for(config of eventConfigurations) {
                    if(config.secondLayerOn === null) {
                        addListeners(config);
                    }else{
                        let secondLayerNode;
                        switch(config.secondLayerSelector) {
                            case 'document':
                                secondLayerNode = $(document);
                                break;
                            case 'document.body':
                                secondLayerNode = $(document.body);
                                break;
                            default:
                                secondLayerNode = $(config.secondLayerSelector);
                                break;
                        }
                        const configCopy = JSON.parse(JSON.stringify(config));
                        secondLayerNode.on(config.secondLayerOn, function(){
                            addListeners(configCopy);
                        });
                    }
                }
            });
        </script>
        <?php
    }

    /**
     * Creates a config object from MeasurementEvent object and adds it to list to be injected
     *
     * @param $measurementEvent - MeasurementEvent
     */
    private function configureEvent($measurementEvent) {
        $newEvent = array();
        $newEvent['pluginName'] = $measurementEvent->getPluginName();
        $newEvent['category'] = $measurementEvent->getCategory();
        $newEvent['action'] = $measurementEvent->getAction();
        $newEvent['selector'] = $measurementEvent->getSelector();
        $newEvent['on'] = $measurementEvent->getOnEvent();
        $newEvent['secondLayerSelector'] = $measurementEvent->getSecondLayerSelector();
        $newEvent['secondLayerOn'] = $measurementEvent->getSecondLayerOnEvent();
        array_push($this->eventConfigurations, $newEvent);
    }
}
