<?php

/**
 * Generates Javascript measurement code for events of Ninja Forms
 *
 * Class NinjaFormInjector
 */
class NinjaFormInjector
{
    /**
     * List of events of Ninja Forms
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
                  jQuery(document).on("nfFormReady", function(e, layoutView) {
                    if (document.querySelector(\'div.nf-field-container.submit-container [type="button"]\') != null) {
                        document.querySelector(\'div.nf-field-container.submit-container [type="button"]\').addEventListener("click", function() {
                            alert("Ninja Forms: Form Submitted");
                        });
                    }
                  });                 
         </script>';

    /**
     * NinjaFormInjector constructor.
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