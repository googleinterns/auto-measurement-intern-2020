<?php

/**
 * Generates Javascript measurement code for events of Formidable Forms
 *
 * Class FormidableFormInjector
 */
class FormidableFormInjector{

    /**
     * List of events of Formidable Forms
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
                if (document.querySelector("button.frm_button_submit") != null) {
                    document.querySelector("button.frm_button_submit").addEventListener("click", function() {
                        alert("Formidable Forms: Form Submitted");
                    });
                } 
         </script>';

    /**
     * FormidableFormInjector constructor.
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