<?php


/**
 * Represents a single event that Shirshu tracks
 *
 * @class MeasurementEvent
 */
class MeasurementEvent {

    /**
     * The plugin that this event is associated with
     *
     * @var string
     */
    private $pluginName;

    /**
     * Event category e.g. ecommerce, engagement
     *
     * @var string
     */
    private $eventCategory;

    /**
     * Name of specific event
     *
     * @var string
     */
    private $eventAction;

    /**
     * CSS selector used to grab element that this event is tied to
     *
     * @var string
     */
    private $eventCssSelector;

    /**
     * MeasurementEvent constructor.
     * @param $pluginName - string
     * @param $category - string
     * @param $action - string
     * @param $selector - string
     */
    public function __construct($pluginName, $category, $action, $selector) {
        $this->pluginName = $pluginName;
        $this->eventCategory = $category;
        $this->eventAction = $action;
        $this->eventCssSelector = $selector;
    }

    /**
     * Produces Javascript that listens to this event
     */
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

    /**
     * Standard case javascript for elements that are loaded with the main page
     */
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

    /**
     * Review_cart event case: element is loaded on page after certain event
     */
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

    /**
     * Place_order event case: element's click handler is overwritten
     */
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

    /**
     * Ninja Forms submit_form case: form is loaded with ajax after main page loaded
     */
    private function ninjaFormsTempSol() {
        ?>
        <script>
            jQuery(document).on("nfFormReady", function(e, layoutView){
                let nodeList = document.querySelectorAll("<?php echo $this->eventCssSelector; ?>");
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
