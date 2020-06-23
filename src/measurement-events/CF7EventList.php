<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for Contact Form 7 plugin
 *
 * @class CF7EventList
 */
class CF7EventList extends MeasurementEventList {

    public function __construct() {
        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Contact Form 7',
            'category' => 'engagement',
            'action' => 'contact_form_submit',
            'selector' => '.wpcf7-form .wpcf7-submit',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());
    }

}
