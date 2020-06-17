<?php

/**
 * Generates Javascript measurement code for events of WooCommerce
 *
 * Class WoocommerceInjector
 */
class WoocommerceInjector {

    /**
     * List of events of WooCommerce
     *
     * @var array
     */
    private $eventList = null;

    /**
     * Measurement code for the event of adding an item to the cart
     *
     * @var string
     */
    private $event_add_to_cart =
        '<script>
                if (document.querySelector(".woocommerce ~ div .add_to_cart_button") != null) {
                    
                    document.querySelector(".woocommerce ~ div .add_to_cart_button").addEventListener("click", function() {
                        alert("Woocommerce: Add to Cart");
                    });
                }
         </script>';

    /**
     * Measurement code for the event of reviewing the cart (Not working)
     *
     * @var string
     */
    private $event_review_cart =
        '<script>
                if (document.querySelector("a.added_to_cart.wc-forward") != null) {
                    
                    document.querySelector("a.added_to_cart.wc-forward").addEventListener("click", function() {
                        alert("Woocommerce: Review Cart");
                    });
                }
         </script>';

    /**
     * Measurement code for the event of viewing the contents of the cart (Not working)
     *
     * @var string
     */
    private $event_cart_content =
        '<script>
                if (document.querySelector("a.cart-contents") != null) {
                    
                    document.querySelector("a.cart-contents").addEventListener("click", function() {
                        alert("Woocommerce: Cart Content");
                    });
                }
         </script>';

    /**
     * Measurement code for the event of proceeding to check out
     *
     * @var string
     */
    private $event_check_out =
        '<script>
                if (document.querySelector("div.wc-proceed-to-checkout .checkout-button") != null) {
                    
                    document.querySelector("div.wc-proceed-to-checkout .checkout-button").addEventListener("click", function() {
                        alert("Woocommerce: Proceed to check out");
                    });
                }
         </script>';

    /**
     * Measurement code for the event of placing the order
     *
     * @var string
     */
    private $event_place_order =
        '<script>
                jQuery(function($) {
                    $("form.woocommerce-checkout").on("submit", function() {                  
                        alert("Got an event: Place order");
                    });
                });

         </script>';

    /**
     * WoocommerceInjector constructor.
     */
    public function __construct() {
        $this->eventList = array();
        array_push($this->eventList, $this->event_add_to_cart);
        array_push($this->eventList, $this->event_review_cart);
        array_push($this->eventList, $this->event_cart_content);
        array_push($this->eventList, $this->event_check_out);
        array_push($this->eventList, $this->event_place_order);
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