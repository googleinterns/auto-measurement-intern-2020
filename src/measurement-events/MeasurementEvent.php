<?php


/**
 * Represents a single event that Shirshu tracks
 *
 * @class MeasurementEvent
 */
class MeasurementEvent {

    /**
     * The plugin that this event is associated with
     *
     * @var string
     */
    private $pluginName;

    /**
     * Event category e.g. ecommerce, engagement
     *
     * @var string
     */
    private $eventCategory;

    /**
     * Name of specific event
     *
     * @var string
     */
    private $eventAction;

    /**
     * CSS selector used to grab element that this event is tied to
     *
     * @var string
     */
    private $eventCssSelector;

    private $onEvent;

    private $secondLayerSelector;

    private $secondLayerOnEvent;

    /**
     * MeasurementEvent constructor.
     * @param $pluginName - string
     * @param $category - string
     * @param $action - string
     * @param $selector - string
     * @param $on - string
     */
    public function __construct($pluginName, $category, $action, $selector, $on, $secondLayerSelector = null, $secondLayerOn = null) {
        $this->pluginName = $pluginName;
        $this->eventCategory = $category;
        $this->eventAction = $action;
        $this->eventCssSelector = $selector;
        $this->onEvent = $on;
        $this->secondLayerSelector = $secondLayerSelector;
        $this->secondLayerOnEvent = $secondLayerOn;
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

    public function getOnEvent() {
        return $this->onEvent;
    }

    public function getSecondLayerSelector() {
        return $this->secondLayerSelector;
    }

    public function getSecondLayerOnEvent() {
        return $this->secondLayerOnEvent;
    }

}
