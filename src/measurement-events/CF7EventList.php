<?php
include_once 'MeasurementEventList.php';


class CF7EventList extends MeasurementEventList {

    public function __construct() {
        $pluginName = 'Contact Form 7';
        $categories = array('engagement');
        $actions = array('contact_form_submit');
        $selectors = array('.wpcf7-form .wpcf7-submit');

        $tempEvents = array();
        for($i = 0; $i < count($selectors); $i++) {
            $newEvent = new MeasurementEvent($pluginName, $categories[$i],
                $actions[$i], $selectors[$i]);
            array_push($tempEvents, $newEvent);
        }
        $this->setEvents($tempEvents);
    }

}