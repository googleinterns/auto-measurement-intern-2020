<?php


class WPFormInjector
{
    private $eventList = null;

    private $event_submitForm =
        '<script>
                if (document.querySelector("button.wpforms-submit") != null) {
                    document.querySelector("button.wpforms-submit").addEventListener("click", function() {
                        alert("WPForms: Form Submitted");
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