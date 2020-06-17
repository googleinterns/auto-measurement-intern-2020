<?php

/**
 * Generates Javascript measurement code for events of Contact Form 7
 *
 * Class ContactFormInjector
 */

class ContactFormInjector {

    /**
     * List of events of Contact Form 7
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
                if (document.querySelector("input.wpcf7-submit") != null) {
                    document.querySelector("input.wpcf7-submit").addEventListener("click", function() {
                        alert("Contact Form 7: Form Submitted");
                    });
                }
         </script>';

    /**
     * ContactFormInjector constructor.
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