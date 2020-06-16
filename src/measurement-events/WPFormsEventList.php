<?php
include_once 'MeasurementEventList.php';


class WPFormsEventList extends MeasurementEventList {

    public function __construct() {
        $this->setPluginName('WPForms');

        $tempCategories = array('engagement');
        $this->setCategories($tempCategories);

        $tempActions = array('form_submit');
        $this->setActions($tempActions);

        $tempSelectors = array('.wpforms-submit-container button');
        $this->setSelectors($tempSelectors);

        $tempEvents = array();
        for($i = 0; $i < count($this->getSelectors()); $i++) {
            $newEvent = new MeasurementEvent($this->getPluginName(), $this->getCategories()[$i],
                $this->getActions()[$i], $this->getSelectors()[$i]);
            array_push($tempEvents, $newEvent);
        }
        $this->setEvents($tempEvents);
    }

}
