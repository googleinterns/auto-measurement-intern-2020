<?php

/**
 * Generates Javascript measurement code for events of WP Forms
 *
 * Class WPFormInjector
 */
class WPFormInjector
{
    /**
     * List of Events of WP Forms
     *
     * @var array
     */
    private $eventList = null;

    /**
     * Measurement code for the event of submitting the form
     *
     * @var string
     */
    private $event_submitForm =
        '<script>
                if (document.querySelector("button.wpforms-submit") != null) {
                    document.querySelector("button.wpforms-submit").addEventListener("click", function() {
                        alert("WPForms: Form Submitted");
                    });
                }
         </script>';

    /**
     * WPFormInjector constructor.
     */
    public function __construct() {
        $this->eventList = array();
        array_push($this->eventList, $this->event_submitForm);
    }

    /**
     * Injects the code to the web page
     */
    public function injectCode() {
        foreach ($this->eventList as $event) {
            echo $event . '<br>';
        }
    }
}