<?php
include 'MeasurementEvent.php';


class MeasurementEventList {

    private $measurementEvents;

    public function getEvents() {
        return $this->measurementEvents;
    }

    protected function setEvents($events) {
        $this->measurementEvents = $events;
    }

}
