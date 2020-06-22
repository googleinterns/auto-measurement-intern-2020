<?php
include 'MeasurementEvent.php';


/**
 * Parent class for a specific plugin's event list
 *
 * @class MeasurementEventList
 */
class MeasurementEventList {

    /**
     * Container for list of events - intended to be used per plugin
     *
     * @var MeasurementEvent[]
     */
    private $measurementEvents = array();

    protected function addEvent(MeasurementEvent $e) {
        array_push($this->measurementEvents, $e);
    }

    public function getEvents() {
        return $this->measurementEvents;
    }

}
