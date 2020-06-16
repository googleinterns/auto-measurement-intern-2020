<?php


class MeasurementEvent {

    private $pluginName;

    private $eventCategory;

    private $eventAction;

    private $eventCssSelector;

    public function __construct($pluginName, $category, $action, $selector) {
        $this->pluginName = $pluginName;
        $this->eventCategory = $category;
        $this->eventAction = $action;
        $this->eventCssSelector = $selector;
    }

    public function toJavascript() {
        $result = '<script>document.querySelectorAll(' . '"' . $this->eventCssSelector . '"' . ')[0].addEventListener("click",
         function(){alert("Got an event called: ' . $this->eventAction . '");});</script>';
        //$result = '<script>console.log(document.querySelectorAll(' . '"' . $this->eventCssSelector . '"' . '));</script>';
        return $result;
    }

    public function getPluginName() {
        return $this->pluginName;
    }

    public function getCategory() {
        return $this->eventCategory;
    }

    public function getAction() {
        return $this->eventAction;
    }

    public function getSelector() {
        return $this->eventCssSelector;
    }

}
