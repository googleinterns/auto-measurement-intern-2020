<?php
include_once 'MeasurementEventList.php';


class WoocommerceEventList extends MeasurementEventList {

    public function __construct() {
        $pluginName = 'Woocommerce';
        $categories = array('ecommerce', 'ecommerce', 'ecommerce', 'ecommerce', 'ecommerce', 'ecommerce',
            'ecommerce', 'ecommerce', 'ecommerce');
        $actions = array('add_to_cart', 'remove_from_cart', 'checkout', 'review_cart', 'cart_contents',
            'update_cart', 'product_details', 'place_order', 'proceed_to_paypal');
        $selectors = array('.woocommerce-page .add_to_cart_button', '.woocommerce-page .remove',
            'div.wc-proceed-to-checkout .checkout-button', 'a.added_to_cart.wc-forward', 'a.cart-contents',
            '.woocommerce-cart-form__contents .coupon ~ .button',
            '.content-area a.woocommerce-LoopProduct-link', '.woocommerce-page .place-order',
            '.woocommerce-page  .place-order');

        $tempEvents = array();
        for($i = 0; $i < count($selectors); $i++) {
            $newEvent = new MeasurementEvent($pluginName, $categories[$i],
                $actions[$i], $selectors[$i]);
            array_push($tempEvents, $newEvent);
        }
        $this->setEvents($tempEvents);
    }

}
