<?php


class MeasurementEvent {

    private $pluginName;

    private $eventCategory;

    private $eventAction;

    private $eventCssSelector;

    public function __construct($pluginName, $category, $action, $selector) {
        $this->pluginName = $pluginName;
        $this->eventCategory = $category;
        $this->eventAction = $action;
        $this->eventCssSelector = $selector;
    }

    public function toJavascript() {
        if($this->pluginName != 'Ninja Forms') {
            ?>
            <script>
                nodeList = document.querySelectorAll("<?php echo $this->eventCssSelector;?>");
                for (node of nodeList) {
                    node.addEventListener("click", function () {
                        alert("Got an event called: <?php echo $this->eventAction;?>");
                    });
                }
            </script>
            <?php
        }else{
            ?>
            <script>
                jQuery(document).on("nfFormReady", function(e, layoutView){
                    let nodeList = document.querySelectorAll('div.nf-field-container.submit-container [type="button"]');
                    for(node of nodeList) {
                        node.addEventListener("click", function(){
                            alert("Got an event called: <?php echo $this->eventAction; ?>");
                        });
                    }
                })
            </script>
            <?php
        }
    }

    public function getPluginName() {
        return $this->pluginName;
    }

    public function getCategory() {
        return $this->eventCategory;
    }

    public function getAction() {
        return $this->eventAction;
    }

    public function getSelector() {
        return $this->eventCssSelector;
    }

}
