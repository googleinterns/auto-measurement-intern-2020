<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for Ninja Forms plugin
 *
 * @class NinjaFormsEventList
 */
class NinjaFormsEventList extends MeasurementEventList {

    public function __construct() {
        $pluginName = 'Ninja Forms';
        $categories = array('engagement');
        $actions = array('form_submit');
        //$selectors = array('div.nf-field-container.submit-container [type="button"]');
        $selectors = array('div.nf-form-content form');
        //$onEvents = array('click');
        $onEvents = array('submit');
        $secondLayerSelectors = array('document');
        $secondLayerOn = array('nfFormReady');

        $tempEvents = array();
        for($i = 0; $i < count($selectors); $i++) {
            $newEvent = new MeasurementEvent($pluginName, $categories[$i],
                $actions[$i], $selectors[$i], $onEvents[$i], $secondLayerSelectors[$i], $secondLayerOn[$i]);
            array_push($tempEvents, $newEvent);
        }
        $this->setEvents($tempEvents);
    }

}
