<?php
include_once 'MeasurementEventList.php';


/**
 * Subclass that contains information for Woocommerce plugin
 *
 * @class WoocommerceEventList
 */
class WoocommerceEventList extends MeasurementEventList {

    public function __construct() {
        $builder = MeasurementEvent::createBuilder('Woocommerce')->category('ecommerce');
        $builder->action('add_to_cart')->selector('.woocommerce-page .add_to_cart_button');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder('Woocommerce')->category('ecommerce');
        $builder->action('add_to_cart')->selector('.woocommerce-page .single_add_to_cart_button');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder('Woocommerce')->category('ecommerce');
        $builder->action('remove_from_cart')->selector('.woocommerce-page .remove');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder('Woocommerce')->category('ecommerce');
        $builder->action('checkout')->selector('div.wc-proceed-to-checkout .checkout-button');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder('Woocommerce')->category('ecommerce');
        $builder->action('review_cart')->selector('a.added_to_cart.wc-forward');
        $builder->on('click')->secondLayerSelector('document.body')->secondLayerOn('added_to_cart');
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder('Woocommerce')->category('ecommerce');
        $builder->action('review_cart')->selector('div.woocommerce-message a.wc-forward');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder('Woocommerce')->category('ecommerce');
        $builder->action('cart_contents')->selector('a.cart-contents');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder('Woocommerce')->category('ecommerce');
        $builder->action('update_cart')->selector('.woocommerce-cart-form__contents .coupon ~ .button');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder('Woocommerce')->category('ecommerce');
        $builder->action('product_details')->selector('.content-area a.woocommerce-LoopProduct-link');
        $builder->on('click')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());

        $builder = MeasurementEvent::createBuilder('Woocommerce')->category('ecommerce');
        $builder->action('place_order')->selector('.woocommerce-page form.woocommerce-checkout');
        $builder->on('submit')->secondLayerSelector(null)->secondLayerOn(null);
        $this->addEvent($builder->build());
    }

}
