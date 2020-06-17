<?php
include_once 'MeasurementEventList.php';


class NinjaFormsEventList extends MeasurementEventList {

    public function __construct() {
        $pluginName = 'Ninja Forms';
        $categories = array('engagement');
        $actions = array('form_submit');
        $selectors = array('div.nf-field-container.submit-container [type="button"]');

        $tempEvents = array();
        for($i = 0; $i < count($selectors); $i++) {
            $newEvent = new MeasurementEvent($pluginName, $categories[$i],
                $actions[$i], $selectors[$i]);
            array_push($tempEvents, $newEvent);
        }
        $this->setEvents($tempEvents);
    }

}
