<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for Formidable Forms plugin
 *
 * @class FormidableFormsEventList
 */
class FormidableFormsEventList extends MeasurementEventList {

    public function __construct() {
        $builder = MeasurementEvent::createBuilder([
            'pluginName' => 'Formidable Forms',
            'category' => 'engagement',
            'action' => 'contact_form_submit',
            'selector' => '.frm_fields_container .frm_button_submit',
            'on' => 'click'
        ]);
        $this->addEvent($builder->build());
    }

}
