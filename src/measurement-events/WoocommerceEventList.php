<?php
include_once 'MeasurementEventList.php';


class WoocommerceEventList extends MeasurementEventList {

    public function __construct() {
        $this->setPluginName('Woocommerce');

        $tempCategories = array('ecommerce', 'ecommerce', 'ecommerce', 'ecommerce', 'ecommerce', 'ecommerce',
            'ecommerce', 'ecommerce', 'ecommerce');
        $this->setCategories($tempCategories);

        $tempActions = array('add_to_cart', 'remove_from_cart', 'checkout', 'review_cart', 'cart_contents',
            'update_cart', 'product_details', 'place_order', 'proceed_to_paypal');
        $this->setActions($tempActions);

        $tempSelectors = array('.woocommerce-page .add_to_cart_button', '.woocommerce-page .remove',
            'div.wc-proceed-to-checkout .checkout-button', 'a.added_to_cart.wc-forward', 'a.cart-contents',
            '.woocommerce-cart-form__contents .coupon ~ .button',
            '.content-area a.woocommerce-LoopProduct-link', '.woocommerce-page .place-order',
            '.woocommerce-page  .place-order');
        $this->setSelectors($tempSelectors);

        $tempEvents = array();
        for($i = 0; $i < count($this->getSelectors()); $i++) {
            $newEvent = new MeasurementEvent($this->getPluginName(), $this->getCategories()[$i],
                $this->getActions()[$i], $this->getSelectors()[$i]);
            array_push($tempEvents, $newEvent);
        }
        $this->setEvents($tempEvents);
    }

}
