<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for Contact Form 7 plugin
 *
 * @class CF7EventList
 */
class CF7EventList extends MeasurementEventList {

    public function __construct() {
        $pluginName = 'Contact Form 7';
        $categories = array('engagement');
        $actions = array('contact_form_submit');
        $selectors = array('.wpcf7-form .wpcf7-submit');
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
