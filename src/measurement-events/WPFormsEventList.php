<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for WPForms plugin
 *
 * @class WPFormsEventList
 */
class WPFormsEventList extends MeasurementEventList {

    public function __construct() {
        $pluginName = 'WPForms';
        $categories = array('engagement');
        $actions = array('form_submit');
        $selectors = array('.wpforms-submit-container button');
        $onEvents = array('click');
        $secondLayerSelectors = array(null);
        $secondLayerOn = array(null);

        $tempEvents = array();
        for($i = 0; $i < count($selectors); $i++) {
            $newEvent = new MeasurementEvent($pluginName, $categories[$i],
                $actions[$i], $selectors[$i], $onEvents[$i], $secondLayerSelectors[$i], $secondLayerOn[$i]);
            array_push($tempEvents, $newEvent);
        }
        $this->setEvents($tempEvents);
    }

}
