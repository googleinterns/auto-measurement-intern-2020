<?php
include_once 'MeasurementEventList.php';


class WPFormsEventList extends MeasurementEventList {

    public function __construct() {
        $pluginName = 'WPForms';
        $categories = array('engagement');
        $actions = array('form_submit');
        $selectors = array('.wpforms-submit-container button');

        $tempEvents = array();
        for($i = 0; $i < count($selectors); $i++) {
            $newEvent = new MeasurementEvent($pluginName, $categories[$i],
                $actions[$i], $selectors[$i]);
            array_push($tempEvents, $newEvent);
        }
        $this->setEvents($tempEvents);
    }

}
