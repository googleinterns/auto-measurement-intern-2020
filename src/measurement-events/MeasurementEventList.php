<?php
include 'MeasurementEvent.php';


class MeasurementEventList {

    private static $instance = null;

    private $pluginName;
    private $eventCategories;
    private $eventActions;
    private $eventSelectors;

    private $measurementEvents;

    public static function getInstance() {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

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
