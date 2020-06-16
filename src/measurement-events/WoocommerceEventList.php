<?php
include_once 'MeasurementEventList.php';


class WoocommerceEventList extends MeasurementEventList {

    public function __construct() {
        $pluginName = 'Woocommerce';
        $categories = array('ecommerce', 'ecommerce', 'ecommerce', 'ecommerce', 'ecommerce', 'ecommerce', 'ecommerce',
            'ecommerce', 'ecommerce', 'ecommerce');
        $actions = array('add_to_cart', 'add_to_cart', 'remove_from_cart', 'checkout', 'review_cart', 'review_cart', 'cart_contents',
            'update_cart', 'product_details', 'place_order');
        $selectors = array('.woocommerce-page .add_to_cart_button', '.woocommerce-page .single_add_to_cart_button', '.woocommerce-page .remove',
            'div.wc-proceed-to-checkout .checkout-button', 'a.added_to_cart.wc-forward', 'div.woocommerce-message a.wc-forward', 'a.cart-contents',
            '.woocommerce-cart-form__contents .coupon ~ .button',
            '.content-area a.woocommerce-LoopProduct-link', '.woocommerce-page .place-order button.button');

        $tempEvents = array();
        for($i = 0; $i < count($selectors); $i++) {
            $newEvent = new MeasurementEvent($pluginName, $categories[$i],
                $actions[$i], $selectors[$i]);
            array_push($tempEvents, $newEvent);
        }
        $this->setEvents($tempEvents);
    }

}
