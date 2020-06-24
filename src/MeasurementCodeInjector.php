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
        $this->eventConfigurations = $this->setEventConfigurations();
        add_action('wp_footer', array($this, 'injectEventTracking'), 999);
    }

    /**
     * Sets the event configurations
     */
    public function setEventConfigurations() {
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

        ?><script>
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
                console.log(eventConfigurations);
                console.log(eventConfigurations[0].pluginName);
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
        </script><?php

    }
}
