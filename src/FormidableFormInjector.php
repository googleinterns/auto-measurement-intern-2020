<?php


class FormidableFormInjector
{
    private $eventList = null;

    private $event_submitForm =
        '<script>                
                if (document.querySelector("button.frm_button_submit") != null) {
                    document.querySelector("button.frm_button_submit").addEventListener("click", function() {
                        alert("Formidable Forms: Form Submitted");
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