<?php


class NinjaFormInjector
{
    private $eventList = null;



    private $event_submitForm =
        '<script>
                  jQuery(document).on("nfFormReady", function(e, layoutView) {
                    if (document.querySelector(\'div.nf-field-container.submit-container [type="button"]\') != null) {
                        alert("detected nj");
                        document.querySelector(\'div.nf-field-container.submit-container [type="button"]\').addEventListener("click", function() {
                            alert("Ninja Forms: Form Submitted");
                        });
                    }
                  });                 
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