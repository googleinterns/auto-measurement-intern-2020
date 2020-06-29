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
            let eventConfigurations = $jsonString;
            let config;
            for(config of eventConfigurations) {
                const thisConfig = config;
                document.addEventListener(config.on, function(e){
                    if(e.target.matches(thisConfig.selector)) {
                        alert('Got an event called: '.concat(thisConfig.action));
                    }else if(e.target.matches(thisConfig.selector.concat(' *'))){
                        alert('Got an event called: '.concat(thisConfig.action));
                    }
                }, true);
            }
        </script>";

        $this->expectOutputString($expectedString);
    }
}
