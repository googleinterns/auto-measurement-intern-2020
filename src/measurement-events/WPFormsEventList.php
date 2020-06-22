<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for WPForms plugin
 *
 * @class WPFormsEventList
 */
class WPFormsEventList extends MeasurementEventList {

    public function __construct() {
        $builder = MeasurementEvent::createBuilder('WPForms')->category('engagement');
        $builder->action('form_submit')->selector('.wpforms-submit-container button');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());
    }

}
