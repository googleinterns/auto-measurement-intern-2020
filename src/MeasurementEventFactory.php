<?php
include 'measurement-events/eventListIncludes.php';

/**
 * Main Measurement Event Factory class that produces Measurement Event objects.
 *
 * @class MeasurementEventFactory
 */
class MeasurementEventFactory {

    /**
     * Instance of the class
     *
     * @var MeasurementEventFactory
     */
    private static $instance = null;

    /**
     * Gets the instance for this class
     *
     * @return MeasurementEventFactory
     */
    public static function getInstance() {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Instantiates a subclass of MeasurementEventList based on the given plugin name
     *
     * @param $pluginName - string that represents the plugin name to create a list of events for
     * @return MeasurementEventList
     */
    public function createMeasurementEventList($pluginName) {
        $eventList = null;
        switch($pluginName) {
            case 'WooCommerce':
                $eventList = new WoocommerceEventList();
                break;
            case 'WPForms Lite':
            case 'WPForms':
                $eventList = new WPFormsEventList();
                break;
            case 'Contact Form 7':
                $eventList = new CF7EventList();
                break;
            case 'Formidable Forms':
                $eventList = new FormidableFormsEventList();
                break;
            case 'Ninja Forms':
                $eventList = new NinjaFormsEventList();
                break;
        }
        return $eventList;
    }

}
