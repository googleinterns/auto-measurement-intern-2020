<?php

/**
 * Use to instantiate MeasurementEvent objects
 *
 * @class MeasurementEventBuilder
 */
class MeasurementEventBuilder {

    private $configuration;

    function __construct(array $config) {
        $this->configuration = $config;
    }

    function getPluginName() {
        return $this->configuration['pluginName'];
    }

    function getCategory() {
        return $this->configuration['category'];
    }

    function getAction() {
        return $this->configuration['action'];
    }

    function getSelector() {
        return $this->configuration['selector'];
    }

    function getOn() {
        return $this->configuration['on'];
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

    static function createBuilder($plugin) {
        return new MeasurementEventBuilder($plugin);
    }

    function __construct(MeasurementEventBuilder $builder) {
        $this->pluginName = $builder->getPluginName();
        $this->eventCategory = $builder->getCategory();
        $this->eventAction = $builder->getAction();
        $this->eventCssSelector = $builder->getSelector();
        $this->onEvent = $builder->getOn();
    }

    public function jsonSerialize() {
        return [
            'pluginName' => $this->pluginName,
            'category' => $this->eventCategory,
            'action' => $this->eventAction,
            'selector' => $this->eventCssSelector,
            'on' => $this->onEvent
        ];
    }

}
