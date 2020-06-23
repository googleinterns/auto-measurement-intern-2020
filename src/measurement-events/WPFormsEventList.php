<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for WPForms plugin
 *
 * @class WPFormsEventList
 */
class WPFormsEventList extends MeasurementEventList {

    public function __construct() {
        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'WPForms',
            'category' => 'engagement',
            'action' => 'form_submit',
            'selector' => '.wpforms-submit-container button',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());
    }

}
