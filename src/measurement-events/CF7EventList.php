<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for Contact Form 7 plugin
 *
 * @class CF7EventList
 */
class CF7EventList extends MeasurementEventList {

    public function __construct() {
        $builder = MeasurementEvent::createBuilder('Contact Form 7')->category('engagement');
        $builder->action('contact_form_submit')->selector('.wpcf7-form .wpcf7-submit');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());
    }

}
