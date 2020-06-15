<?php
include 'MeasurementEvent.php';


class MeasurementEventList {

    private $pluginName;
    private $eventCategories;
    private $eventActions;
    private $eventSelectors;

    private $measurementEvents;

    public function getPluginName() {
        return $this->pluginName;
    }

    public function getCategories() {
        return $this->eventCategories;
    }

    public function getActions() {
        return $this->eventActions;
    }

    public function getSelectors() {
        return $this->eventSelectors;
    }

    public function getEvents() {
        return $this->measurementEvents;
    }

    protected function setPluginName($name) {
        $this->pluginName = $name;
    }

    protected function setCategories($categories) {
        $this->eventCategories = $categories;
    }

    protected function setActions($actions) {
        $this->eventActions = $actions;
    }

    protected function setSelectors($selectors) {
        $this->eventSelectors = $selectors;
    }

    protected function setEvents($events) {
        $this->measurementEvents = $events;
    }

}
