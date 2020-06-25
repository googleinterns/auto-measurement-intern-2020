<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for Ninja Forms plugin
 *
 * @class NinjaFormsEventList
 */
class NinjaFormsEventList extends MeasurementEventList {

    public function __construct() {
        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Ninja Forms',
            'category' => 'engagement',
            'action' => 'form_submit',
            'selector' => 'div.nf-field-container.submit-container [type="button"]',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());
    }

}
