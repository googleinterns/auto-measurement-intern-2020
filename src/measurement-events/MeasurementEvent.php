<?php

/**
 * Use to instantiate MeasurementEvent objects
 *
 * @class MeasurementEventBuilder
 */
class MeasurementEventBuilder {

    private $pluginName;
    private $eventCategory;
    private $eventAction;
    private $eventCssSelector;
    private $onEvent;
    private $secondLayerSelector;
    private $secondLayerOnEvent;

    function __construct($plugin) {
        $this->pluginName = $plugin;
    }

    function category($c) {
        $this->eventCategory = $c;
        return $this;
    }

    function action($a) {
        $this->eventAction = $a;
        return $this;
    }

    function selector($s) {
        $this->eventCssSelector = $s;
        return $this;
    }

    function on($o) {
        $this->onEvent = $o;
        return $this;
    }

    function secondLayerSelector($ss) {
        $this->secondLayerSelector = $ss;
        return $this;
    }

    function secondLayerOn($so) {
        $this->secondLayerOnEvent = $so;
        return $this;
    }

    function getPluginName() {
        return $this->pluginName;
    }

    function getCategory() {
        return $this->eventCategory;
    }

    function getAction() {
        return $this->eventAction;
    }

    function getSelector() {
        return $this->eventCssSelector;
    }

    function getOn() {
        return $this->onEvent;
    }

    function getSecondSelector() {
        return $this->secondLayerSelector;
    }

    function getSecondOn() {
        return $this->secondLayerOnEvent;
    }

    /**
     * returns MeasurementEvent object once all params have been set
     *
     * @return MeasurementEvent
     */
    function build() {
        return new MeasurementEvent($this);
    }

}

/**
 * Represents a single event that Shirshu tracks
 *
 * @class MeasurementEvent
 */
class MeasurementEvent implements JsonSerializable {

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

    /**
     * Inner layer event to bind to in order to track the event
     *
     * @var string
     */
    private $onEvent;

    /**
     * Selector for element that contains the event to bind to when inner element is ready to be tracked.
     *
     * @var string
     */
    private $secondLayerSelector;

    /**
     * Second layer event to bind to that says when element is ready to be tracked
     *
     * @var string
     */
    private $secondLayerOnEvent;

    static function createBuilder($plugin) {
        return new MeasurementEventBuilder($plugin);
    }

    function __construct(MeasurementEventBuilder $builder) {
        $this->pluginName = $builder->getPluginName();
        $this->eventCategory = $builder->getCategory();
        $this->eventAction = $builder->getAction();
        $this->eventCssSelector = $builder->getSelector();
        $this->onEvent = $builder->getOn();
        $this->secondLayerSelector = $builder->getSecondSelector();
        $this->secondLayerOnEvent = $builder->getSecondOn();
    }

    public function jsonSerialize() {
        return [
            'pluginName' => $this->pluginName,
            'category' => $this->eventCategory,
            'action' => $this->eventAction,
            'selector' => $this->eventCssSelector,
            'on' => $this->onEvent,
            'secondLayerSelector' => $this->secondLayerSelector,
            'secondLayerOn' => $this->secondLayerOnEvent
        ];
    }

}
