<?php


class ContactFormInjector {


    private $eventList = null;

    private $event_submitForm =
        '<script>
                if (document.querySelector("input.wpcf7-submit") != null) {
                    document.querySelector("input.wpcf7-submit").addEventListener("click", function() {
                        alert("Contact Form 7: Form Submitted");
                    });
                }
         </script>';

    public function __construct() {
        $this->eventList = array();
        array_push($this->eventList, $this->event_submitForm);
    }

    public function injectCode() {
        foreach ($this->eventList as $event) {
            echo $event . '<br>';
        }
    }
}