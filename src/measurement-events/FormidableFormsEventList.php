<?php
include_once 'MeasurementEventList.php';


class FormidableFormsEventList extends MeasurementEventList {

    public function __construct() {
        $pluginName = 'Formidable Forms';
        $categories = array('engagement');
        $actions = array('contact_form_submit');
        $selectors = array('.frm_fields_container .frm_button_submit');

        $tempEvents = array();
        for($i = 0; $i < count($selectors); $i++) {
            $newEvent = new MeasurementEvent($pluginName, $categories[$i],
                $actions[$i], $selectors[$i]);
            array_push($tempEvents, $newEvent);
        }
        $this->setEvents($tempEvents);
    }

}
