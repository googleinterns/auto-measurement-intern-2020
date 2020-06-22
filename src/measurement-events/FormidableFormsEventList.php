<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for Formidable Forms plugin
 *
 * @class FormidableFormsEventList
 */
class FormidableFormsEventList extends MeasurementEventList {

    public function __construct() {
        $builder = MeasurementEvent::createBuilder('Formidable Forms')->category('engagement');
        $builder->action('contact_form_submit')->selector('.frm_fields_container .frm_button_submit');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());
    }

}
