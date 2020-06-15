<?php


class MeasurementEventFactory {

    protected static $instance = null;

    public static function getInstance() {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function createMeasurementEvents($pluginName) {
        //TODO: create list of events based on plugin name
    }

}
