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
                if ($measurementEvents[$i]->getPluginName() == $currentEvent->getPluginName() &&
                $measurementEvents[$i]->getSelector() == $currentEvent->getSelector()) {
                    $found = true;
                    break;
                }
            }
            $this->assertTrue($found);
        }
    }
}