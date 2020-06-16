<?php


class NinjaFormInjector
{
    private $eventList = null;



    private $event_submitForm =
        '<script>
//                jQuery(function($){
//                    document.querySelectorAll(\'div.nf-field-container.submit-container [type="button"]\')[0].addEventListener("click", function() {
//                        alert("Ninja Forms: Form Submitted");
//                    });
//                })
//                if (document.querySelectorAll(\'div.nf-field-container.submit-container [type="button"]\') != null) {
//                    alert("detected nj");
//                    document.querySelectorAll(\'div.nf-field-container.submit-container [type="button"]\')[0].addEventListener("click", function() {
//                        alert("Ninja Forms: Form Submitted");
//                    });
//                } else {
//                    alert(\'Did not detect nj\');
//                }

                  jQuery(document).on("nfFormReady", function(e, layoutView) {
                                       document.querySelectorAll(\'div.nf-field-container.submit-container [type="button"]\')[0].addEventListener("click", function() {
                      alert("Ninja Forms: Form Submitted");                   });
   
                  } );
                  

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