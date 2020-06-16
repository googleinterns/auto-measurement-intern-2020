<?php
include 'measurement-events/eventListIncludes.php';


class MeasurementEventFactory {

    private static $instance = null;

    public static function getInstance() {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

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
        }
        return $eventList;
    }

}
