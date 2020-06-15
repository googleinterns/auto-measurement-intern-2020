<?php


class MeasurementEvent {

    private $eventAction;

    private $eventCssSelector;

    private $pluginName;

    public function __construct($action, $selector) {
        $this->eventAction = $action;
        $this->eventCssSelector = $selector;
    }

    public function getAction() {
        return $this->eventAction;
    }

    public function getSelector() {
        return $this->eventCssSelector;
    }

    public function getPluginName() {
        return $this->pluginName;
    }

}
