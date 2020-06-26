<?php

/**
 * Class MeasurementEventTest
 *
 * @package Auto_Measurement_Intern_2020
 */

class MeasurementEventTest extends WP_UnitTestCase {
    /**
     * Tests if the sets of events in the active plugins are included in the tracking event configurations.
     */
    public function testEventConfigurations() {

        $activePlugins = array('Contact Form 7', 'Formidable Forms', 'Ninja Forms', 'WooCommerce', 'WPForms',
            'WPForms Lite');

        $measurementEvents = array();

        foreach($activePlugins as $pluginName) {
            $tempEventList = null;
            switch($pluginName) {
                case 'WooCommerce':
                    $tempEventList = new WoocommerceEventList();
                    break;
                case 'WPForms Lite':
                case 'WPForms':
                    $tempEventList = new WPFormsEventList();
                    break;
                case 'Contact Form 7':
                    $tempEventList = new CF7EventList();
                    break;
                case 'Formidable Forms':
                    $tempEventList = new FormidableFormsEventList();
                    break;
                case 'Ninja Forms':
                    $tempEventList = new NinjaFormsEventList();
                    break;
            }
            $tempEvents = array();
            if ($tempEventList != null) {
                $tempEvents = $tempEventList->getEvents();
            }
            $measurementEvents = array_merge($measurementEvents, $tempEvents);
        }

        $measurementCodeInjector = new MeasurementCodeInjector($activePlugins);

        $eventConfigurations = $measurementCodeInjector->getEventConfigurations();

        $this->assertEquals(count($measurementEvents), count($eventConfigurations));

        $found = false;

        for ($i = 0; $i < count($measurementEvents); $i++) {
            $found = false;
            foreach($eventConfigurations as $currentEvent) {
                if (json_encode($measurementEvents[$i] === json_encode($currentEvent))) {
                    $found = true;
                    break;
                }
            }
            $this->assertTrue($found);
        }
    }

    /**
     * Tests if the expected Javascript code is printed for a given sets of events
     */
    public function testInjectedCode() {
        $activePlugins = array('Contact Form 7', 'Formidable Forms', 'Ninja Forms', 'WooCommerce', 'WPForms',
            'WPForms Lite');

        $measurementCodeInjector = new MeasurementCodeInjector($activePlugins);

        $eventConfigurations = $measurementCodeInjector->getEventConfigurations();

        $measurementCodeInjector->injectEventTracking();

        $jsonString = json_encode($eventConfigurations);

        $expectedString = "<script>
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
                let eventConfigurations = $jsonString;
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
        </script>";

        $this->expectOutputString($expectedString);
    }
}
