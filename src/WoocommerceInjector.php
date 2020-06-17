<?php


class WoocommerceInjector {
    private $eventList = null;

    private $event_add_to_cart =
        '<script>
                if (document.querySelector(".woocommerce ~ div .add_to_cart_button") != null) {
                    
                    document.querySelector(".woocommerce ~ div .add_to_cart_button").addEventListener("click", function() {
                        alert("Woocommerce: Add to Cart");
                    });
                }
         </script>';

    private $event_review_cart =
        '<script>
                if (document.querySelector("a.added_to_cart.wc-forward") != null) {
                    
                    document.querySelector("a.added_to_cart.wc-forward").addEventListener("click", function() {
                        alert("Woocommerce: Review Cart");
                    });
                }
         </script>';

    private $event_cart_content =
        '<script>
                if (document.querySelector("a.cart-contents") != null) {
                    
                    document.querySelector("a.cart-contents").addEventListener("click", function() {
                        console.log("Content!");
                        alert("Woocommerce: Cart Content");
                    });
                }
         </script>';

    public function __construct() {
        $this->eventList = array();
        array_push($this->eventList, $this->event_add_to_cart);
        array_push($this->eventList, $this->event_review_cart);
        array_push($this->eventList, $this->event_cart_content);
    }

    public function injectCode() {
        foreach ($this->eventList as $event) {
            echo $event . '<br>';
        }
    }
}