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
            case 'Woocommerce':
                $eventList = new WoocommerceEventList();
                break;
        }
        return $eventList;
    }

}
