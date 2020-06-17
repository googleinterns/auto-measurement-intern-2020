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
        switch($this->pluginName) {
            case 'Woocommerce':
                switch($this->eventAction) {
                    case 'review_cart':
                        $this->wcReviewCartTempSol();
                        break;
                    case 'place_order':
                        $this->wcPlaceOrderTempSol();
                        break;
                    default:
                        $this->defaultSol();
                        break;

                }
                break;
            case 'Ninja Forms':
                $this->ninjaFormsTempSol();
                break;
            default:
                $this->defaultSol();
                break;
        }
    }

    private function defaultSol() {
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
    }

    private function wcReviewCartTempSol() {
        ?>
        <script>
            jQuery(function($){
                $(document.body).on("added_to_cart", function(){
                    nodeList = document.querySelectorAll("<?php echo $this->eventCssSelector;?>");
                    for (node of nodeList) {
                        node.addEventListener("click", function () {
                            alert("Got an event called: <?php echo $this->eventAction;?>");
                        });
                    }
                });
            });
        </script>
        <?php
    }

    private function wcPlaceOrderTempSol() {
        ?>
        <script>
            jQuery(function($){
                $("form.woocommerce-checkout").on("submit", function(){
                    alert("Got an event: place_order");
                });
            });
        </script>
        <?php
    }

    private function ninjaFormsTempSol() {
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
